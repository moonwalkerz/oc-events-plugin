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
            'moonwalkerz.events.access_events.create' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events.create',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 201,
            ],
            'moonwalkerz.events.access_events.update' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events.update',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 202,
            ],
            'moonwalkerz.events.access_events.delete' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events.delete',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 203,
            ],
            
            'moonwalkerz.events.access_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_venues',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 240,
            ],
            'moonwalkerz.events.access_venues.create' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_venues.create',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 241,
            ],
            'moonwalkerz.events.access_venues.update' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_venues.update',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 242,
            ],
            'moonwalkerz.events.access_venues.delete' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_venues.delete',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 243,
            ],
            
            'moonwalkerz.events.access_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 280,
            ],
            'moonwalkerz.events.access_categories.create' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories.create',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 281,
            ],
            'moonwalkerz.events.access_categories.update' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories.update',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 282,
            ],
            'moonwalkerz.events.access_categories.delete' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories.delete',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 283,
            ],
            
            'moonwalkerz.events.access_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 320,
            ],
            'moonwalkerz.events.access_tags.create' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags.create',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 321,
            ],
            'moonwalkerz.events.access_tags.update' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags.update',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 322,
            ],
            'moonwalkerz.events.access_tags.delete' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags.delete',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 323,
            ]
            
            
        ];
    }

}
