@extends('layout.app')
@section('title', 'Register')

@section('content')
    <form method="POST" action="{{route('users.update')}}">
        @csrf
        <label>Name: </label>
        <input type="text"
                name="name"
                id="name"
                required
                value={{old('name')}}><br>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <label>Password: </label>
        <input type="password"
                name="password"
                id="password"
                required><br>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
        <button type="submit">Log in</button>
        
    </form>
    <a id="passwordForgottenbutton" style="display:block">
        <button id="toggler">Password forgotten?</button>
    </a>
    <form id="passwordForgotten" style="display:none" method="POST" action="{{route('users.password')}}">
        @csrf
        <input required
            type="text"
            name="email"
            id="email"
            placeholder="Fill in email adress">
        <button type="submit">Send password reset</button>
        <button type="button" id="cancle">Cancle</button>
    </form>
    @if (isset($message))
        <div>
            {{ $message }}
        </div>
    @endif
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var visibility = document.getElementById('passwordForgottenbutton');
                var div = document.getElementById('passwordForgotten');
                var cancle = document.getElementById('cancle');

                function toggleVisibility() {
                    div.style.display = (div.style.display === "none") ? "block" : "none";
                    visibility.style.display = (visibility.style.display === "none") ? "block" : "none";
                };

                visibility.addEventListener('click', toggleVisibility);
                cancle.addEventListener('click', toggleVisibility);

            });        
        </script>
@endsection