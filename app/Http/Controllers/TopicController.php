<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics; 
use App\Issue;
use App\Argument;
use App\Http\Requests;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Select and then list all of the topics that are possible to write about
        $issues = Topics::where("type", 0)->orderBy("question-text", "ASC")->paginate(15);
        $arguments = Topics::where("type", 1)->orderBy("question-text", "ASC")->paginate(15);
        
        return view('pages.topics', compact('issues', 'arguments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show a single topic, and then all of the responses to that topic that have been generated to date
        $topic_details = Topics::find($id);

        if($topic_details->type !== 0){
            $user_submissions = Argument::where("question_id", $id)->paginate(15);
        }else{
            $user_submissions = Issue::where("question_id", $id)->paginate(15);
        }

        return view('pages.view.topic', compact('topic_details', 'user_submissions'));

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
        //
    }
}
