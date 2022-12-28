@include('layouts.app')
@section('content')
<div class="container" style="max-width:750px">
    <h2 class="h4 text-success mb-3">Edit Article</h2>
    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        </div>
    @endif
    <form method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}">
        </div>
        <div class="form-group mb-2">
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="5" class="form-control">{{ $article->body }}</textarea>
        </div>
        <div class="form-group mb-2">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-outline-primary"><i class="fas fa-paper-plane me-2"></i>Update Article</button>
    </form>
</div>
