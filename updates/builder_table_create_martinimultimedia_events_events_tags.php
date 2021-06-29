<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartinimultimediaEventsTagsEvents extends Migration
{
    public function up()
    {
        //Schema::dropIfExists('martinimultimedia_events_events_tags');
        Schema::create('martinimultimedia_events_events_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('tag_id');
            $table->bigInteger('event_id');
            $table->primary(['event_id','tag_id'],'events_tags');

        });
    }
    
    public function down()
    {
        Schema::dropIfExists('martinimultimedia_events_events_tags');
    }
}
