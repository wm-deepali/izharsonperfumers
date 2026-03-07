@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Blog
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Blog Post Content -->
    <section class="blog_post_container pt30 pb80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="main-title text-center">
                        <h2 class="title">Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row mt50">

                @forelse($blogs as $blog)

                    <div class="col-md-6 col-xl-4">
                        <div class="for_blog">

                            <div class="thumb">
                                <img class="img-whp" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            </div>

                            <div class="details">
                                <div class="tc_content">

                                    <span class="subtitle">
                                        {{ $blog->author ?? 'Admin' }}
                                    </span>

                                    <h4 class="title">
                                        <a href="{{ url('blog/' . $blog->url) }}">
                                            {{ Str::limit($blog->title, 60) }}
                                        </a>
                                    </h4>

                                    <span class="post_date">
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                                    </span>

                                </div>
                            </div>

                        </div>
                    </div>

                @empty

                    <div class="col-lg-12 text-center">
                        <p>No blogs available</p>
                    </div>

                @endforelse

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mbp_pagination mt30 text-center">
                        @if ($blogs->hasPages())

                            <ul class="page_navigation">

                                {{-- Previous --}}
                                <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}">
                                        <span class="fas fa-angle-left"></span>
                                    </a>
                                </li>

                                {{-- Page Numbers --}}
                                @for ($i = 1; $i <= $blogs->lastPage(); $i++)

                                    <li class="page-item {{ $blogs->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $blogs->url($i) }}">
                                            {{ $i }}
                                            @if($blogs->currentPage() == $i)
                                                <span class="sr-only">(current)</span>
                                            @endif
                                        </a>
                                    </li>

                                @endfor

                                {{-- Next --}}
                                <li class="page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">
                                        <span class="fas fa-angle-right"></span>
                                    </a>
                                </li>

                            </ul>

                        @endif

                        <p class="mt20 pagination_page_count text-center">
                            {{ $blogs->firstItem() }} – {{ $blogs->lastItem() }} of {{ $blogs->total() }} blogs found
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection