<?php namespace Moonwalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMoonwalkerzEventsEvents2 extends Migration
{
    public function up()
    {
        Schema::table('moonwalkerz_events_events', function($table)
        {
            $table->boolean('canceled')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('moonwalkerz_events_events', function($table)
        {
            $table->dropColumn('canceled');
        });
    }
}
