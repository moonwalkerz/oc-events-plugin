<?php namespace Moonwalkerz\Events\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Flash;
use Moonwalkerz\Events\Models\Event;
class Events extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
        ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'moonwalkerz.events.access_events',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Moonwalkerz.Events', 'events-item', 'side-event-item');
    }

    public function clone($id)
    {
        $original = Event::where("id", $id)
                    ->with('attachments')
                    ->with('images')
                    ->with('categories')
                    ->with('tags')
                    ->first();

        $attachments = array_merge(
            array_keys($original->attachOne),
            array_keys($original->attachMany)
        );
        

        $clone = $original->replicate();
        $clone->fill([
            'name' => trans('moonwalkerz.events::lang.form.copy')." ".$clone->name,
            'published' => false
        ]);

        $clone->save();
        $this->cloneAttachments($clone, $original, $attachments);

        $this->cloneBelongsToMany($clone, $original, ['categories','tags']);

        Flash::success('Event cloned');

        return \Redirect::back();
    }

    private function cloneBelongsToMany(Event $clone, Event $original,$relations)
    {
        foreach ($relations as $relation) {
            foreach( $original->{$relation} as $rel){
                $clone->{$relation}()->save($rel);
            }
        }
    }

    private function cloneAttachments(Event $clone, Event $original, array $attachments)
    {
        foreach ($attachments as $attachment) {
            $fileModel = new \System\Models\File;
            $temp = $original->{$attachment};
    
            if (is_null($temp)) {
                continue;
            }
   
            if ($temp instanceof \October\Rain\Database\Collection) {

                $temp->each(function($item) use ($attachment, $clone) {
                    $fileModel = new \System\Models\File;
                    $fileModel->fromFile($item->getLocalPath());
                    $fileModel->file_name = $item->file_name;
                    $clone->{$attachment}()->save($fileModel);
                });
            } 
            
            if ($temp instanceof \System\Models\File) {

                $clone->{$attachment}()->save($fileModel->fromFile($temp->getLocalPath()));
            }
        }
    
        return $clone;
    }


}
