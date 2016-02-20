<?php namespace Jwaver\Calendar;

use Backend;
use System\Classes\PluginBase;

/**
 * calendar Plugin Information File
 */
class Plugin extends PluginBase
{

    public function __construct(){
        
    }

    public function pluginDetails()
    {
        return [
            'name'          => 'calendar',
            'description'   => 'Change the way managing your Calendar.',
            'version'       => 'v2.6',
            'author'        => 'James Jomuad',
            'icon'          => 'icon-leaf',
            'url'           => 'www.jamesjomuad.com'
        ];
    }

    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Jwaver\Calendar\Components\MyComponent' => 'myComponent',
        ];
    }

    public function registerPermissions()
    {
        return [
            'jwaver.calendar.access' => [
                'tab' => 'Calendar',
                'label' => 'Show Calendar'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'calendar' => [
                'label'       => 'Calendar',
                'url'         => Backend::url('jwaver/calendar/index'),
                'icon'        => 'icon-calendar',
                'permissions' => ['jwaver.calendar.*'],
                'order'       => 6,
            ],
        ];
    }

}
