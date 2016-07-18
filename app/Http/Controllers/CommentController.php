<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Rating;
use Auth;
use Session;
use App\Http\Requests;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(!isset($request->_parent_type) || empty($request->_parent_id) || empty($request->_checksum) || md5("".$request->_parent_type."_GLIB_RULES_".$request->_parent_id) != $request->_checksum){
            return back()->withInput()->withErrors(["Do not alter that. Uncool dude..."]);
        }

        if(empty($request->comment)){
            return back()->withInput()->withErrors(["Please enter a comment!"]);
        }

        $comment = new Comment;
        $comment->user_id       = Auth::user()->id;
        $comment->parent_id     = $request->_parent_id;
        $comment->parent_type   = $request->_parent_type;
        $comment->body          = $request->comment;
        $comment->likes         = 0;
        $comment->dislikes      = 0;    
        $comment->save();

        Session::flash("success", "Your comment was added!");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $comment = Comment::find($id);

        if(Auth::user()->id == $comment->user_id){

            foreach($comment->replies() AS $reply){
                $reply->delete();
            }

            $comment->delete();
            Session::flash("success", "Your comment has been removed.");
        }

        return back();
    }

    /**
     * Add a rating to the specified resource
     *
     * @param  int  $id
     * @param  int  $rating [0 = +, 1 = -1]
     */
     public function rate($id, $rating)
     {
        $user_id    = Auth::id();
        $comment    = Comment::find($id);
        $user_rated = Rating::where("user_id", $user_id)->where("comment_id", $id)->get();
        $rating     = (int)$rating;
        // Look for whether the user has rated
        // If so: if "$user_rated->rating == $rating" => Return
        // Otherwise: if "$user_rated->rating != $rating" => Update $user_rated->rating; subtract 1 from current; add to other
        // Else, add rating
        if($user_rated->count()){
            if($user_rated->first()->rating == $rating) return back();
            $user_rated = $user_rated->first();
            $user_rated->rating = $rating;

            if($rating == 0){
                $comment->likes += 1;
                $comment->dislikes -= 1;
                if($comment->dislikes < 0) $comment->dislikes = 0;
            }else if($rating == 1){
                $comment->likes -= 1;
                $comment->dislikes += 1;
                if($comment->likes < 0) $comment->likes = 0;
            }else{
                return back();
            }
        } else {
            $user_rated = new Rating();
            $user_rated->rating    = $rating;
            $user_rated->user_id    = $user_id;
            $user_rated->comment_id = $id; 

            if($rating == 0){
                $comment->likes += 1;
            }else if($rating == 1){
                $comment->dislikes += 1;
            }else{
                return back();
            }
        }

        $user_rated->save();
        $comment->save();

        return back();
     }
}
