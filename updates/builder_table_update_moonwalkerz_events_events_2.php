<?php namespace MoonWalkerz\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMoonWalkerzEventsEvents2 extends Migration
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
