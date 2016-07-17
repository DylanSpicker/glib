@extends('layouts.app')

@section('content')
    <header class="gre-header">
        <h1>GRE Test Tool | Issue Essay</h1>
        
        <div class="logo">
            <img src="https://www.ets.org/rsc/img/logo/ets_logo.svg" alt="ETS" />
        </div>
        
        <h2>Question 1 of 2</h2>

        <div class="buttons">
            <button class="help">Help</button>
            <button class="next">Next</button>
        </div>

        <div class="time">
            <button class="time-btn">Hide Time</button>
            <span class="timer">00 : 30 : 00</span>
        </div>
    </header>
    <div class="contain">
        <aside class="question-text">
            <div class="question">
                {{ htmlentities($topic['question-text'], ENT_QUOTES, "UTF-8") }}
            </div> 
            <div class="question-instructions">
                {{ htmlentities($topic['instructions'], ENT_QUOTES, "UTF-8") }}
            </div>
        </aside>
        <section>
            <div class="controls">
                <button>Cut</button>
                <button>Paste</button>
                <button>Undo</button>
                <button>Redo</button>
            </div>
            <div class="response-area">
                {{ Form::open(array('class' => 'essayForm', 'route' => 'issue.store', 'method' => 'POST')) }}

                <textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" name="issue" id="issue" class="essay-text"></textarea>
                <input type="hidden" name="issueId" value="{{ $topic['id'] }}" />

                {{ Form::close() }}
            </div>
        </section>
    </div>
   
@endsection
