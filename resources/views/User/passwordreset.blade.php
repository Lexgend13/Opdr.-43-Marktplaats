@extends('layout.app')
@section('title', 'Register')

@section('content')

@if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

<br><br>
<form method="POST" action="{{route('password.change')}}">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="token" value="{{ $token }}">
    
    <input required
        type="password"
        name="password"
        id="password"
        placeholder="new password"><br>
    <input required
        type="password"
        name="password_confirmation"
        id="password_confirmation"
        placeholder="verify new password"><br>
    <button type="submit">Change password</button>
    @error('password')
        <div class="text-red-500">{{ $message }}</div> <!-- Display the validation message -->
    @enderror
</form>
        
@endsection