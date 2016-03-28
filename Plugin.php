<?php namespace Jwaver\jCalendar;

use Backend;
use System\Classes\PluginBase;

/**
 * calendar Plugin Information File
 */
class Plugin extends PluginBase
{

    public function __construct(){
        // parent::__construct();
    }

    public function pluginDetails()
    {
        return [
            'name'          => 'jCalendar',
            'description'   => 'Change the way managing your Calendar.',
            'version'       => 'v2.7',
            'author'        => 'James Jomuad',
            'icon'          => 'icon-leaf',
            'url'           => 'https://github.com/jwaver/jCalendar'
        ];
    }

    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            '\Jwaver\jCalendar\Components\MyComponent' => 'myComponent',
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
                'url'         => Backend::url('jwaver/jCalendar/index'),
                'icon'        => 'icon-calendar',
                'permissions' => ['jwaver.calendar.*'],
                'order'       => 6,
            ],
        ];
    }

}
