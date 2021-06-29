<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMartinimultimediaEventsEvents extends Migration
{
    public function up()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->boolean('allday')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('martinimultimedia_events_events', function($table)
        {
            $table->dropColumn('date_from');
            $table->dropColumn('date_to');
            $table->dropColumn('allday');
        });
    }
}
