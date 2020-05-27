<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Get all Events.
     *
     * @return array
     */
    public function index(Request $request) {
        try {
            $events = Event::all();
            return json_encode(['status' => 'success', 'events' => $events]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Create a Event.
     *
     * @return array
     */
    public function create(Request $request) {
        $title = $request->get('title');
        $start = $request->get('start');
        $end = $request->get('end');
        $allDay = $request->get('allDay');
        $url = $request->get('url');

        $event = new Event();
        $event->title = $title;
        $event->start = $start;
        $event->end = $end;
        $event->all_day = $allDay;
        $event->url = $url;

        try {
            $event->save();
            return json_encode(['status' => 'success', 'event' => $event]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * update a Event.
     *
     * @return array
     */
    public function update(Request $request) {
        $id = $request->get('id');
        $title = $request->get('title');
        $start = $request->get('start');
        $end = $request->get('end');
        $allDay = $request->get('allDay');
        $url = $request->get('url');

        $event = Event::find($id);

        if($allDay == 0) {
            $event->start = $start;
            $event->end = $end;
        }
        $event->all_day = $allDay;

        try {
            $event->save();
            return json_encode(['status' => 'success', 'event' => $event]);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
