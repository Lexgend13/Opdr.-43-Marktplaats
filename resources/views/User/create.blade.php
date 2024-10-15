@extends('layout.app')
@section('title', 'Register')

@section('content')
    <form method="POST" action="{{route('users.store')}}">
        @csrf
        <label>Name: </label>
        <input type="text"
                name="name"
                id="name"
                required
                value={{old('name')}}><br>
        <label>Username: </label>
        <input type="text"
                name="username"
                id="username"
                required
                value={{old('username')}}><br>
        <label>Email: </label>
        <input type="email"
                name="email"
                id="eail"
                required
                value={{old('email')}}><br>
        <label>Password: </label>
        <input type="password"
                name="password"
                id="password"
                required
                value={{old('password')}}><br>
        <button type="submit">Create User</button>
    </form>
@endsection