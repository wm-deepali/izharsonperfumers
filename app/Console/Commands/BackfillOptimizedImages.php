<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Customer;
use App\Models\HomepageSetting;
use App\Models\Product;
use App\Models\ProductOptionImage;
use App\Models\ProductVariantImage;
use App\Models\Slider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BackfillOptimizedImages extends Command
{
    /**
     * php artisan images:backfill-optimize
     * php artisan images:backfill-optimize --dry-run
     * php artisan images:backfill-optimize --force
     * php artisan images:backfill-optimize --keep-originals
     * php artisan images:backfill-optimize --only=products
     * php artisan images:backfill-optimize --only=categories,sliders,homepage_settings
     *
     * Covers every image field that has been switched over to the new
     * optimize-on-upload pattern across the app:
     *
     *   products              -> full(1600) + thumb(600) webp
     *   product_options       -> full(1600) + thumb(600) webp  (ProductOptionImage)
     *   product_variants      -> full(1600) + thumb(600) webp  (ProductVariantImage)
     *   categories            -> single optimized webp (image + banner_image, no thumb)
     *   sliders               -> single optimized webp, max 1920w (hero banner)
     *   homepage_settings     -> single optimized webp, max 1400w (widget/banner)
     *   blogs                 -> full(1400) + thumb(500) webp
     *   customers             -> single square-cropped avatar webp, 400x400
     */
    protected $signature = 'images:backfill-optimize
        {--dry-run : Sirf preview karega, kuch save/delete nahi karega}
        {--force : already-optimized rows ko bhi re-process karega}
        {--keep-originals : Purani original file ko delete nahi karega}
        {--chunk=50 : Ek baar me kitni rows process karni hain}
        {--only= : Comma separated: products,product_options,product_variants,categories,sliders,homepage_settings,blogs,customers}';

    protected $description = 'Existing images (products, categories, sliders, homepage widgets, blogs, customer avatars) ko optimized webp me backfill karta hai';

    private bool $dryRun = false;
    private bool $keepOriginals = false;

    private int $processed = 0;
    private int $skippedAlreadyDone = 0;
    private int $skippedMissingFile = 0;
    private int $failed = 0;

    public function handle()
    {
        $this->dryRun = (bool) $this->option('dry-run');
        $this->keepOriginals = (bool) $this->option('keep-originals');
        $chunkSize = (int) $this->option('chunk') ?: 50;

        $only = $this->option('only')
            ? array_map('trim', explode(',', $this->option('only')))
            : [
                'products', 'product_options', 'product_variants',
                'categories', 'sliders', 'homepage_settings',
                'blogs', 'customers',
            ];

        if ($this->dryRun) {
            $this->warn('--- DRY RUN MODE: kuch bhi save/delete nahi hoga, sirf log dikhega ---');
        }

        // ---- full + thumb tables ----
        if (in_array('products', $only)) {
            $this->info('== Product.image / image_thumb ==');
            $this->processFullThumb(Product::class, 'image', 'image_thumb', 'products', 1600, 90, 600, 75, $chunkSize);
        }

        if (in_array('product_options', $only)) {
            $this->info('== ProductOptionImage ==');
            $this->processFullThumb(ProductOptionImage::class, 'image', 'image_thumb', 'product-options', 1600, 90, 600, 75, $chunkSize);
        }

        if (in_array('product_variants', $only)) {
            $this->info('== ProductVariantImage ==');
            $this->processFullThumb(ProductVariantImage::class, 'image', 'image_thumb', 'product-options-image', 1600, 90, 600, 75, $chunkSize);
        }

        if (in_array('blogs', $only)) {
            $this->info('== Blog.image / image_thumb ==');
            $this->processFullThumb(Blog::class, 'image', 'image_thumb', 'blogs', 1400, 88, 500, 75, $chunkSize);
        }

        // ---- single-file tables ----
        if (in_array('categories', $only)) {
            $this->info('== Category.image ==');
            $this->processSingle(Category::class, 'image', 'categories_images', 1200, 85, $chunkSize);
            $this->info('== Category.banner_image ==');
            $this->processSingle(Category::class, 'banner_image', 'categories_images', 1200, 85, $chunkSize);
        }

        if (in_array('sliders', $only)) {
            $this->info('== Slider.image ==');
            $this->processSingle(Slider::class, 'image', 'sliders', 1920, 85, $chunkSize);
        }

        if (in_array('homepage_settings', $only)) {
            $this->info('== HomepageSetting.image ==');
            $this->processSingle(HomepageSetting::class, 'image', 'homewidget', 1400, 85, $chunkSize);
        }

        // ---- avatar (square crop) ----
        if (in_array('customers', $only)) {
            $this->info('== Customer.image (avatar) ==');
            $this->processAvatar(Customer::class, 'image', 'customers', 400, 85, $chunkSize);
        }

        $this->newLine();
        $this->info("Done. Processed: {$this->processed} | Skipped (already done): {$this->skippedAlreadyDone} | Skipped (file missing): {$this->skippedMissingFile} | Failed: {$this->failed}");

        return self::SUCCESS;
    }

    /**
     * Tables with a separate image + image_thumb column (products, blogs, etc).
     */
    private function processFullThumb(
        string $modelClass,
        string $pathColumn,
        string $thumbColumn,
        string $folder,
        int $fullWidth,
        int $fullQuality,
        int $thumbWidth,
        int $thumbQuality,
        int $chunkSize
    ): void {
        $modelClass::query()
            ->when(!$this->option('force'), fn($q) => $q->where(function ($q2) use ($thumbColumn) {
                $q2->whereNull($thumbColumn)->orWhere($thumbColumn, '');
            }))
            ->orderBy('id')
            ->chunkById($chunkSize, function ($rows) use ($pathColumn, $thumbColumn, $folder, $fullWidth, $fullQuality, $thumbWidth, $thumbQuality, $modelClass) {
                foreach ($rows as $row) {
                    $this->handleFullThumbRow(
                        $row, $pathColumn, $thumbColumn, $folder,
                        $fullWidth, $fullQuality, $thumbWidth, $thumbQuality,
                        label: class_basename($modelClass) . " #{$row->id}"
                    );
                }
            });
    }

    private function handleFullThumbRow($model, string $pathColumn, string $thumbColumn, string $folder, int $fullWidth, int $fullQuality, int $thumbWidth, int $thumbQuality, string $label): void
    {
        $currentThumb = $model->{$thumbColumn};
        $currentPath = $model->{$pathColumn};

        if (!$this->option('force') && !empty($currentThumb)) {
            $this->skippedAlreadyDone++;
            return;
        }

        if (empty($currentPath) || !Storage::disk('public')->exists($currentPath)) {
            $this->line("  [SKIP - file missing] {$label} -> '{$currentPath}'");
            $this->skippedMissingFile++;
            return;
        }

        try {
            $binary = Storage::disk('public')->get($currentPath);
            $source = Image::make($binary);
            $source->orientate();

            $uuid = Str::uuid();
            $folder = trim($folder, '/');

            $full = clone $source;
            $full->resize($fullWidth, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $fullPath = $folder . '/' . $uuid . '.webp';

            $thumb = clone $source;
            $thumb->resize($thumbWidth, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $thumbPath = $folder . '/' . $uuid . '-thumb.webp';

            $this->line("  [OK] {$label}: {$currentPath} -> full:{$fullPath} thumb:{$thumbPath}");

            if (!$this->dryRun) {
                Storage::disk('public')->put($fullPath, (string) $full->encode('webp', $fullQuality));
                Storage::disk('public')->put($thumbPath, (string) $thumb->encode('webp', $thumbQuality));

                $model->{$pathColumn} = $fullPath;
                $model->{$thumbColumn} = $thumbPath;
                $model->saveQuietly();

                if (!$this->keepOriginals && $currentPath !== $fullPath) {
                    Storage::disk('public')->delete($currentPath);
                }
            }

            $this->processed++;
        } catch (\Throwable $e) {
            $this->error("  [FAIL] {$label}: " . $e->getMessage());
            $this->failed++;
        }
    }

    /**
     * Tables with a single image column, no thumb (categories, sliders, homepage_settings).
     * We can't detect "already optimized" from a thumb column here, so unless
     * --force is passed we only touch rows whose stored file isn't already
     * a .webp under the expected folder (best-effort heuristic).
     */
    private function processSingle(string $modelClass, string $column, string $folder, int $maxWidth, int $quality, int $chunkSize): void
    {
        $modelClass::query()
            ->when(!$this->option('force'), fn($q) => $q->where(function ($q2) use ($column) {
                $q2->whereNotNull($column)->where($column, '!=', '')->where($column, 'not like', '%.webp');
            }))
            ->orderBy('id')
            ->chunkById($chunkSize, function ($rows) use ($column, $folder, $maxWidth, $quality, $modelClass) {
                foreach ($rows as $row) {
                    $this->handleSingleRow(
                        $row, $column, $folder, $maxWidth, $quality,
                        label: class_basename($modelClass) . " #{$row->id} ({$column})"
                    );
                }
            });
    }

    private function handleSingleRow($model, string $column, string $folder, int $maxWidth, int $quality, string $label): void
    {
        $currentPath = $model->{$column};

        if (empty($currentPath)) {
            return; // nothing to do, e.g. category with no banner_image
        }

        if (!$this->option('force') && str_ends_with($currentPath, '.webp')) {
            $this->skippedAlreadyDone++;
            return;
        }

        if (!Storage::disk('public')->exists($currentPath)) {
            $this->line("  [SKIP - file missing] {$label} -> '{$currentPath}'");
            $this->skippedMissingFile++;
            return;
        }

        try {
            $binary = Storage::disk('public')->get($currentPath);
            $image = Image::make($binary);
            $image->orientate();
            $image->resize($maxWidth, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });

            $uuid = Str::uuid();
            $folder = trim($folder, '/');
            $newPath = $folder . '/' . $uuid . '.webp';

            $this->line("  [OK] {$label}: {$currentPath} -> {$newPath}");

            if (!$this->dryRun) {
                Storage::disk('public')->put($newPath, (string) $image->encode('webp', $quality));

                $model->{$column} = $newPath;
                $model->saveQuietly();

                if (!$this->keepOriginals && $currentPath !== $newPath) {
                    Storage::disk('public')->delete($currentPath);
                }
            }

            $this->processed++;
        } catch (\Throwable $e) {
            $this->error("  [FAIL] {$label}: " . $e->getMessage());
            $this->failed++;
        }
    }

    /**
     * Avatar-style single column, but cropped to a square instead of a
     * plain aspect-preserving resize (customers.image).
     */
    private function processAvatar(string $modelClass, string $column, string $folder, int $size, int $quality, int $chunkSize): void
    {
        $modelClass::query()
            ->when(!$this->option('force'), fn($q) => $q->where(function ($q2) use ($column) {
                $q2->whereNotNull($column)->where($column, '!=', '')->where($column, 'not like', '%.webp');
            }))
            ->orderBy('id')
            ->chunkById($chunkSize, function ($rows) use ($column, $folder, $size, $quality, $modelClass) {
                foreach ($rows as $row) {
                    $this->handleAvatarRow(
                        $row, $column, $folder, $size, $quality,
                        label: class_basename($modelClass) . " #{$row->id}"
                    );
                }
            });
    }

    private function handleAvatarRow($model, string $column, string $folder, int $size, int $quality, string $label): void
    {
        $currentPath = $model->{$column};

        if (empty($currentPath)) {
            return;
        }

        if (!$this->option('force') && str_ends_with($currentPath, '.webp')) {
            $this->skippedAlreadyDone++;
            return;
        }

        if (!Storage::disk('public')->exists($currentPath)) {
            $this->line("  [SKIP - file missing] {$label} -> '{$currentPath}'");
            $this->skippedMissingFile++;
            return;
        }

        try {
            $binary = Storage::disk('public')->get($currentPath);
            $image = Image::make($binary);
            $image->orientate();
            $image->fit($size, $size);

            $uuid = Str::uuid();
            $folder = trim($folder, '/');
            $newPath = $folder . '/' . $uuid . '.webp';

            $this->line("  [OK] {$label}: {$currentPath} -> {$newPath}");

            if (!$this->dryRun) {
                Storage::disk('public')->put($newPath, (string) $image->encode('webp', $quality));

                $model->{$column} = $newPath;
                $model->saveQuietly();

                if (!$this->keepOriginals && $currentPath !== $newPath) {
                    Storage::disk('public')->delete($currentPath);
                }
            }

            $this->processed++;
        } catch (\Throwable $e) {
            $this->error("  [FAIL] {$label}: " . $e->getMessage());
            $this->failed++;
        }
    }
} 