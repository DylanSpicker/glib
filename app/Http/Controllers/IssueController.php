<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;
use App\Issue;
use Auth;
use Session;
use App\Http\Requests;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return the main view
        return view('pages.issue');
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
            $topic = Topics::where('type', 0)->orderByRaw("RAND()")->first();
            
        } while (Issue::where("question_id", $topic->id)->where("user_id",Auth::user()->id)->count() > 0);

        return view('pages.create.issue')->with("topic", $topic);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('issue') || ! $request->user()){
            return redirect()->to('user/profile')->withErrors(["Something went wrong. It appears that you did not actually enter an argument."]);
        }

        if(!$request->has('is_public')){
            $is_public = 1;
        } else {
            $is_public = $request->is_public;
        }

        $issue_text  = $request->issue;
        $user_id     = $request->user()->id;
        $issue_id    = $request->issueId;

        $issue              = new Issue;
        $issue->body        = $issue_text;
        $issue->user_id     = $user_id;
        $issue->question_id = $issue_id;
        $issue->is_public   = $is_public;

        if($issue->save()){
            Session::flash("message", "Your issue essay has been saved.");
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
        $issue = Issue::find($id);
        
        return view('issue')->with('issue', $issue);
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
        $issue = Issue::find($id);
        
        if($issue->user_id == Auth::user()->id){
            foreach($issue->comments() AS $comment){
                foreach($comment->replies() AS $reply){
                    $reply->delete();
                }
                $comment->delete();
            }

            $issue->delete();
        }

        Session::flash("message", "Your issue essay has been removed.");
        return redirect('user/profile');
    }
}
