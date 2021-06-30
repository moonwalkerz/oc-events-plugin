<?php namespace MartiniMultimedia\Events\Models;

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
    public $table = 'martinimultimedia_events_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsToMany = [
        'events' => ['MartiniMultimedia\Events\Models\Event',
            'table' => 'martinimultimedia_events_categories_events',
            'order' => 'published_at desc',
//            'scope' => 'isPublished'
        ]
    ];
    
}
