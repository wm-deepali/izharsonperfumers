<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use Illuminate\Http\Request;

class HomeFeatureController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $features = HomeFeature::orderBy('position')->get();
        return view('admin.home-features.index', compact('features'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.home-features.create');
    }

    /**
     * Store feature
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'position' => 'nullable|integer'
        ]);

        HomeFeature::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'position' => $request->position ?? 0,
            'status' => 1,
        ]);

        return redirect()
            ->route('admin.home-features.index')
            ->with('success', 'Feature added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $feature = HomeFeature::findOrFail($id);
        return view('admin.home-features.edit', compact('feature'));
    }

    /**
     * Update feature
     */
    public function update(Request $request, $id)
    {
        $feature = HomeFeature::findOrFail($id);

        $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'position' => 'nullable|integer'
        ]);

        $feature->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'position' => $request->position ?? 0,
        ]);

        return redirect()
            ->route('admin.home-features.index')
            ->with('success', 'Feature updated successfully.');
    }

    /**
     * Delete feature
     */
    public function destroy($id)
    {
        HomeFeature::findOrFail($id)->delete();

        return redirect()
            ->route('admin.home-features.index')
            ->with('success', 'Feature deleted successfully.');
    }

    /**
     * Toggle status (Active / Inactive)
     */
    public function toggleStatus($id)
    {
        $feature = HomeFeature::findOrFail($id);
        $feature->status = !$feature->status;
        $feature->save();

        return back()->with('success', 'Status updated.');
    }

    /**
     * Update ordering (drag & drop)
     */
    public function updateOrder(Request $request)
    {
        foreach ($request->positions as $position => $id) {
            HomeFeature::where('id', $id)->update([
                'position' => $position
            ]);
        }

        return response()->json(['success' => true]);
    }
}