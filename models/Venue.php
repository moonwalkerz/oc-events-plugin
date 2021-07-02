<?php namespace MartiniMultimedia\Events\Models;

use Model;

/**
 * Model
 */
class Venue extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'martinimultimedia_events_venues';

    public $jsonable = [
    'points'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name'=>'required'
    ];

    public $attachMany = [
        'images' => 'System\Models\File',
        'attachments' => 'System\Models\File'
    ];
}
