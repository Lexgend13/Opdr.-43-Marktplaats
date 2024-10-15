@extends('layout.app')
@section('title', 'Show Article')
@include('layout.style')

@section('content')
    <?php //dd($biddings)?>
    <form enctype="multipart/form-data">
        @php //dd($article) @endphp
        <br><label class="big">{{$article->title}}</label><br>
        @if ($article->is_promoted)
            <a>Promoted article</a><Br><br>
        @endif       
        <label class="big">Categories</label><br>
        @foreach($article->categories as $category)
            <label>{{$category->name}}</label><br>
        @endforeach
        <br><br>
        @if ($img_path != "http://localhost:8000/storage/0")
            <img src="{{ $img_path }}" alt="Image"><Br>
        @endif
        <a class="newlines">{{$article->body}}</a><Br><a>{{$article->body}}</a><a>{{$article->body}}</a><a>{{$article->body}}</a>
        <br>       
    </form>
    <h2>Biddings</h2>
    <?php $noArticle = 0?>  
    @foreach ($biddings as $bidding) 
        @if (auth() && $bidding->user_id == auth()->id())
            <?php $noArticle = 1?>
            <a><strong>You</strong></a><br>
            <a>have offered a bid of €{{$bidding->amount}}</a>
            <form action="{{ route('biddings.destroy', ['bidding' => $bidding, 'article' => $article])}}" method="POST" class="inline-form">
                @csrf
                @method("DELETE")
                <button type="submit">Delete</button>
            </form><br>
        @else
            <a><strong>{{ $bidding->user->name }}</strong></a><br>
            <a>has offered a bid of €{{$bidding->amount}}</a><br>
        @endif
    @endforeach
    <?php //dd($article) ?>
    @auth
        @if(!$noArticle)
        <br><button id="createBid" style="display:block">Make a bid</button>
        <form id='createBidDiv' style="display:none" method="POST" action="{{route('biddings.store')}}">
            @csrf
            <input type="hidden"
            name="article_id"
            id="article_id"
            value={{$article->id}}>
            <a>€</a>
            <input type="number"
                name="amount"
                id="amount">
            <button type="submit">Upload bid</button>
            <button type="button" id='cancle'>Cancle</button>
        </form>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var visibility = document.getElementById('createBid');
                var div = document.getElementById('createBidDiv');
                var cancle = document.getElementById('cancle');

                function toggleVisibility() {
                    div.style.display = (div.style.display === "none") ? "block" : "none";
                    visibility.style.display = (visibility.style.display === "none") ? "block" : "none";
                };

                visibility.addEventListener('click', toggleVisibility);
                cancle.addEventListener('click', toggleVisibility);

            });        
        </script>
    @endauth
@endsection
