<?php namespace MoonWalkerz\Events;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'MoonWalkerz\Events\Components\EventList' => 'eventList',
            'MoonWalkerz\Events\Components\EventPage' => 'eventPage'
    ];
    }

    public function registerSettings()
    {
    }
}
