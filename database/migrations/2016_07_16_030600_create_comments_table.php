<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');     // User ID
            $table->integer('parent_id');   // ID of Parent (Issue, Argument, OR Comment)
            $table->integer('parent_type'); // Type of PARENT (0 = Issue, 1 = Arugment, 2 = Comment)
            $table->text('body');           // Comment Body
            $table->integer('likes');       // Upvotes
            $table->integer('dislikes');    // Downvotes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
