@extends('layouts.app')

@section('content')
    <div class="container donation_station">
        <h2>Donate to Glib</h2>
        <p>
            Hosting, maintaing the code base, and other related expenses grow expensive. It is only with the support of users {{ (Auth::user()) ? '(like yourself, '.explode(" ", Auth::user()->name)[0].')' : '' }} that I can continue to run Glib. Any amount helps to keep the (proverbial) lights on, and ensures that students today - and into the future - have this as a resource and a community to come to. 
        </p>
        <p>
            I very much appreciate the fact that as a student money is often hard to come by. Further, resources tend to cost a lot while studying for the GRE as is. That is why I hope to keep Glib free and open for any (and every-) one to use. I just ask that if you have something to give, and have found Glib to be a useful resource in your GRE prep, to do so. Thank you very much! 
        </p>
        <p>
            If you have any questions, comments, or concerns, please feel free to reach me at <a href="mailto:getglib@gmail.com">getglib@gmail.com</a>. I am always happy to hear from everyone!
        </p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="S6FTR788MZQG8">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
        <p>
            Donations are managed through PayPal.
        </p>

    </div>
@endsection