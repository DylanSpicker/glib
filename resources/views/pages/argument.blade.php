@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Argument Essay</div>

                <div class="panel-body">
                    <h2>About the Argument Essay</h2>

                    <p><strong>From the official GRE website: </strong><br />
                    Each Issue topic consists of an issue statement or statements followed by specific task instructions that tell you how to respond to the issue. The wording of some topics in the test might vary slightly from what is presented here. Also, because there may be multiple versions of some topics with similar or identical wording but with different task instructions, it is very important to read your test topic and its specific task directions carefully and respond to the wording as it appears in the actual test. 
                    <br /><a target="_BLANK" href="https://www.ets.org/gre/revised_general/prepare/analytical_writing/issue/pool">Read More...</a></p>

                    <h2>About this Tool</h2>
                    <p>I designed this tool during my time studying for the GRE to try to replicate test day. The interface is designed based off of the prep software that I had at my disposal (though as of now I cannot promise that this software is modeled precisely after what is available on test day, it should give the same general feeling). The topics are all selected from the pool provided by ETS (link above), which is supposed to be an exhaustive list of the possible topics on test day. You will have half an hour to write your essay, at which point the timer will end and you will not be able to write anymore. At that point (or before if you finish), you will be able to run it through a spell/grammar checker, export it for your personal use, or share it to make it publically accessible. You will also be able to view the essays that other people have made public on the same topic to see how your writing compares, making comments and such.</p>
                    <p>We are all in this together. I hope that, overtime, this becomes not only an excellent resource for practicing, but also  a great community in which studying is made more enjoyable!</p>

                    <a href="{{ route('argument.create') }}" class="btn btn-primary">Start your Essay</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
