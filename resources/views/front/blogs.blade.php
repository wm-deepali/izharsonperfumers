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
    <section class="blog_post_container pt30 pb80" style="background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="main-title text-center">
                        <h2 class="title" style="color: black;">Blog</h2>
                    </div>
                </div>
            </div>

            <div class="row mt50">
                @forelse($blogs as $blog)
                    <div class="col-md-6 col-xl-4 mb-4">
                        <div class="blog-card glass-card">
                            <div class="thumb">
                                <img class="img-whp" src="{{ asset('storage/' . ($blog->image_thumb ?? $blog->image)) }}" alt="{{ $blog->title }}">
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
                        <p style="color: white; font-size: 1.2rem;">No blogs available</p>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="mbp_pagination mt30 text-center">
                        @if ($blogs->hasPages())
                            <ul class="page_navigation">
                                <!-- Previous -->
                                <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}">
                                        <span class="fas fa-angle-left"></span>
                                    </a>
                                </li>
                                <!-- Page Numbers -->
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
                                <!-- Next -->
                                <li class="page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">
                                        <span class="fas fa-angle-right"></span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        <p class="mt20 pagination_page_count text-center" style="color: white;">
                            {{ $blogs->firstItem() }} – {{ $blogs->lastItem() }} of {{ $blogs->total() }} blogs found
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


    <style>
        .blog_post_container {
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            transition: all 0.35s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            background: rgba(255, 255, 255, 0.18);
        }

        .glass-card .thumb {
            position: relative;
            overflow: hidden;
        }

        .glass-card .thumb img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-card:hover .thumb img {
            transform: scale(1.08);
        }

        .glass-card .details {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .glass-card .subtitle {
            font-size: 0.9rem;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .glass-card .title {
            margin-bottom: 0.75rem;
        }

        .glass-card .title a {
            color: gray;
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .glass-card .title a:hover {
            color: blue;
        }

        .glass-card .post_date {
            font-size: 0.85rem;
            color: gray;
            margin-top: auto;
        }

        /* Optional: Improve pagination contrast */
        .page_navigation .page-link {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: black;
        }

        .page_navigation .page-item.active .page-link {
            background: rgba(255, 255, 255, 0.35);
            border-color: black;
        }
    </style>