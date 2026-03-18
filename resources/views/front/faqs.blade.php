@extends('front.app')

@section('title', 'Frequently Asked Questions')

@section('content')

    <style>
        /* IZHARSON FAQ - Brand Matched Colors (Purple + Gold Theme) */
        .iz-faq-hero {
            padding: 50px 0 50px;
            background: linear-gradient(135deg, #f5f3ff 0%, #faf5ff 100%); /* light purple tint */
            position: relative;
        }

        .iz-faq-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(107,33,182,0.06) 0%, transparent 60%);
            pointer-events: none;
        }

        .iz-faq-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #000000; 
            margin-bottom: 0.8rem;
            letter-spacing: -0.6px;
        }

        .iz-faq-subtitle {
            font-size: 1.18rem;
            color: #4b5563;
            max-width: 680px;
            margin: 0 auto;
            font-weight: 400;
        }

        .iz-faq-category {
            font-size: 2.1rem;
            font-weight: 700;
            color: #000000; /* purple for categories */
            margin: 0rem 0 2.2rem ;
            position: relative;
            text-align: center;
        }

        .iz-faq-category::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: linear-gradient(to right, #d4af37, #facc15); /* gold gradient */
            border-radius: 3px;
        }

        .iz-faq-wrapper {
            max-width: 880px;
            margin: 0 auto 6rem;
        }

        .iz-faq-item {
            background: white;
            border-radius: 18px;
            margin-bottom: 1.4rem;
            box-shadow: 0 8px 24px rgba(107,33,182,0.08); /* subtle purple shadow */
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .iz-faq-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(107,33,182,0.12);
        }

        .iz-faq-question {
            width: 100%;
            padding: 1.6rem 2.2rem;
            font-size: 1.14rem;
            font-weight: 600;
            color: #1f2937;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: background 0.3s;
        }

        .iz-faq-question-number {
            min-width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #d4af37, #facc15); /* gold brand color */
            color: #1e1b32; /* dark for contrast */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.15rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(212,175,55,0.3);
        }

        .iz-faq-toggle-icon {
            margin-left: auto;
            font-size: 1.5rem;
            color: #000000; /* purple */
            transition: transform 0.4s ease, color 0.3s;
        }

        .iz-faq-item.active .iz-faq-toggle-icon {
            transform: rotate(180deg);
            color: #d4af37; /* gold when open */
        }

        .iz-faq-answer {
            max-height: 0;
            overflow: hidden;
            padding: 0 2.2rem;
            background: #f5f3ff; /* very light purple */
            transition: max-height 0.45s ease, padding 0.4s ease;
            color: #374151;
            line-height: 1.8;
            font-size: 1.04rem;
        }

        .iz-faq-item.active .iz-faq-answer {
            max-height: 1400px;
            padding: 2rem 2.2rem 2.4rem;
        }

        .iz-faq-answer p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .iz-faq-title { font-size: 2.4rem; }
            .iz-faq-category { font-size: 1.85rem; margin: 3rem 0 1.8rem; }
        }

        @media (max-width: 576px) {
            .iz-faq-hero { padding: 80px 0 50px; }
            .iz-faq-title { font-size: 2rem; }
            .iz-faq-question { padding: 1.4rem 1.6rem; font-size: 1.05rem; }
        }
    </style>

    <!-- Hero Section -->
    <section class="iz-faq-hero text-center">
        <div class="container">
            <h1 class="iz-faq-title">Frequently Asked Questions</h1>
            <p class="iz-faq-subtitle">Find quick answers to common questions about your orders, delivery, returns & more.</p>
        </div>
    </section>

    <!-- FAQ Items -->
    <section class="py-5">
        <div class="container">
            @php $globalIndex = 1; @endphp

            @foreach($faqs as $category => $items)
                <h2 class="iz-faq-category">{{ $category }}</h2>

                <div class="iz-faq-wrapper">
                    @foreach($items as $faq)
                        <div class="iz-faq-item {{ $loop->first ? 'active' : '' }}">
                            <button class="iz-faq-question">
                                <span class="iz-faq-question-number">{{ str_pad($globalIndex, 2, '0', STR_PAD_LEFT) }}</span>
                                {{ $faq->question }}
                                <i class="fas fa-chevron-down iz-faq-toggle-icon"></i>
                            </button>

                            <div class="iz-faq-answer">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                        @php $globalIndex++; @endphp
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- JS for Accordion (one open per category) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.iz-faq-question').forEach(btn => {
                btn.addEventListener('click', function () {
                    const item = this.closest('.iz-faq-item');
                    const parent = item.parentElement;
                    const isActive = item.classList.contains('active');

                    // Close others in same category
                    parent.querySelectorAll('.iz-faq-item').forEach(el => {
                        if (el !== item) el.classList.remove('active');
                    });

                    // Toggle current
                    item.classList.toggle('active');
                });
            });
        });
    </script>

@endsection