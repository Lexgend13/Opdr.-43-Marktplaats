@extends('layout.app')
@section('title', 'Marktplaats')

@section('content')
    <?php //dd($articles)?>
    <a href="#" onclick="displayCategories()">|| Show categories</a><br>
    <div style="display: none;" id="categoryList">
        @php
            $allCategories = $articles->pluck('categories')->flatten()->unique('id');
        @endphp
        @foreach ($allCategories as $category)
            <a href="{{ route('articles.index', ['category' => $category->id]) }}">{{$category->name}} ||</a>
        @endforeach
    </div>
    <br>
    <form action="{{ route('articles.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search for articles" required>
        <button type="submit">Search</button>
    </form>
    <br>
    <a>Page navigation (per 10)</a><br>
    {{ $articles->links() }}<br>

    @foreach($articles as $article)
        <a href="/articles/{{ $article->id }}">{{$article->title}}</a><br> 
        @if ($article->is_promoted)
            <a>This article is promoted</a><br>
        @endif
        @foreach($article->categories as $category)
            
            <li><a href="{{ route('articles.index', ['category' => $category->id]) }}">{{$category->name}}</a></li>
        @endforeach        
        @auth
        @if (@auth()->id() == $article->user_id)
            <a href="{{ route('articles.edit', ['article' => $article->id]) }}">Edit</a>
            <form action="{{ route('articles.destroy', ['article' => $article])}}" method="POST" class="inline-form">
                @csrf
                @method("DELETE")
                <button type="submit">Delete</button>
            </form><br>
        @endif
        @endauth
        <br>
    @endforeach

    <script>
        function displayCategories() {
            var categoryList = document.getElementById("categoryList");
            categoryList.style.display = categoryList.style.display === "none" ? "block" : "none";
        }
    </script>

@endsection