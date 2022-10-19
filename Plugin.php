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

    public function registerPermissions()
    {
        return [
            'moonwalkerz.events.access_events' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 200,
            ],
            'moonwalkerz.events.edit_events' => [
                'label' => 'moonwalkerz.events::lang.permissions.edit_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 210,
            ],
            'moonwalkerz.events.create_events' => [
                'label' => 'moonwalkerz.events::lang.permissions.create_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 220,
            ],
            'moonwalkerz.events.delete_events' => [
                'label' => 'moonwalkerz.events::lang.permissions.delete_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 230,
            ],
            'moonwalkerz.events.access_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_events',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 240,
            ],
            'moonwalkerz.events.edit_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.edit_venues',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 250,
            ],
            'moonwalkerz.events.create_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.create_venues',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 260,
            ],
            'moonwalkerz.events.delete_venues' => [
                'label' => 'moonwalkerz.events::lang.permissions.delete_venues',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 270,
            ],
            'moonwalkerz.events.access_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 280,
            ],
            'moonwalkerz.events.edit_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.edit_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 290,
            ],
            'moonwalkerz.events.create_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.create_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 300,
            ],
            'moonwalkerz.events.delete_categories' => [
                'label' => 'moonwalkerz.events::lang.permissions.delete_categories',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 310,
            ],
            'moonwalkerz.events.access_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.access_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 320,
            ],
            'moonwalkerz.events.edit_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.edit_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 330,
            ],
            'moonwalkerz.events.create_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.create_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 340,
            ],
            'moonwalkerz.events.delete_tags' => [
                'label' => 'moonwalkerz.events::lang.permissions.delete_tags',
                'tab' => 'moonwalkerz.events::lang.permissions.events_tab',
                'order' => 350,
            ]
            
            
        ];
    }

}
