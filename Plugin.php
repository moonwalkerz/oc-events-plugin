<?php namespace MoonWalkerz\Events;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public $require = [
        'RainLab.Translate',
        'Inetis.ListSwitch'
    ];

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

    public function registerPermissions()
    {
        return [
            'moonwalkerz.events.access_events' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 200,
            ],
            
            'moonwalkerz.events.access_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_venues',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 240,
            ],
            
            'moonwalkerz.events.access_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 280,
            ],
            
            'moonwalkerz.events.access_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 320,
            ]
            
            
        ];
    }

}
