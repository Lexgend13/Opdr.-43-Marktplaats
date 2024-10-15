@extends('layout.app')
@section('title', 'Create Article')
@include('layout.style')

@section('content')
    <br><br>
    <?php //dd(gettype("auth()->user()->notifications" "{{ auth()->user()->notifications ? 'checked' : '' }}"))?>
    <form method="POST" action="{{ route('messages.update', [$user_id = auth()->id()])}}">
        @csrf
        @method('PUT')
        <label>Notifications</label>
        <input type="hidden"
            name="notifications"
            id="notifications"
            value="0"
            >
        <input type="checkbox"
            name="notifications"
            id="notifications"
            value="1" 
            {{ auth()->user()->notifications ? 'checked' : '' }}>
        <button type="submit">Update</button>
            
    </form>

    
    <button id='message'>Message</button>
    <form id='messageDiv' style='display:none' method="POST" action="{{route('messages.store')}}">
        @csrf
        <a>Directed to</a>
        <select name="user_id" id="user_id" required>
            <option value="" disabled selected>Select contact</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <textarea required
            class="textarea"
            rows="5"
            name="text"
            id="text"
            placeholder="text"></textarea>
        <button type="submit">Send</button>
        <button type="button" id='cancleMessage'>Cancle</button>
    </form><Br>

    @foreach($messages as $message)
        <a class="big">From {{$message->writer}}</a><br>
        <small>Send {{$message->created_at}}</small><br>
        <a class="newlines">{{$message->text}}</a><br><br>
    @endforeach

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                var createMessage = document.getElementById('message');
                var div = document.getElementById('messageDiv');
                var cancle = document.getElementById('cancleMessage');

                function toggleVisibility() {
                    div.style.display = (div.style.display === "none") ? "block" : "none";
                    createMessage.style.display = (createMessage.style.display === "none") ? "block" : "none";
                };

                createMessage.addEventListener('click', toggleVisibility);
                cancle.addEventListener('click', toggleVisibility);

            });
            
            // $(document).ready(function() {
            //     $('#user-select').select2({
            //         placeholder: 'Select a user',
            //         allowClear: true
            //     });
            // });
  
        </script>
@endsection