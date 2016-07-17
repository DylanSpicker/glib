<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Argument extends Model
{
    protected $table = 'arguments';
    
    // Returns the USER that this belongs to
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Returns the QUESTION that this belongs to
    public function question()
    {
        return $this->belongsTo('App\Topics', 'question_id');
    }

    // Returns the comments that the argument hash
    public function comments()
    {
        $comments = Comment::where("parent_type", 1)->where("parent_id", $this->id)->orderBy('created_at', 'DESC')->get();
        
        return $comments;
    }
}
