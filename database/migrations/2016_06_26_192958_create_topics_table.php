<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('question-text', 1000);
            $table->string('instructions', 1000);
            $table->timestamps();
        });

        $file = base_path('data/Argument.csv');

        $query = "LOAD DATA LOCAL INFILE '" . $file . "'
                    INTO TABLE topics
                    FIELDS TERMINATED BY '||'
                    LINES STARTING BY 'XXXXXXX '
                        (`type`, 
                        `question-text`, 
                        `instructions`,
                        @created_at,
                        @updated_at)
                SET created_at=NOW(),updated_at=null";
        DB::connection()->getpdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
