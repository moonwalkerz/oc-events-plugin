<?php namespace MartiniMultimedia\Press\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartiniMultimediaEventsCategoriesEvents extends Migration {

    public function up()
    {
        Schema::dropIfExists('martinimultimedia_events_categories_events');
        Schema::create('martinimultimedia_events_categories_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('category_id');
            $table->bigInteger('event_id');
            $table->primary(['category_id','event_id'],'categories_events');
        });

    }
    
    public function down()
    {
        Schema::dropIfExists('martinimultimedia_events_categories_events');
    }
}
