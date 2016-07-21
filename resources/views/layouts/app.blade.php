<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Glib</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    <style>
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-81135406-1', 'auto');
    ga('send', 'pageview');

    </script>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    Glib
                    <span class="tagline"> | The Place to Practice GRE Analytical Writing</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/home') }}">Home</a></li>
                        <li><a href="{{ url('/issue') }}">Start an Issue Essay</a></li>
                        <li><a href="{{ url('/argument') }}">Start an Argument Essay</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('user/profile') }}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                <li><a href="{{ url('topic') }}"><i class="fa fa-btn fa-list"></i> Topics</a></li>
                                <li><a href="{{ url('about') }}"><i class="fa fa-btn fa-question-circle"></i> About</a></li>
                                <li><a href="{{ url('donate') }}"><i class="fa fa-btn fa-money"></i> Donate</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

        <script>
        
        $("a.rate").on("click", function(){
            var rateId = $(this).data("id"),
                clicked = $(this),
                rating = $(this).data("rating"),
                value  = parseInt($(this).html(), 10);

            $.ajax({
                url: $(this).attr("href")+"?ajax=true",
                success: function(d){
                    console.log(d);
                    if(rating == 0) clicked.html(value + 1 + " <i class='fa fa-btn fa-thumbs-up'></i>");
                    else clicked.html(value + 1 + " <i class='fa fa-btn fa-thumbs-down'></i>");
                }
            });

            return false;
            
        });

        $(".toggle_reply").on("click", function(){
            var replyId = $(this).data("id");

            if(! $(".replies[data-comment-id='"+replyId+"']").is(":visible")){
                $(".replies[data-comment-id='"+replyId+"']").slideDown();
            } else {
                $(".replies[data-comment-id='"+replyId+"']").slideUp();
            }
        });

        $(".add_quotation").on("click", function(){
            var data_for = $(this).data("for"),
                textarea = $("textarea[data-input-id="+data_for+"]"),
                pos      = textarea.val().length + 2;

            textarea.val(textarea.val() + '[""]');

            textarea.focus();
            textarea[0].setSelectionRange(pos, pos);
            return false;
        });

        $("textarea[name='comment']").on("keyup", function(){
            var data_for    = $(this).data("input-id"),
                preview     = $(".preview[data-for='"+data_for+"']"),
                dataString  = $(this).val().replace(/\[\"\"\]/g,""),
                previewString = $("<div />").text(dataString).html()
                                        .replace(/\n/g,"<br>")
                                        .replace(/\[\"/g, "<p class='well'>")
                                        .replace(/\"\]/g, "</p>");

                    
                
            preview.html(previewString);
            $(this).val(dataString);
            $(this).css('height', preview.css('height'));


        });
        
        // Trigger if the page is a GRE page

        

       if($(".gre-header").length){
            // Warn that the timer will begin immediately 
                alert("The timer will begin as soon as you click 'Ok' ! ");

                var hours   = 0;
                var minutes = 30;
                var seconds = 0;
                var total   = hours*60*60 + minutes*60 + seconds;

                var essayTimer = window.setInterval(function(){
                    --total;

                    if(total <= 0){
                        clearInterval(essayTimer);
                        $("textarea.essay-text").prop("disabled", "true");
                    }

                    hours = Math.floor(total/3600).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
                    minutes = Math.floor((total - hours*3600)/60).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});
                    seconds = Math.floor((total - hours*3600 - minutes*60)).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping:false});

                    $("span.timer").html(hours + " : " + minutes + " : " + seconds);
                }, 1000);

                // Handle button clicks
                $("button.next").on("click", function(){
                    console.log("CLICKER");
                    if(confirm("This will stop your progress and you will not be able to come back and edit further. Are you sure you're done?")){
                        clearInterval(essayTimer);
                        $(".essayForm").submit();
                    }
                });
                $("button.time-btn").on("click", function(){
                    // console.log("CLICKED");
                    if($("span.timer").is(":visible")){
                        // Hide the Timer
                        $("span.timer").hide();
                        $(this).text("Show Time");
                    } else {
                        // Re-Show the Timer
                        $("span.timer").show();
                        $(this).text("Hide Time");
                    }
                });
        }

    </script>
</body>
</html>
