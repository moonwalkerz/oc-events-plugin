<?php namespace Moonwalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMoonwalkerzEventsCategories extends Migration
{
    public function up()
    {
        Schema::dropIfExists('moonwalkerz_events_categories');
        Schema::create('moonwalkerz_events_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->index();
            $table->text('description')->nullable();
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->DateTime('created_at')->nullable();
            $table->DateTime('updated_at')->nullable();
        });

    }
    
    public function down()
    {
        Schema::dropIfExists('moonwalkerz_events_categories');
    }
}
