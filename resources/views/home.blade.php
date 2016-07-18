@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="dash_board">
            <h4>Your Essay Statistics</h4>
            <div class="statistics">
                <h1>
                    <span class="num">{{ Auth::user()->issues()->count() }}</span>
                    <span class="title">Issue Essays</span>
                    <a href="{{ url('user/profile') }}" class="btn btn-xs btn-default">View</a>
                </h1>
                <h1>
                    <span class="num">{{ Auth::user()->arguments()->count() }}</span>
                    <span class="title">Argument Essays</span>
                    <a href="{{ url('user/profile') }}" class="btn btn-xs btn-default">View</a>
                </h1>
                <h1>
                    <span class="title">Since last Issue Essay</span>
                    @if(Auth::user()->issues()->count())
                        <span class="diff">{{ Auth::user()->issues()->orderBy("created_at", "DESC")->first()->created_at->diffForHumans() }}</span>
                        <a href="{{ url('issue/'.Auth::user()->issues()->orderBy("created_at", "DESC")->first()->id) }}" class="btn btn-xs btn-default">View</a>
                    @else
                        <span class="diff">Never</span>
                    @endif
                </h1>
                <h1>
                    <span class="title">Since last Argument Essay</span>

                    @if( Auth::user()->arguments()->count() )   
                        <span class="diff">{{ Auth::user()->arguments()->orderBy("created_at", "DESC")->first()->created_at->diffForHumans() }}</span>
                        <a href="{{ url('argument/'.Auth::user()->arguments()->orderBy("created_at", "DESC")->first()->id) }}" class="btn btn-xs btn-default">View</a>
                    @else
                        <span class="diff">Never</span>
                    @endif
                </h1>

                <div class="button_holder">
                    <p>
                        <a class="btn" href="{{ url('topic') }}">View all Topics</a>
                    </p>
                    <p>
                        <a class="btn" href="{{ url('topics/random') }}">View Random Topic</a>
                    </p>
                    <p>
                        <a class="btn" href="{{ url('issue') }}">Start an Issue Essay</a>
                    </p>
                    <p>
                        <a class="btn" href="{{ url('argument') }}">Start an Argument Essay</a>
                    </p>
                    <p>
                        <a class="btn" href="{{ url('user/profile') }}">Your Profile</a>
                    </p>
                </div>
            </div>
        </div>
        <p class='footer_text'>
            This site was created by <a href="http://dylanspicker.com/" target="_BLANK">Dylan Spicker</a>, a student at Queen's University in Ontario, Canada who is (or was) studying for the GRE. With no good, test-like practice applications for the AW section of the GRE, he decided to write his own. This may have been partly out of the goodness of his heart, but was more likely due to an overwhelming desire to procrastinate his studies. Hopefully this resource is helpful for you and those that you know who are also studying. If you are able to, <a href="{{ url('donate') }}">donations</a> (of any amount) are greatly appreciated to assist with the costs of hosting and running the website. I would like to be able to keep this as a free resource, long after I am done needing it, but in order to do so it must not be costing me too much. Please direct any feedback to <a href="mailto:getglib@gmail.com">getglib@gmail.com</a> - all comments are welcome and appreciated.
        </p>
    </div>
@endsection
