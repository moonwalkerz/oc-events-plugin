<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartinimultimediaEventsTags extends Migration
{
    public function up()
    {
        Schema::dropIfExists('martinimultimedia_events_tags');
        Schema::create('martinimultimedia_events_tags', function($table)
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
        Schema::dropIfExists('martinimultimedia_events_tags');
    }
}
