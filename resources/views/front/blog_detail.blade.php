@extends('front.app')

@section('title', $blog->title)

@section('content')

    <!-- Breadcrumb -->
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('/blog') }}">Blog</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ $blog->title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Detail -->
    <section class="blog_post_container pt30 pb80">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <div class="main_blog_post">

                        <div class="mbp_thumb_post">
                            <div class="thumb">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $blog->image) }}"
                                    alt="{{ $blog->title }}">
                            </div>

                            <div class="details">

                                <h3 class="title">
                                    {{ $blog->title }}
                                </h3>

                                <ul class="post_meta">
                                    <li>
                                        <span class="flaticon-user"></span>
                                        {{ $blog->author ?? 'Admin' }}
                                    </li>

                                    <li>
                                        <span class="flaticon-calendar"></span>
                                        {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                                    </li>
                                </ul>

                                <div class="blog-content mt30">
                                    {!! $blog->content !!}
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <!-- Sidebar -->
                <div class="col-lg-4">

                    <div class="sidebar_widget">

                        <h4 class="title">Recent Blogs</h4>

                        <ul class="recent_post">

                            @foreach($recentBlogs as $recent)

                                <li>

                                    <div class="thumb">
                                        <img src="{{ asset('storage/' . $recent->image) }}" width="80">
                                    </div>

                                    <div class="details">

                                        <a href="{{ url('blog/' . $recent->url) }}">
                                            {{ \Illuminate\Support\Str::limit($recent->title, 60) }}
                                        </a>

                                        <span class="post_date">
                                            {{ \Carbon\Carbon::parse($recent->created_at)->format('F d, Y') }}
                                        </span>

                                    </div>

                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection