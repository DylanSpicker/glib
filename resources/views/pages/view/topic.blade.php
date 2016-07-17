@extends('layouts.app')

@section('content')

<div class="container">
    @if($topic_details->type !== 0)
        <h4>GRE Argument Topic</h4>
    @else
        <h4>GRE Issue Topic</h4>
    @endif
    <p><a href="{{ url('topic') }}" class="btn btn-primary">View all Topics</a></p>
    <p>{{ $topic_details['question-text'] }}</p>

    @if($user_submissions->total() <= 0)
        <p>No one has currently written on this topic.</p>
    @endif
    
    <div class="user_submission_holder">
        @foreach($user_submissions AS $story)
            <div class="user_submission">
                <p>Written by <a href='{{ url("user/profile/".$story->user->id) }}'>{{ $story->user->name }}</a></p>
                <p class='well'>{{ str_limit($story->body, 250) }} </p>
                <a class='more' href='{{ ($story->question->type === 0) ? url("issue/".$story->id) : url("argument/".$story->id) }}'>Read More</a>
            </div>
        @endforeach
    </div>

    <p class="links">{{ $user_submissions->links() }}</p>
</div>

@endsection
