<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMartinimultimediaEventsEvents extends Migration
{
    public function up()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->boolean('published')->nullable();
            $table->boolean('featured')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->dropColumn('published');
            $table->dropColumn('featured');
        });
    }
}
