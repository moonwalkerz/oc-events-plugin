<?php namespace MartiniMultimedia\Events\Models;

use Model;

use Carbon\Carbon;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['date_from','date_to','deleted_at','created_at','updated_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'martinimultimedia_events_events';


    public $jsonable = ['contacts'];

    public $fillable=['name','published'];


    /**
     * @var array Validation rules
     */
    public $rules = [
        'name'=>'required',
        'excerpt'=>'required'
    ];
    public $belongsTo = [
        'venue'=> 'MartiniMultimedia\Events\Models\Venue'
    ];

    public $belongsToMany = [
        'categories' => [
            Category::class,
            'table' => 'martinimultimedia_events_categories_events',
            'key'      => 'category_id',
            'otherKey' => 'event_id',
            'order' => 'title'
        ],
        'tags' => [
            Tag::class,
            'table' => 'martinimultimedia_events_events_tags',
            'key'      => 'tag_id',
            'otherKey' => 'event_id'            
            
        ]
    ];


    public $attachMany = [
        'images' => 'System\Models\File',
        'attachments' => 'System\Models\File'
    ];

    public static $allowedSortingOptions = [

        'date_from asc' => 'From (ascending)',
        'date_from desc' => 'From (descending)',
        'date_to asc' => 'To (ascending)',
        'date_to desc' => 'To (descending)',
        'name asc' => 'Name (ascending)',
        'name desc' => 'Name (descending)',
        'created_at asc' => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc' => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
        'random' => 'Random'
    ];

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
//        $params['id'] = $this->id;
        $params['y'] = $this->date_from->format('Y');
        $params['m'] = $this->date_from->format('m');
        $params['d'] = $this->date_from->format('d');
        $params['slug'] = $this->slug;

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    /**
     * Used to test if a certain user has permission to edit post,
     * returns TRUE if the user is the owner or has other posts access.
     * @param User $user
     * @return bool
     */
    public function canEdit(User $user)
    {
        return ($this->user_id == $user->id) || $user->hasAnyAccess(['rainlab.blog.access_other_posts']);
    }

    //
    // Scopes
    //

    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
        ;
    }
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Lists events for the front end
     *
     * @param        $query
     * @param  array $options Display options
     *
     * @return Event
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'       => 1,
            'perPage'    => 30,
            'skip'       => 0,
            'timeline'   => 1,
            'categories'    => '',
            'sort'       => 'date_from',
            'search'     => '',
            'paginate'  => true,
            'exceptPost' => null,
        ], $options));

        $searchableFields = ['name', 'slug',  'content'];

        $query->with('venue');
        $query->with('tags');
    //    if ($published) {
       //     $query->isPublished();
//        }

       // if ($featured_only) {
        //    $query->featured();
       // }

switch ($timeline) 
{
    case 1:
        //next events
        $query->where('date_from' ,'>=',Carbon::now());
        $query->orWhere('date_to' ,'>=',Carbon::now());
    break;
    
    case 2:
        //previous events
        $query->where('date_from','<',Carbon::now());
        $query->where('date_to','<',Carbon::now());
    break;
}
        /*
         * Sorting
         */
        if (!is_array($sort)) {
            $sort = [$sort];
        }

        foreach ($sort as $_sort) {

            if (in_array($_sort, array_keys(self::$allowedSortingOptions))) {
                $parts = explode(' ', $_sort);
                if (count($parts) < 2) {
                    array_push($parts, 'desc');
                }
                list($sortField, $sortDirection) = $parts;
                if ($sortField == 'random') {
                    $sortField = Db::raw('RAND()');
                }
                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
        * filter by categories
        */
        //dd($categories);
        if(!empty($categories)&&!empty($categories[0])) {
            $query->whereHas('categories', function($q) use ($categories){
              //  dd($categories);
                $q->whereIn('slug', $categories);
            }); 
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

      
        //if ($skip) {
        //}
        //Log::info('skip'.$skip." ".$query->paginate($perPage, $page)->toSql());
        //dd();
        switch ($paginate) {
            case 0:
                return $query->get();
            break;
            case 1:
                return $query->paginate($perPage, $page);
                //return $query->get();
            break;
            case 2:
                return $query->paginate($perPage, $page);
                //return $query->get();
            break;
        }
        //if ($paginate) {
        
            
        //}   else {
        //    $query->skip($skip);
         //   $query->take($perPage);
    
           // return $query->get();
        //}
        
        
    }

    //
    // Options
    //

    public function getTagsArrayOptions($value, $formData)
    {
        return Tag::all()->lists('name');
    }

    public function getTagsStringOptions($value, $formData)
    {
        return self::getTagsArrayOptions($value, $formData);
    }

    public function getTagsArrayIdOptions($value, $formData)
    {
        return Tag::all()->pluck('name', 'id')->toArray();
    }

    public function getTagsStringIdOptions($value, $formData)
    {
        return self::getTagsArrayIdOptions($value, $formData);
    }



}
