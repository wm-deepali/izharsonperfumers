@extends('front.app')
@section('title', $blog->title)
@section('content')
    <!-- Breadcrumb -->
    <section class="inner_page_breadcrumb py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/blog') }}">Blog</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ Str::limit($blog->title, 60) }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Detail -->
    <section class="blog_post_container pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="blog-detail-card bg-white shadow-sm rounded-4 overflow-hidden mb-5">
                        <div class="thumb">
                            <img class="img-fluid w-100" 
                                 src="{{ asset('storage/' . $blog->image) }}" 
                                 alt="{{ $blog->title }}"
                                 style="max-height: 520px; object-fit: cover;">
                        </div>
                        <div class="p-4 p-md-5">
                            <h1 class="title fw-bold mb-3" style="font-size: 2.1rem; line-height: 1.3;">
                                {{ $blog->title }}
                            </h1>

                            <ul class="post_meta list-inline text-muted mb-4">
                                <li class="list-inline-item me-4">
                                    <span class="flaticon-user me-2"></span>
                                    {{ $blog->author ?? 'Admin' }}
                                </li>
                                <li class="list-inline-item">
                                    <span class="flaticon-calendar me-2"></span>
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                                </li>
                            </ul>

                            <div class="blog-content mt-4 article-content">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Recent Blogs -->
                <div class="col-lg-4">
                    <div class="sidebar_widget bg-white shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                        <h4 class="title fw-bold mb-4 pb-3 border-bottom">Recent Blogs</h4>
                        
                        <div class="recent-posts-list">
                            @forelse($recentBlogs as $recent)
                                <a href="{{ url('blog/' . $recent->url) }}" 
                                   class="recent-post-card d-flex text-decoration-none mb-4 p-3 rounded-3 bg-light-hover transition-all">
                                    <div class="thumb me-3 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $recent->image) }}" 
                                             alt="{{ $recent->title }}"
                                             class="rounded-3"
                                             width="90" 
                                             height="90"
                                             style="object-fit: cover; aspect-ratio: 1/1;">
                                    </div>
                                    <div class="details flex-grow-1">
                                        <h6 class="mb-2 fw-medium text-dark" style="line-height: 1.4;">
                                            {{ Str::limit($recent->title, 65) }}
                                        </h6>
                                        <span class="post_date small text-muted">
                                            {{ \Carbon\Carbon::parse($recent->created_at)->format('F d, Y') }}
                                        </span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-muted text-center">No recent blogs</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


    <style>
        .bg-light-hover:hover {
            background: #f8f9fa !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .transition-all {
            transition: all 0.25s ease;
        }
        .article-content {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #333;
        }
        .article-content h2, .article-content h3 {
            margin: 2rem 0 1rem;
            font-weight: 600;
        }
        .article-content p {
            margin-bottom: 1.5rem;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }
        .blog-detail-card {
            border: 1px solid #eee;
        }
        @media (max-width: 991px) {
            .sidebar_widget {
                position: static !important;
            }
        }
    </style>
