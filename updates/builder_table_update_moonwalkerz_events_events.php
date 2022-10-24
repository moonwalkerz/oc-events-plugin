<?php namespace Moonwalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMoonwalkerzEventsEvents extends Migration
{
    public function up()
    {
        Schema::table('moonwalkerz_events_events', function($table)
        {
            $table->boolean('published')->nullable();
            $table->boolean('featured')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('moonwalkerz_events_events', function($table)
        {
            $table->dropColumn('published');
            $table->dropColumn('featured');
        });
    }
}
