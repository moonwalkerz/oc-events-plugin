<?php namespace MoonWalkerz\Events\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Venues extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'moonwalkerz.events.access_venues',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('MoonWalkerz.Events', 'events-item', 'side-event-venue');
    }
}
