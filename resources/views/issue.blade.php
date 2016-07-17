@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="essay_details">
                <p>Essay written by <a href="{{ url('user/profile/'.$issue->user->id) }}">{{ $issue->user->name }}</a> on {{ $issue->created_at->toFormattedDateString() }}</p>
                <a class="well" href="{{ url('topic/'.$issue->question_id) }}">
                        {{ $issue->question["question-text"] }}
                        <span class='instructions'>
                            {{ $issue->question["instructions"] }}
                        </span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body essay-text">
                    {!! nl2br(htmlentities($issue->body)) !!}
                </div>
            </div>
        </div>
    </div> 
    <div class="row">
       
        <div id="disqus_thread"></div>
        <script>
            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
            */

            var disqus_config = function () {
                this.page.identifier = "0_"+{{ $issue->id }};                   // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };

            (function() {  // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                
                s.src = '//getglib.disqus.com/embed.js';
                
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

    </div>
</div>
<script id="dsq-count-scr" src="//getglib.disqus.com/count.js" async></script>
@endsection
