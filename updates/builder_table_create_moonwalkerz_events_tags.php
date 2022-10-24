<?php namespace MoonWalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMoonWalkerzEventsTags extends Migration
{
    public function up()
    {
        Schema::dropIfExists('moonwalkerz_events_tags');
        Schema::create('moonwalkerz_events_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('moonwalkerz_events_tags');
    }
}
