<?php namespace Moonwalkerz\Events\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\NestedTree;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'moonwalkerz_events_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'events' => ['Moonwalkerz\Events\Models\Event',
            'table' => 'moonwalkerz_events_categories_events',
            'key'      => 'event_id',
            'otherKey' => 'category_id',
            'order' => 'published_at desc',
//            'scope' => 'isPublished'
        ]
    ];
    
}
