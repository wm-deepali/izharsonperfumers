@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

    <!-- Inner Page Breadcrumb -->
   <section class="inner_page_breadcrumb style2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="breadcrumb_content">
                    <h2 class="breadcrumb_title">Frequently Asked Questions</h2>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            FAQs
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Our FAQ -->
    <section class="our-faq pb10">
        <div class="container">

            @php $accordionIndex = 1; @endphp

            @foreach($faqs as $category => $items)

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="main-title text-center">
                            <h2>{{ $category }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="shortcode_widget_accprdons">
                            <div class="faq_according text-start">

                                <div class="accordion" id="accordionExample{{ $loop->index }}">

                                    @foreach($items as $faq)

                                        <div class="card">

                                            <div class="card-header {{ $loop->first ? 'active' : '' }}"
                                                id="heading{{ $accordionIndex }}">

                                                <h2 class="mb-0">

                                                    <button class="btn btn-link text-start {{ !$loop->first ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $accordionIndex }}"
                                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                        aria-controls="collapse{{ $accordionIndex }}">

                                                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                                        {{ $faq->question }}

                                                    </button>

                                                </h2>

                                            </div>

                                            <div id="collapse{{ $accordionIndex }}"
                                                class="collapse {{ $loop->first ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $accordionIndex }}"
                                                data-parent="#accordionExample{{ $loop->index }}">

                                                <div class="card-body">
                                                    {!! $faq->answer !!}
                                                </div>

                                            </div>

                                        </div>

                                        @php $accordionIndex++; @endphp

                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </section>

@endsection