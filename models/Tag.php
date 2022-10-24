<?php namespace Moonwalkerz\Events\Models;

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
    public $table = 'moonwalkerz_events_tags';

    public $timestamps=false;
   /**
     * @var array Relations
     */
    public $belongsToMany = [
        'events' => [
            Event::class,
            'table'=>'moonwalkerz_events_events_tags',
            'key'      => 'event_id',
            'otherKey' => 'tag_id'
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
        'name' => 'required|unique:moonwalkerz_events_tags'
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
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {

        ray($controller);
        $params['tags'] = $this->slug;

        
        return $this->url = $controller->pageUrl($pageName, $params);
    }


        /**
     * Convert tag names to lower case
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtolower($value);
    }

}
