<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartinimultimediaEventsVenues extends Migration
{
    public function up()
    {
        Schema::dropIfExists('martinimultimedia_events_venues');
        Schema::create('martinimultimedia_events_venues', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('name')->nullable();
	    $table->string('slug')->nullable();
	    $table->text('excerpt')->nullable();

            $table->text('descrtiption')->nullable();
            $table->text('points')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('martinimultimedia_events_venues');
    }
}
