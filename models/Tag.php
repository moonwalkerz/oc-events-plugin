<?php namespace MartiniMultimedia\Events\Models;

use Model;

/**
 * Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'martinimultimedia_events_tags';

    public $timestamps=false;
   /**
     * @var array Relations
     */
    public $belongsToMany = [
        'events' => [
            Event::class,
            'table'=>'martinimultimedia_events_events_tags'
        ]
    ];

    /**
     * @var array Fillable fields
     */
    public $fillable = [
        'name',
        'slug',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|unique:martinimultimedia_events_tags'
    ];

    /**
     * Before create.
     *
     * @return void
     */
    public function beforeCreate()
    {
        $this->setInitialSlug();
    }

    /**
     * Set the initial slug.
     *
     * @return void
     */
    protected function setInitialSlug()
    {
        $this->slug = str_slug($this->name);
    }
        /**
     * Convert tag names to lower case
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtolower($value);
    }

}
