<?php namespace MartiniMultimedia\Events;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'MartiniMultimedia\Events\Components\EventList' => 'eventList',
            'MartiniMultimedia\Events\Components\EventPage' => 'eventPage'
    ];
    }

    public function registerSettings()
    {
    }
}
