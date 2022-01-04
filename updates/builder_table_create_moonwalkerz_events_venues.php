<?php namespace MoonWalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMoonWalkerzEventsVenues extends Migration
{
    public function up()
    {
        Schema::dropIfExists('moonwalkerz_events_venues');
        Schema::create('moonwalkerz_events_venues', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->text('points')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('moonwalkerz_events_venues');
    }
}
