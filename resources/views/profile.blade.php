@extends('layouts.app')

@section('content')
<?php
    if(!isset($_GET['issues'])){
        $_GET['issues'] = 1;
    }
    if(!isset($_GET['arguments'])){
        $_GET['arguments'] = 1;
    }
?>
<div class="container">
    @if(!empty($error))
        <div class="row alert alert-warning error-msg">
            <h2>{{ $error }}</h2>
            
            @if(Auth::user())
                <p>
                    If you'd like, clicking <a href='{{ route("profile") }}'>here</a> will take you to your profile!
                </p>
            @else
                <p>
                    If you'd like, clicking <a href='{{ url("login") }}'>here</a> will let you login! 
                </p>
            @endif
        </div>
    @else
        @if(count($errors) > 0)
            <p class="alert alert-danger">{{ $errors->first() }}</p>
        @endif
        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }}'s Profile</div>

                    <div class="panel-body">
                        <h2>{{ (Auth::id() == $user->id) ? "Your" : $user->name."'s" }} Issue Essay{{ ($issues->count() > 1) ? "s" : "" }} </h2>
                        <div class="list-group">
                            @if($issues->count() <= 0)
                                @if(Auth::id() == $user->id)
                                    <p>You have not currently written any issue essays... <a href='{{ route("issue.index") }}'>Write one today!</a></p>
                                @else
                                    <p>{{ $user->name }} has not written any issue essays.</p>
                                @endif
                            @else 
                                @foreach($issues as $issue)
                                    <div class="list-group-item issue_list">
                                        <a class="pull-left" href="{{ url('issue/'.$issue->id) }}">
                                            {{ str_limit($issue->question["question-text"], 90) }} 
                                        </a>
                                        <a class="pull-right" href="{{ url('topic/'.$issue->question_id) }}">
                                            <i data-id="{{ $issue->id }}" class="edit fa fa-button fa-eye"></i>
                                            View Other Responses
                                        </a>
                                        <span class="clearfix"></span>
                                        
                                        @if(Auth::id() == $user->id)
                                            {{ Form::open(['class' => 'delete_button', 'method' => 'delete', 'url' => 'issue/'.$issue->id]) }}
                                                <button title="Delete Essay?" class='btn btn-danger'><i class='fa fa-btn fa-times'></i></button>
                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                @endforeach
                                {{  $issues->appends(['arguments' => $_GET["arguments"]])->links() }}
                            @endif
                        </div>

                        <h2>{{ (Auth::id() == $user->id) ? "Your" : $user->name."'s" }} Argument Essay{{ ($arguments->count() > 1) ? "s" : "" }} </h2>
                        <div class="list-group">
                            @if($arguments->count() <= 0)
                                @if(Auth::id() == $user->id)
                                    <p>You have not currently written any argument essays... <a href='{{ route("argument.index") }}'>Write one today!</a></p>
                                @else
                                    <p>{{ $user->name }} has not written any argument essays.</p>
                                @endif
                            @else  
                                @foreach($arguments as $argument)
                                    <div class="list-group-item argument_list">
                                        <a class="pull-left" href="{{ url('argument/'.$argument->id) }}">
                                            {{ str_limit($argument->question["question-text"], 90) }} 
                                        </a>
                                        <a class="pull-right" href="{{ url('topic/'.$argument->question_id) }}">
                                            <i data-id="{{ $argument->id }}" class="edit fa fa-button fa-eye"></i>
                                            View Other Responses
                                        </a>
                                        <span class="clearfix"></span>
                                        @if(Auth::id() == $user->id)
                                            {{ Form::open(['class' => 'delete_button', 'method' => 'delete', 'url' => 'argument/'.$argument->id]) }}
                                                <button title="Delete Essay?" class='btn btn-danger'><i class='fa fa-btn fa-times'></i></button>
                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                @endforeach
                                {{  $arguments->appends(['issues' => $_GET['issues']])->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
