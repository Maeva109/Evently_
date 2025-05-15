@extends('layout')

@section('title', 'Blog')

@section('content')
<section class="blog-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-header text-center">
                    <h2 class="section-title">Notre Blog</h2>
                    <p>Découvrez nos derniers articles et actualités</p>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($posts as $post)
                <div class="col-lg-4 col-md-6 col-xs-12 mb-4">
                    <div class="blog-item">
                        <div class="blog-image">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                            @else
                                <img src="{{ asset('images/default-blog.svg') }}" alt="Default Image" class="img-fluid">
                            @endif
                            <div class="date-box">
                                <span class="day">{{ $post->created_at->format('d') }}</span>
                                <span class="month">{{ $post->created_at->format('M') }}</span>
                            </div>
                        </div>
                        <div class="blog-info">
                            <h3 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="blog-content">{{ Str::limit($post->excerpt ?? $post->content, 150) }}</p>
                            <div class="blog-meta">
                                <span class="author">
                                    <i class="lni-user"></i> {{ $post->author->name }}
                                </span>
                                @if($post->category)
                                    <span class="category">
                                        <i class="lni-folder"></i> {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-common">Lire plus</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>Aucun article disponible pour le moment</h4>
                        <p>Revenez bientôt pour découvrir nos nouveaux articles !</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="pagination-container text-center mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .blog-section {
        padding: 100px 0;
        background-color: #f8f9fa;
    }

    .blog-item {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .blog-item:hover {
        transform: translateY(-5px);
    }

    .blog-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .date-box {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(233, 30, 99, 0.9);
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        line-height: 1;
    }

    .date-box .day {
        display: block;
        font-size: 1.5em;
        font-weight: bold;
    }

    .date-box .month {
        display: block;
        font-size: 0.8em;
        text-transform: uppercase;
    }

    .blog-info {
        padding: 20px;
    }

    .blog-title {
        font-size: 1.25rem;
        margin-bottom: 15px;
    }

    .blog-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .blog-title a:hover {
        color: #E91E63;
    }

    .blog-content {
        color: #666;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .blog-meta {
        margin-bottom: 15px;
        font-size: 0.9em;
        color: #777;
    }

    .blog-meta span {
        margin-right: 15px;
    }

    .blog-meta i {
        margin-right: 5px;
        color: #E91E63;
    }

    .btn-common {
        background-color: #E91E63;
        color: white;
        padding: 8px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-common:hover {
        background-color: #C2185B;
        color: white;
        text-decoration: none;
    }

    .pagination-container {
        margin-top: 30px;
    }

    .pagination {
        justify-content: center;
    }

    .page-link {
        color: #E91E63;
        border-color: #E91E63;
    }

    .page-link:hover {
        background-color: #E91E63;
        border-color: #E91E63;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #E91E63;
        border-color: #E91E63;
    }
</style>
@endsection 