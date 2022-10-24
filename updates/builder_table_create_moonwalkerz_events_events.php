<?php namespace MoonWalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMoonWalkerzEventsEvents extends Migration
{
    public function up()
    {
        Schema::dropIfExists('moonwalkerz_events_events');
        Schema::create('moonwalkerz_events_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->text('contacts')->nullable();
            $table->integer('venue_id')->nullable();
            $table->boolean('allday')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('moonwalkerz_events_events');
    }
}
