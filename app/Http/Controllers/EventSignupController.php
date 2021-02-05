<?php

namespace App\Http\Controllers;

use App\EventEtudiant;
use Illuminate\Http\Request;
use App\Event;

class EventSignupController extends Controller
{
    public function sub(Request $request) {
        $studentId = $request->studentId;
        $eventId = $request->eventId;

        $combo = new EventEtudiant();
        $combo->etudiant_id = $studentId;
        $combo->event_id = $eventId;

        // $event = Event::where('id', $eventId)->get();
        $event = Event::find($eventId);
        $event->placesRestantes = $event->placesRestantes - 1;
        $event->save();
        $combo->save();
    }

    public function unsub(Request $request) {
        $studentId = $request->studentId;
        $eventId = $request->eventId;

        $combo = EventEtudiant::where([['etudiant_id', $studentId], ['event_id', $eventId]])->get(['id', 'etudiant_id', 'event_id']);
        if(count($combo) > 0) {
            $event = Event::find($eventId)/*->get(['id','title','start', 'end', 'places', 'placesRestantes', 'description'])*/;
            $event->placesRestantes = $event->placesRestantes + 1;
            $event->save();
            $toDel = EventEtudiant::find($combo[0]["id"]);
            $toDel->delete();
        }
    }
}
