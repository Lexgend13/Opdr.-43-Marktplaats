@extends('layout.app')
@section('title', 'Create Article')
@include('layout.style')

@section('content')
    <form id="main_form" method="post" action="{{route('articles.store')}}" enctype="multipart/form-data">
        @csrf
        <h2>Create new Article</h2>
        @php //dd($article) @endphp
        <label class="big">Title</label><br>
        <textarea name="title"
            id="title"
            class="textarea"
            placeholder="Title"></textarea>
        
        <label class="big">Categories</label><br>
        @foreach($categories as $category)
            
            <input type="checkbox"
                name="categories[]"
                id="categories"
                value="{{ $category->id }}">
                <label>{{$category->name}}</label>
        @endforeach
        <br><br>
        <input type="hidden"
            name="image_path"
            id="image_path"
            value="0">
        <label for="file">Choose a file:</label>
        <input type="file" name="image_path" id="image_path"><Br>
        <label class="big">Text</label><br>
        <textarea name="body"
            rows="10"
            id="body"
            class="textarea"
            placeholder="Write your article"></textarea>
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
                value="1">
            <input type="hidden"
                name="user_id"
                id="user_id"
                value="{{ auth()->id() }}">
            <br>
        @endauth
        <button type="submit">Upload article</button>
    </form>
@endsection