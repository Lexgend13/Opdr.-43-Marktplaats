@extends('layout.app')
@section('title', 'Edit Article')
@include('layout.style')

@section('content')
    <form id="main_form" method="post" action="{{route('articles.update', $article)}}">
        @csrf
        @method('PUT')
        <h2>Edit Article</h2>
        @php //dd($article) @endphp
        <label class="big">Title</label><br>
        <textarea name="title"
            id="title"
            class="textarea">{{ old('title', $article->title) }}</textarea>
        
        <label class="big">Categories</label><br>
        @foreach($categories as $category)
            <label>{{$category->name}}</label>
            <input type="checkbox"
                name="categories[]"
                id="categories"
                value="{{ $category->id }}" 
                {{ $article->categories->contains($category) ? 'checked' : '' }}>
        @endforeach
        <br><br>
        @if ($img_path != "http://localhost:8000/storage/0")
            <img src="{{ $img_path }}" alt="Image"><Br>
        @endif
        <label for="file">Choose a file:</label>
        
        <input type="file" name="image_path" id="image_path"><Br>
        <label class="big">Text</label><br>
        <textarea name="body"
            rows="10"
            id="body"
            class="textarea">{{ old('body', $article->body) }}</textarea>
        <br>
        <input type="hidden"
            name="user_id"
            id="user_id"
            value="1">
        <input type="hidden"
            name="is_promoted"
            id="is_promoted"
            value="0">
        @auth
        <label>Promote article: </label>
        <input type="checkbox"
            name="is_promoted"
            id="is_promoted"
            value="1" {{ old('is_promoted', $article->is_promoted ?? "1") ? 'checked' : '' }}>
            <input type="hidden"
                name="user_id"
                id="user_id"
                value="{{ auth()->id() }}">
        <br>
        @endauth
        <button type="submit">Update changes</button><br>
    </form>
    <form action="{{ route('articles.destroy', ['article' => $article])}}" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit">Delete article</button>
    </form>
    
@endsection
