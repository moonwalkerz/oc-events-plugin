<?php namespace MoonWalkerz\Events\Components;

use Redirect;
use BackendAuth;
use Cms\Classes\ComponentBase;
use MoonWalkerz\Events\Models\Event as E;

/**
 * Event Component
 */
class EventPage extends ComponentBase
{
    public $event;

    public function componentDetails()
    {
        return [
            'name'        => 'moonwalkerz.events::lang.components.page.name',
            'description' => 'moonwalkerz.events::lang.components.page.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'moonwalkerz.events::lang.componens.page.slug',
                'description' => 'moonwalkerz.events::lang.componens.page.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'y' => [
                'title'       => 'moonwalkerz.events::lang.componens.page.y',
                'description' => 'moonwalkerz.events::lang.componens.page.y_description',
                'default'     => '{{ :y }}',
                'type'        => 'string'
            ],
            'm' => [
                'title'       => 'moonwalkerz.events::lang.componens.page.m',
                'description' => 'moonwalkerz.events::lang.componens.page.m_description',
                'default'     => '{{ :m }}',
                'type'        => 'string'
            ],
            'd' => [
                'title'       => 'moonwalkerz.events::lang.componens.page.d',
                'description' => 'moonwalkerz.events::lang.componens.page.d_description',
                'default'     => '{{ :d }}',
                'type'        => 'string'
            ]


        ];
    }

    public function onRun()
    {
        $this->addCss("assets/leaflet/leaflet.css");
        $this->addJs("assets/leaflet/leaflet.js");
        $this->addCss("assets/leaflet-routing-machine/leaflet-routing-machine.css");
        $this->addJs("assets/leaflet-routing-machine/leaflet-routing-machine.js");
        $this->addCss("assets/leaflet-control-geocoder/Control.Geocoder.css");
        $this->addJs("assets/leaflet-control-geocoder/Control.Geocoder.min.js");


        $event = $this->loadEvent();
        if (!$event || !$event->exists) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
           }
    
        $this->event = $this->page['event'] = $event;
        $this->page['title'] = $event->title;
    }

    protected function loadEvent()
    {
        $slug = $this->property('slug');
        $event = new E;
        $event = $event->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $event->transWhere('slug', $slug)
            : $event->where('slug', $slug);
        //verify if published
        $event = $event->with('venue')->first();
        return $event;
    }



}
