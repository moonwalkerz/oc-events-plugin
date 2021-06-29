<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartinimultimediaEventsVenues extends Migration
{
    public function up()
    {
        Schema::create('martinimultimedia_events_venues', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name');
            $table->text('excerpt');
            $table->text('descrtiption');
            $table->text('points');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('martinimultimedia_events_venues');
    }
}
