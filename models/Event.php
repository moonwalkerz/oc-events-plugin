<?php namespace MartiniMultimedia\Events\Models;

use Model;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'martinimultimedia_events_events';


    public $jsonable = ['contacts'];

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
            'order' => 'title'
        ],
        'tags' => [
            Tag::class,
            'table' => 'martinimultimedia_events_events_tags'
            
            
        ]
    ];


    public $attachMany = [
        'images' => 'System\Models\File',
        'attachments' => 'System\Models\File'
    ];
}
