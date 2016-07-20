@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>About Glib</h2>
        <p class="about_spiel">
            Glib was created by <a href="http://dylanspicker.com/" target="_BLANK">Dylan Spicker</a>, a student at Queen's University in Ontario, Canada who is (or was) studying for the GRE. With no good, test-like practice applications for the AW section of the GRE, he decided to write his own. This may have been partly out of the goodness of his heart, but was more likely due to an overwhelming desire to procrastinate his studies. Hopefully this resource is helpful for you and those that you know who are also studying. If you are able to, <a href="{{ url('donate') }}">donations</a> (of any amount) are greatly appreciated to assist with the costs of hosting and running the website. I would like to be able to keep this as a free resource, long after I am done needing it, but in order to do so it must not be costing me too much. Please direct any feedback to <a href="mailto:hello@getglib.com">hello@getglib.com</a> - all comments are welcome and appreciated.
        </p>
    </div>
@endsection