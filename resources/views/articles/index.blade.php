@include('layouts.app')
@section('content')
<div class="container">
    {{ $articles->links() }}
    @if (session("info"))
        <div class="alert alert-info">
            {{ session("info") }}
        </div>
    @endif
    @foreach ($articles as $article)
        <div class="card mb-2">
            <div class="card-body">
                <h2 class="h3 card-title mb-2">
                    {{ $article->title }}
                </h2>
                <small class="text-muted mb-2">
                    <b class="text-success me-2">{{ $article->user->name }}</b>
                    <b class="text-primary me-2">{{ $article->category->name }}</b>
                    <i class="me-2">Comments: ({{ count($article->comments) }})</i> <br>
                    {{ $article->created_at->diffForHumans() }}
                </small>
                <p class="mb-2">
                    {{ Str::of($article->body)->words(50, " ") }}
                </p>
                <div class="mb-2">
                    <a href="{{ url("/articles/detail/$article->id") }}">View Detail</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
