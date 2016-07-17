@extends('layouts.app')

@section('content')
<?php
    if(!isset($_GET['view'])) $_GET['view'] = "arguments";
?>
<div class="container">

    <h4>
        All Possible Topics
    </h4>
    <p><a href="{{ url('topics/random') }}" class="btn btn-primary">View a Random Topic</a></p>
    <ul class="nav nav-tabs" role="tablist">
        <li class="{{ (isset($_GET['view']) && $_GET['view'] == 'arguments') ? 'active' : '' }}">
            @if(! isset($_GET['view']))
                <a href="?view=arguments">Arguments</a>
            @elseif(isset($_GET['page']) && $_GET['view'] == "arguments")
                <a href="?view=arguments&page={{$_GET['page']}}">Arguments</a>
            @else
                <a href="?view=arguments">Arguments</a>
            @endif
        </li>

        <li class="{{ (isset($_GET['view']) && $_GET['view'] == 'issues') ? 'active' : '' }}">
            @if(! isset($_GET['view']))
                <a href="?view=issues">Issues</a>
            @elseif(isset($_GET['page']) && $_GET['view'] == "issues")
                <a href="?view=issues&page={{$_GET['page']}}">Issues</a>
            @else
                <a href="?view=issues">Issues</a>
            @endif
        </li>
    </ul>

    <div class="arguments holder {{ (isset($_GET['view']) && $_GET['view'] == 'arguments') ? 'active' : '' }}">
        <ul class='list-group'>
            @foreach($arguments AS $argument)
                <li class="list-group-item"><a href="{{ url('topic/'.$argument->id) }}">{{ str_limit($argument["question-text"], 85) }}</a></li>
            @endforeach
        </ul>
        {{ $arguments->appends("view", "arguments")->links() }}

    </div>
    <div class="issues holder {{ (isset($_GET['view']) && $_GET['view'] == 'issues') ? 'active' : '' }}">
        <ul class='list-group'>
            @foreach($issues AS $issue)
                <li class="list-group-item"><a href="{{ url('topic/'.$issue->id) }}">{{ str_limit($issue["question-text"], 85) }}</a></li>
            @endforeach
        </ul>
        {{ $issues->appends("view", "issues")->links() }}

    </div>
</div>
@endsection
