@auth
    <a class="big"><strong>Welcome, {{auth()->user()->name}}</strong></a><br>
@endauth
<a href="/articles">Home ||</a>
<a href="/articles/create">New article ||</a>
@auth
    <a href="{{ route('articles.index', ['userId' => auth()->id()]) }}">My articles ||</a>
    <a href="{{ route('messages.index')}}">Messages ||</a>
@endauth
@guest
    <a href="/users/create">Register ||</a>
    <a href="/users/login">Log in ||</a>
@endguest
@auth
    <form class="inline-form" action="{{route('users.destroy', 'auth()->user()')}}" method="POST">
        @csrf
        @method("delete")
        <button type="submit">Log out</button>
    </form>
@endauth

