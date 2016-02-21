<?php namespace Jwaver\Calendar\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use BackendAuth;
use Request;
use Input;
use Response;
use URL;
use Storage;
use File;
use Config;
use Faker\Factory as Faker;
use Jwaver\Calendar\Plugin;



class Index extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    protected $assetsPath = '/plugins/Jwaver/Calendar/assets';
    protected $eventFile = "calendar.event.json";

    public function __construct(){
        parent::__construct();
    
        BackendMenu::setContext('Jwaver.Calendar', 'calendar', 'index');
        
        $this->addCss($this->assetsPath.'/css/fullcalendar.css');
        $this->addCss($this->assetsPath.'/css/jquery-ui.css');
        $this->addCss($this->assetsPath.'/css/style.css');
        $this->addJs($this->assetsPath.'/js/fullcalendar.js');
        $this->addJs($this->assetsPath.'/js/bootbox.min.js');
        $this->addJs($this->assetsPath.'/js/jquery-ui.js');
        $this->addJs($this->assetsPath.'/js/script.js');
        dd( Plugin::pluginDetails() );
        $this->vars['version'] = (new Plugin())->pluginDetails()['version'];
    }

    public function onAddEvent(){

        $this->eventFile = BackendAuth::getUser()->toArray()['login'].".calendar.event.json";

        //Create defaults
        IF( !File::exists(storage_path('app/'.$this->eventFile)) )
        {
            $event = [
                'Breakfast',
                'Lunch',
                'Dinner',
                'Meeting',
            ];
            Storage::put($this->eventFile, json_encode($event)); 
        }

        $event = json_decode(Storage::get($this->eventFile));
        if(Input::get('event')!='')
        $event[] = post('event');
        $this->eventList = $event;
        return Storage::put($this->eventFile, json_encode($event)); 

    }
    
    public function onEvent(){
        return [
            'partialContents' => $this->makePartial('event', [
                'event' => Input::All()
            ])
        ];
        return json_encode(Input::All());
    }
    
    public function getEventList(){
        return json_decode(Storage::get($this->eventFile));
    }
    
    
}