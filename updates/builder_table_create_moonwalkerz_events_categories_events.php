<?php namespace MoonWalkerz\Press\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMoonWalkerzEventsCategoriesEvents extends Migration {

    public function up()
    {
        Schema::dropIfExists('moonwalkerz_events_categories_events');
        Schema::create('moonwalkerz_events_categories_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->bigInteger('category_id');
            $table->bigInteger('event_id');
            $table->primary(['category_id','event_id'],'categories_events');
        });

    }
    
    public function down()
    {
        Schema::dropIfExists('moonwalkerz_events_categories_events');
    }
}
