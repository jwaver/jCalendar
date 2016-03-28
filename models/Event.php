<?php namespace Jwaver\jCalendar\Models;

use Model;
use Input;
use Response;
use BackendAuth;
use \Carbon\Carbon;


/**
 * event Model
 */
class Event extends Model
{


    public $table = 'jwaver_calendar_events';
    
    protected $guarded = [];
    
    protected $fillable = [];

    /**
    * @var array Relations
    */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user' => ['Backend\Models\User']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public static function events(){
        // dump(BackendAuth::getUser()->id);
        // dump(Input::get('start'));
        // dump(Input::get('end'));

        
        $events = Event::select(['name','title','description','start','end','options'])
        ->where('user_id',BackendAuth::getUser()->id)
        ->where('start','>=',Carbon::createFromFormat('Y-m-d', Input::get('start')))
        ->get()
        ->toArray();
        
        $events = array_map(function($event){
            $option = json_decode($event['options']);
            // $event['className']          = true;
            $event['backgroundColor']   = $option->backgroundColor;
            $event['borderColor']       = $option->backgroundColor;
            $event['textColor']         = $option->textColor;
            $event['allDay']            = true;
            return $event;
        },$events);
        
        return $events;
    }

    
}