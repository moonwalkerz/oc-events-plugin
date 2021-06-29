<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMartinimultimediaEventsEvents2 extends Migration
{
    public function up()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
