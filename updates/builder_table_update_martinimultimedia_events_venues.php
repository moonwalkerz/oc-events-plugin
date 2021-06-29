<?php namespace MartiniMultimedia\Events\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMartinimultimediaEventsVenues extends Migration
{
    public function up()
    {
        Schema::table('martinimultimedia_events_venues', function($table)
        {
            $table->string('slug')->nullable();
            $table->string('name', 255)->nullable()->change();
            $table->text('excerpt')->nullable()->change();
            $table->text('descrtiption')->nullable()->change();
            $table->text('points')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('martinimultimedia_events_venues', function($table)
        {
            $table->dropColumn('slug');
            $table->string('name', 255)->nullable(false)->change();
            $table->text('excerpt')->nullable(false)->change();
            $table->text('descrtiption')->nullable(false)->change();
            $table->text('points')->nullable(false)->change();
        });
    }
}
