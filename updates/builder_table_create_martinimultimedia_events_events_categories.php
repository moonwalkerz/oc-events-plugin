<?php namespace MartiniMultimedia\Press\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMartinimultimediaEventsEventsCategories extends Migration
{
    public function up()
    {
        Schema::dropIfExists('martinimultimedia_events_events_categories');
        Schema::create('martinimultimedia_events_events_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('event_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['event_id', 'category_id'],'events_categories');
        });

    }
    
    public function down()
    {
        Schema::dropIfExists('martinimultimedia_events_events_categories');
    }
}
