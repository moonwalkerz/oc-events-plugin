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

    public $showAttachments;
    public $customIcon;
    public $marker;
    public $markerShadow;

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
                'title'       => 'moonwalkerz.events::lang.components.page.slug',
                'description' => 'moonwalkerz.events::lang.components.page.slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
            'y' => [
                'title'       => 'moonwalkerz.events::lang.components.page.y',
                'description' => 'moonwalkerz.events::lang.components.page.y_description',
                'default'     => '{{ :y }}',
                'type'        => 'string'
            ],
            'm' => [
                'title'       => 'moonwalkerz.events::lang.components.page.m',
                'description' => 'moonwalkerz.events::lang.components.page.m_description',
                'default'     => '{{ :m }}',
                'type'        => 'string'
            ],
            'd' => [
                'title'       => 'moonwalkerz.events::lang.components.page.d',
                'description' => 'moonwalkerz.events::lang.components.page.d_description',
                'default'     => '{{ :d }}',
                'type'        => 'string'
            ],
            'baseCss' => [
                'title'       => 'moonwalkerz.events::lang.components.page.base_css',
                'description' => 'moonwalkerz.events::lang.components.pahe.base_css_description',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Styles',
            ],
            'showAttachments' => [
                'title'       => 'moonwalkerz.events::lang.components.page.show_attachments',
                'description' => 'moonwalkerz.events::lang.components.pahe.show_attachments_description',
                'type'        => 'checkbox',
                'default'     => 1,
                'group'       => 'Styles',
            ],
            'customIcon' => [
                'title'       => 'moonwalkerz.events::lang.components.page.custom_icon',
                'description' => 'moonwalkerz.events::lang.components.page.custom_icon_description',
                'type'        => 'checkbox',
                'default'     => 0,
                'group'       => 'Map',
            ],
            'marker' => [
                'title'       => 'moonwalkerz.events::lang.components.page.marker',
                'description' => 'moonwalkerz.events::lang.components.page.marker_description',
                'default'     => 'marker.png',
                'type'        => 'string',
                'group'       => 'Map',
            ],
            'markerShadow' => [
                'title'       => 'moonwalkerz.events::lang.components.page.marker_shadow',
                'description' => 'moonwalkerz.events::lang.components.page.marker_description',
                'default'     => 'marker-shadow.png',
                'type'        => 'string',
                'group'       => 'Map',
            ],

        ];
    }

    public function onRun()
    {
        if($this->property('baseCss')){
            $this->addCss('assets/css/events.css');
        }
        

        $this->addCss("assets/leaflet/leaflet.css");
        $this->addJs("assets/leaflet/leaflet.js");
        $this->addCss("assets/leaflet-routing-machine/leaflet-routing-machine.css");
        $this->addJs("assets/leaflet-routing-machine/leaflet-routing-machine.js");
        $this->addCss("assets/leaflet-control-geocoder/Control.Geocoder.css");
        $this->addJs("assets/leaflet-control-geocoder/Control.Geocoder.min.js");

        $this->customIcon=$this->page['customIcon'] = $this->property('customIcon');
        $this->marker=$this->page['marker'] = $this->property('marker');
        $this->markerShadow=$this->page['markerShadow'] = $this->property('markerShadow');

        $this->page['showAttachments'] = $this->property('showAttachments');
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
        $y = $this->property('y');
        $m = $this->property('m');
        $d = $this->property('d');
        $event = new E;
              $event = $event->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $event->transWhere('slug', $slug)
            : $event->where('slug', $slug);
        //verify if published
        //verify if date is set
        if ($y && $m && $d) {
            $event = $event->whereYear('date_from', $y)
                ->whereMonth('date_from', $m)
                ->whereDay('date_from', $d);
        };
        $event = $event->with('venue')->first();
        
        
  
        return $event;
    }



}
