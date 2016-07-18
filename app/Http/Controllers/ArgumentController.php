<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;
use App\Argument;
use Auth;
use Session;
use App\Http\Requests;

class ArgumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return the main view
        return view('pages.argument');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create form view
        do {
            $topic = Topics::where('type', 1)->orderByRaw("RAND()")->first();
            
        } while (Argument::where("question_id", $topic->id)->where("user_id",Auth::user()->id)->count() > 0);

        return view('pages.create.argument')->with("topic", $topic);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('argument') || ! $request->user()){
            return redirect()->to('user/profile')->withErrors(["Something went wrong. It appears that you did not actually enter an argument."]);
        }

        $is_public = 1;

        $argument_text  = $request->argument;
        $user_id        = $request->user()->id;
        $argument_id    = $request->argumentId;

        $argument              = new argument;
        $argument->body        = $argument_text;
        $argument->user_id     = $user_id;
        $argument->question_id = $argument_id;
        $argument->is_public   = $is_public;

        if($argument->save()){
            Session::flash("message", "Your argument essay has been saved!");
            return redirect()->to('user/profile');  
        }

        return redirect()->to('user/profile')->withErrors(["Something went wrong. Sorry - not sure at all what went wrong."]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $argument = Argument::find($id);
        
        return view('argument')->with('argument', $argument);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $argument = Argument::find($id);
        
        if($argument->user_id == Auth::user()->id){
            foreach($argument->comments() AS $comment){
                foreach($comment->replies() AS $reply){
                    $reply->delete();
                }
                $comment->delete();
            }

            $argument->delete();
        }

        Session::flash("message", "Your argument essay has been removed.");

        return redirect('user/profile');
    }
}
