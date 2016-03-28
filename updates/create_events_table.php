<?php namespace Jwave\jCalendar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{

    public function up()
    {
        if(!Schema::hasTable('jwaver_calendar_events'))
        Schema::create('jwaver_calendar_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('name');
            $table->string('title');
            $table->string('description');
            $table->json('options');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Schema::dropIfExists('jwaver_calendar_events');
    }

}
