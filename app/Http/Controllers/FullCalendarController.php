<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\EventEtudiant;
use App\User;
use Illuminate\Support\Facades\Mail;

class FullCalendarController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end', 'places', 'description']);
            //  return response()->json($data);
            $resp = new Response();
            $resp->setContent($data);

            return $resp;
        }
        return view('fullcalendar');
    }


    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end,
                       'places' => $request->places,
                       'placesRestantes' => $request->placesRestantes,
                       'description' => $request->description
                    ];
        $event = Event::insert($insertArr);
        // return Response::json($event);
        // return response()->json($event);
        $resp = new Response();
        $resp->setContent($event);

        return $resp;
    }


    public function update(Request $request)
    {
        $event = Event::find($request->id);

        $placesRestantes = -1;

        if($event->places != $request->places) {
            if($event->places > $request->places) {
                $eventsCombo = EventEtudiant::where('event_id', $request->id)->get();
                foreach($eventsCombo as $evt) {
                    $etudiant = User::find($evt["etudiant_id"]);
                    $etu_mail = $etudiant->email;

                    $date = explode(" ", $event->start);
                    $jour = explode("-", $date[0]);
                    $heure = explode(":", $date[1]);

                    $details = [
                        'subject' => "Vous avez été désinscrit du cours $event->title",
                        'title' => "Vous avez été désinscrit du cours $event->title",
                        'body' => "Le cours $event->title prévu pour le $jour[2]/$jour[1]/$jour[0] à $heure[0]h$heure[1] a subi une modification ayant nécessité votre désinscription (réduction du nombre de places total). "
                    ];

                    Mail::to($etu_mail)->send(new \App\Mail\UnsubbedMailer($details));

                    $curr_combo = EventEtudiant::find($evt['id']);
                    $curr_combo->delete();
                }
                $placesRestantes = $request->places;
            }

            else {
                $placesRestantes = $event->placesRestantes + ($request->places - $event->places);
            }
        }

        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end, 'places' => $request->places, 'description' => $request->description, 'placesRestantes' => $placesRestantes];
        $event  = Event::where($where)->update($updateArr);

        $resp = new Response();
        $resp->setContent($event);

        return $resp;
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();

        // return Response::json($event);
        // return response()->json($event);
        $resp = new Response();
        $resp->setContent($event);

        return $resp;
    }

    public function show($id) {
        if(request()->ajax()) {
            $event = Event::where('id', $id)->get(['id','title','start', 'end', 'places', 'placesRestantes', 'description']);
            $resp = new Response();
            $userId = Auth::id();
            $isSub = false;

            $eventStud = EventEtudiant::where([['etudiant_id', $userId], ['event_id', $id]])->get(['id', 'etudiant_id', 'event_id']);

            if(count($eventStud) > 0) {
                $isSub = true;
            }

            $ret = [$event, $isSub];
            $resp->setContent($ret);

            return $resp;
        }

        return view('fullcalendar');
    }
}
