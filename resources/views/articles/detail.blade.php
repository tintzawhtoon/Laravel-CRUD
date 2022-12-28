@include('layouts.app')
@section('content')
<div class="container">
    <a href="{{ url("/articles") }}" class="btn btn-outline-secondary mb-2"><i class="fas fa-angle-left me-2"></i>Back</a>
    @if (session("info"))
        <div class="alert alert-info">{{ session("info") }}</div>
    @endif
    <div class="card mb-2">
        <div class="card-body">
            <h2 class="h3 card-title mb-2">
                {{ $article->title }}
            </h2>
            <small class="text-muted mb-2">
                <b class="text-success me-2">{{ $article->user->name }}</b>
                    <b class="text-primary me-2">{{ $article->category->name }}</b> <br>
                {{ $article->created_at->diffForHumans() }}
            </small>
            <p class="mb-2">
                {{ $article->body }}
            </p>
            @auth
            <div class="mb-2">
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-outline-danger"><i class="fas fa-trash me-2"></i>Delete</a>
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-outline-info"><i class="fas fa-pen me-2"></i>Edit</a>
            </div>
            @endauth
        </div>
    </div>

    <hr>

    <ul class="list-group mb-2">
        <li class="list-group-item bg-secondary text-light">
            Comments
            ({{ count($article->comments) }})
        </li>
        @foreach ($article->comments as $comment)
            <li class="list-group-item">
                <b class="text-success me-2">{{ $comment->user->name }}</b>
                {{ $comment->content }}
                @auth
                <a href="{{ url("/comments/delete/$comment->id") }}" class="btn btn-close float-end"></a>
                @endauth
            </li>
        @endforeach
    </ul>

    @auth
    <form action="{{ url("/comments/add") }}" method="post">
        @csrf
        <input type="hidden" value="{{ $article->id }}" name="article_id">
        <textarea name="content" class="form-control mb-2"></textarea>
        <button class="btn btn-outline-secondary"><i class="fas fa-paper-plane me-2"></i>Add comment</button>
    </form>
    @endauth
</div>
