<?php

namespace MoonWalkerz\Events\Components;

use Redirect;
use BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use MoonWalkerz\Events\Models\Event as E;
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
    public $tags;
    public $tag;

    public $tagsPage;
    public $categoriesPage;

    public $no_event_text;

    /**
     * If the post list should be ordered by another attribute.
     * @var string
     */
    public $sortOrder;


    public function componentDetails()
    {
        return [
            'name'        => 'moonwalkerz.events::lang.components.list.name',
            'description' => 'moonwalkerz.events::lang.components.list.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'pageNumber' => [
                'title'       => 'moonwalkerz.events::lang.components.list.page_number',
                'description' => 'moonwalkerz.events::lang.components.list.page_number_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'eventsPerPage' => [
                'title'             => 'moonwalkerz.events::lang.components.list.events_per_page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'moonwalkerz.events::lang.components.list.events_per_page_validation',
                'default'           => '10',
            ],
            'skip' => [
                'title'             => 'moonwalkerz.events::lang.components.list.skip',
                'description' => 'moonwalkerz.events::lang.components.list.skip_description',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'moonwalkerz.events::lang.components.list.skip_validation',
                'default'           => '0',
            ],
            'paginate' => [
                'title'             => 'moonwalkerz.events::lang.components.list.paginate',
                'description'       => 'moonwalkerz.events::lang.components.list.paginate_description',
                'type'              => 'dropdown',
                'default'           => '1',
            ],
            'timeline' => [
                'title'             => 'moonwalkerz.events::lang.components.list.timeline',
                'description'       => 'moonwalkerz.events::lang.components.list.timeline_description',
                'type'              => 'dropdown',
                'default'           => '1',
            ],
            'sortOrder' => [
                'title'       => 'moonwalkerz.events::lang.components.list.events_order',
                'description' => 'moonwalkerz.events::lang.components.list.events_order_description',
                'type'        => 'dropdown',
                'default'     => 'date_from asc'
            ],
            'eventPage' => [
                'title'       => 'moonwalkerz.events::lang.components.list.event_page',
                'description' => 'moonwalkerz.events::lang.components.list.event_page_description',
                'type'        => 'dropdown',
                'default'     => 'event/post',
                'group'       => 'Links',
            ],
            'categories' => [
                'title'       => 'moonwalkerz.events::lang.components.list.categories',
                'description' => 'moonwalkerz.events::lang.components.list.categories_description',
                'type'        => 'string',
                'default'     => '{{ :categories }}',
            ],
            'categoriesPage' => [
                'title'       => 'moonwalkerz.events::lang.components.list.categories_page',
                'description' => 'moonwalkerz.events::lang.components.list.categories_page_description',
                'type'        => 'dropdown',
                'default'     => 'categories/post',
                'group'       => 'Links',
            ],
            'tags' => [
                'title'       => 'moonwalkerz.events::lang.components.list.tags',
                'description' => 'moonwalkerz.events::lang.components.list.tags_description',
                'type'        => 'string',
                'default'     => '{{ :tags }}',
            ],
            'tagsPage' => [
                'title'       => 'moonwalkerz.events::lang.components.list.tags_page',
                'description' => 'moonwalkerz.events::lang.components.list.tags_page_description',
                'type'        => 'dropdown',
                'default'     => 'tags/post',
                'group'       => 'Links',
            ],
        ];
    }

    public function getEventPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getCategoriesPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getTagsPageOptions()
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
            0 => trans('moonwalkerz.events::lang.components.list.paginator_none'),
            1 => trans('moonwalkerz.events::lang.components.list.paginator_full'),
            2 => trans('moonwalkerz.events::lang.components.list.paginator_incremental'),
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
            0 => trans('moonwalkerz.events::lang.components.list.timeline_all'),
            1 => trans('moonwalkerz.events::lang.components.list.timeline_next'),
            2 => trans('moonwalkerz.events::lang.components.list.timeline_prev'),
        ];
    }

    public function getSortOrderOptions()
    {
        return E::$allowedSortingOptions;
    }


    public function onRun()
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
            $pg = intval(Input::get('pageNumber'));
            if ($pg < 1) {
                $pg = 1;
            };
            $this->pageNumber = $this->page['pageNumber'] = $pg;
        } else {
            $pg = intval($this->property('pageNumber'));
            if ($pg < 1) {
                $pg = 1;
            };
            $this->pageNumber = $this->page['pageNumber'] = $pg;
        }

    
        $this->paginate = $this->page['paginate'] = $this->property('paginate');
        $this->timeline = $this->page['timeline'] = $this->property('timeline');
        $this->categories = $this->page['categories'] = $this->property('categories');
        $this->tags = $this->page['tags'] = $this->property('tags');

        $this->no_event_text = $this->page['no_event_text'] = trans('moonwalkerz.events::lang.components.list.no_events');
        $this->eventPage = $this->page['eventPage'] = $this->property('eventPage');
        $this->tagsPage = $this->page['tagsPage'] = $this->property('tagsPage');
        $this->categoriesPage = $this->page['categoriesPage'] = $this->property('categoriesPage');
        $this->events = $this->page['events'] = $this->listEvents();

        //Log::info($this->paginate." ".$this->paramName('paginate')."-".$this->property('paginate') );
        /*
         * Page links
         */
    }

    protected function listEvents()
    {

        /*
         * List all the events
         */

       
        $options = [
            'page'       => $this->pageNumber,
            'sort'       => $this->property('sortOrder'),
            'perPage'    => $this->property('eventsPerPage'),
            'skip'       => $this->property('skip'),
            'timeline'   => $this->property('timeline'),
            'paginate'   => $this->property('paginate'),
            'categories'    => !empty($this->property('categories'))?array_map('trim', str_contains($this->property('categories'),',')?explode(",", $this->property('categories')):[$this->property('categories')]):[],
            'tags'    => !empty($this->property('tags'))?array_map('trim', str_contains($this->property('tags'),',')?explode(",", $this->property('tags')):[$this->property('tags')]):[],
            'search'     => trim(input('search'))
        ];
        //ray($this->property('tags'));
        //ray(str_contains($this->property('tags'),',')?explode(",", $this->property('tags')):[$this->property('tags')]);
        //ray($options);
        $events = E::listFrontEnd($options);

        /*
         * Add a "url" helper attribute for linking to each post and lifestyle
         */
        $events->each(function ($event) {
        
            $event->setUrl($this->eventPage, $this->controller);
            $event->tags->each(function ($tag) {
        
                $tag->setUrl($this->tagsPage, $this->controller);
            });
        });

        

        return $events;
    }
}

