$(document).ready(function(){

    $('#sortable').sortable({revert: true});

    /*Init Draggable*/
    $('form#onAddEvent').request('onAddEvent', {
        update: {result: '.draggable-events'},
        complete: function(){ reDrag(); }
    });

    /*Init Calendar*/
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'prevYear title nextYear',
            right: 'year,month,agendaWeek,agendaDay'
        },
        height:650,
        selectable: true,
        defaultTimedEventDuration: '01:00:00',
        dayDoubleClick:function(){
            alert('double click!');
        },
        dayClick: function(date, jsEvent, view) {
            console.log('Day Click');
            if(view.name == 'month' || view.name == 'basicWeek') {
                $('#calendar').fullCalendar('changeView', 'agendaDay');
                $('#calendar').fullCalendar('gotoDate', date);      
            }
        },
        droppable: true,
        drop: function(date,allDay){

            var originalEventObject     = $(this).data('eventObject');
            var copiedEventObject       = $.extend({}, originalEventObject);
            copiedEventObject.start     = date;
            copiedEventObject.allDay    = allDay;
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            /* $.request('onEvent', {
                // data:  $('#calendar').fullCalendar('clientEvents'),
                complete: function(d){ console.log(d); }
            }); */
            /* $.ajax({
                url: '/octobercms/backend/jwaver/calendar/index',
                headers: { 'X-OCTOBER-REQUEST-HANDLER': 'onEvent' },
                type: 'POST',
                data: {events:$('#calendar').fullCalendar('clientEvents')},
                dataType: "json"
            }); */
        },
        editable: true,
        eventStartEditable: true,
        eventDurationEditable: true,
        eventLimit: true,
        eventSources: [{
            url: $("#calendar").data('base')+'/api/jwaver/calendar/events',
            type: 'get',
            error: function() {
                alert('there was an error while fetching events!');
            },
            color: '#EC6524',
            textColor: '#f0f0f0'
        }],
        eventClick:function( event, jsEvent, view ) {
            var eventDat = {};
            console.log(event);
            $.each(event,function( index, value ){
                eventDat[index] = " "+value;
                if(index=='_id')
                return false;
            });

            $.request('onEvent', {
                data:  eventDat,
                success: function(html){
                    var eventBox = bootbox.dialog({
                        message: html.partialContents,
                        title: event.title,
                        buttons: {
                            save: {
                                label: "Save",
                                className: "btn-default",
                                callback: function() {
                                    return false;
                                }
                            },
                            remove: {
                                label: "&nbsp;",
                                className: "btn-default icon-trash-o",
                                callback: function() {
                                    $('#calendar').fullCalendar( 'removeEvents', event._id);
                                    eventBox.modal('hide');
                                    return true;
                                }
                            }
                        }
                    });
                }
            });
            return false;
        },
        eventDrop:function(event,dayDelta,minuteDelta,allDay,revertFunc){
            console.log(event);
        },
        eventResize:function( event, delta, revertFunc, jsEvent, ui, view ) { 
            console.log(event);
        },
        eventDragStop: function( event, jsEvent, ui, view ) { 

        },
        eventMouseover: function (event, jsEvent) {
            /* $(this).mousemove(function (e) {
                var trashEl = jQuery('#calendarTrash');
                if (isElemOverDiv()) {
                    if (!trashEl.hasClass("to-trash")) {
                        trashEl.addClass("to-trash");
                    }
                } else {
                    if (trashEl.hasClass("to-trash")) {
                        trashEl.removeClass("to-trash");
                    }

                }
            }); */
        },
        eventRender:function (event, element){
            element.click(function(e){ e.preventDefault(); })
        },
        forceEventDuration: true,
        loading: function(){
            $('.loading-indicator-container').hide();
        },
    });

});



function reDrag(){
    
    $('#sortable-events').sortable({
        helper: 'clone',        
        placeholder: 'placeholder',
        start: function(ev, ui) {
            var eventObject = {
                title: $.trim($(ui.item).text()),
                color: ''+$(ui.item).css('backgroundColor')
            };
        
            // store the Event Object in the DOM element so we can get to it later
            $(ui.item).data('eventObject', eventObject);
            $(ui.item).data('dropped', false);

            return  true;      
        },
        stop: function(ev, ui) {
            // Restore place of Event Object if dropped
            if ( $(ui.draggable).data('dropped') == true ) {
                $('#sortable-events').nestedSortable('cancel'); 
                $(ui.draggable).data('dropped') = false ;
            }
        }
	}).disableSelection();

}







