@extends('layouts.app')

@section('content')
    <div class='splash'>
        <h1>Whoops!</h1>

        <p>That page appears to be lost somewhere! Try the following pages - they never get lost!</p>
        @if(Auth::user())
            <a class='button login' href='{{ url("user/profile") }}'>Your Profile</a>
            <a class='button register' href='{{ url("topic") }}'>List of Topics</a>
            <a class='button login' href='{{ url("topics/random") }}'>Random Topic</a>
        @else
            <a class='button login' href='{{ url("login") }}'>Login</a>
            <a class='button register' href='{{ url("register") }}'>Register</a>
        @endif
    </div>
@endsection