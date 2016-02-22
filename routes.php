<?php

use jwaver\Calendar\Models\Event;
// use \BackendAuth;



Route::group(['prefix' => 'api/jwaver/calendar/'], function () {
    /*
    * Serve Events for the Calendar
    * return: json
    */
    Route::any('events', function () {
        return \Response::json(Event::events());
    });

});

Route::get('jwaver/calendar/seed', function () {
    // (new jwaver\Calendar\Updates\SeedEvents())->run();
    (new jwaver\Calendar\Updates\SeedEvents())->test();
});

Route::get('jwaver/calendar/test', function () {
    dump(  BackendAuth::getUser()->toArray() );
});