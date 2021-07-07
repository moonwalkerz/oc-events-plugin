<?php namespace Martinimultimedia\Events\Components;

use Redirect;
use BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use MartiniMultimedia\Events\Models\Event as E;
use Input;
use Log;

/**
 * EventList Component
 */

class EventList extends ComponentBase
{

    public $events;

    /**
    * Reference to the page name for linking to posts.
    * @var string
    */
   public $eventPage;

   public $pageParam;
   public $pageNumber;
   public $paginate;
   public $timeline;
   public $categories;

   public $no_event_text;

    /**
    * If the post list should be ordered by another attribute.
    * @var string
    */
   public $sortOrder;


    public function componentDetails()
    {
        return [
            'name'        => 'martinimultimedia.events::lang.components.list.name',
            'description' => 'martinimultimedia.events::lang.components.list.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'martinimultimedia.events::lang.components.list.page_number',
                'description' => 'martinimultimedia.events::lang.components.list.page_number_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'eventsPerPage' => [
                'title'             => 'martinimultimedia.events::lang.components.list.events_per_page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'martinimultimedia.events::lang.components.list.events_per_page_validation',
                'default'           => '10',
            ],
            'skip' => [
                'title'             => 'martinimultimedia.events::lang.components.list.skip',
                'description' => 'martinimultimedia.events::lang.components.list.skip_description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'martinimultimedia.events::lang.components.list.skip_validation',
                'default'           => '0',
            ],
            'paginate' => [
                'title'             => 'martinimultimedia.events::lang.components.list.paginate',
                'description'       => 'martinimultimedia.events::lang.components.list.paginate_description',
                'type'              => 'dropdown',
                'default'           => '1',
            ],
            'timeline' => [
                'title'             => 'martinimultimedia.events::lang.components.list.timeline',
                'description'       => 'martinimultimedia.events::lang.components.list.timeline_description',
                'type'              => 'dropdown',
                'default'           => '1',
            ],
            'sortOrder' => [
                'title'       => 'martinimultimedia.events::lang.components.list.events_order',
                'description' => 'martinimultimedia.events::lang.components.list.events_order_description',
                'type'        => 'dropdown',
                'default'     => 'date_from asc'
            ],
            'eventPage' => [
                'title'       => 'martinimultimedia.events::lang.components.list.event_page',
                'description' => 'martinimultimedia.events::lang.components.list.event_page_description',
                'type'        => 'dropdown',
                'default'     => 'event/post',
                'group'       => 'Links',
            ],
            'categories' => [
                'title'       => 'martinimultimedia.events::lang.components.list.categories',
                'description' => 'martinimultimedia.events::lang.components.list.categories_description',
                'type'        => 'string',
                'default'     => '{{ :categories }}',
            ],
        ];
    }

    public function getEventPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Options array for the pagination dropdown.
     *
     * @return array
     */
    public function getPaginateOptions()
    {
        return [
                0 => trans('martinimultimedia.events::lang.components.list.paginator_none'),
                1 => trans('martinimultimedia.events::lang.components.list.paginator_full'),
                2 => trans('martinimultimedia.events::lang.components.list.paginator_incremental'),
            ];
    }

    /**
     * Options array for the timeline dropdown.
     *
     * @return array
     */
    public function getTimelineOptions()
    {
        return [
                0 => trans('martinimultimedia.events::lang.components.list.timeline_all'),
                1 => trans('martinimultimedia.events::lang.components.list.timeline_next'),
                2 => trans('martinimultimedia.events::lang.components.list.timeline_prev'),
            ];
    }

    public function getSortOrderOptions()
    {
        return E::$allowedSortingOptions;
    }


    public function onRender()
    {        
        $this->prepareVars();
        
        if ($this->paginate) {
        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');
            if ($currentPage > ($lastPage = $this->events->lastPage()) && $currentPage > 1)
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
            }
        }
    }
    /**
     * Paginate the result set.
     *
     * @param Collection $items
     * @param int        $totalCount
     *
     * @return LengthAwarePaginator
     */
    protected function onLoadMore()
    {
        try {
            

            $this->prepareVars();
        } catch (ModelNotFoundException $e) {
            return $this->controller->run('404');
        }

        if ($this->pageNumber >= ($lastPage = $this->events->lastPage()) && $this->pageNumber > 1)
        return [
            '#loadmore' => '',
            '@#events' => $this->renderPartial('@items.htm'),
        ];

        return [
            '#loadmore' => $this->renderPartial('@loadmore.htm'),
            '@#events' => $this->renderPartial('@items.htm'),
        ];
    }




    protected function prepareVars()
    {

        
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        
        if (Input::get('pageNumber')) {
        $this->pageNumber = $this->page['pageNumber'] =Input::get('pageNumber');
        } else {
        $this->pageNumber = $this->page['pageNumber'] =  $this->property('pageNumber')?$this->property('pageNumber'):1;
        }
        $this->paginate = $this->page['paginate'] = $this->property('paginate');
        $this->timeline = $this->page['timeline'] = $this->property('timeline');
        $this->categories = $this->page['categories']=$this->property('categories');
        $this->no_event_text = $this->page['no_event_text'] = trans('martinimultimedia.events::lang.components.list.no_events');
        $this->eventPage = $this->page['eventPage'] = $this->property('eventPage');
        $this->events = $this->page['events'] = $this->listEvents();

        //Log::info($this->paginate." ".$this->paramName('paginate')."-".$this->property('paginate') );
        /*
         * Page links
         */

    }

    protected function listEvents()
    {
        //$lifestyle = $this->lifestyle ? $this->lifestyle->id : null;
        /*
         * List all the posts, eager load their lifestyles
         */
        $isPublished = !$this->checkEditor();
        $events = E::listFrontEnd([
            'page'       => $this->pageNumber,
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $this->property('eventsPerPage'),
            'skip'       => $this->property('skip'),
            'timeline'   => $this->property('timeline'),
            'paginate'   => $this->property('paginate'),
            'categories'    => array_map('trim',explode(",",$this->property('categories'))),
            'search'     => trim(input('search'))
        ]);
        /*
         * Add a "url" helper attribute for linking to each post and lifestyle
         */
        $events->each(function($event) {
            $event->setUrl($this->eventPage, $this->controller);
        });


        return $events;
    }
    
    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();
        return $backendUser && $backendUser->hasAccess('martinimultimedia.press.access_events');
    }

}
