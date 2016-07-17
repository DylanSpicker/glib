<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';

    public function parent(){
        if($this->parent_type === 0){
            return $this->belongsTo('App\Issue', 'parent_id');
        }else if($this->parent_type === 1){
            return $this->belongsTo('App\Argument', 'parent_id');            
        }else{
            return $this->belongsTo('App\Comment', 'parent_id');
        }
    }

    public function replies(){
        $replies = Comment::where("parent_type", 2)->where("parent_id", $this->id)->get();

        return $replies;
    }

    public function author(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
