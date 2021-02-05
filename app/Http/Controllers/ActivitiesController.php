<?php


namespace App\Http\Controllers;


use App\Activity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller {

    public function __construct(){

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * Add activities
     */
    public function add(Request $request){

        $this->validate($request, [
            'activities_name' => 'required',
            'language' => 'required',
            //'activities_ressource' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'user_id' => 'required'
        ]);

        $input = $request->all();
        //$input['user_id'] = Auth::user()->getAuthIdentifier();

        if(empty($input['teacher_commentaire'])) {
            $input['teacher_commentaire'] = "";
        }

        if(empty($input['user_commentaire'])) {
            $input['user_commentaire'] = "";
        }

        //dd($input); //Debug

        Activity::create($input);


        return back()->with('success', 'Activité ajouté');

    }

    public function getActivities($user_id){
        /**
         * @param $tmp
         * @return array
         */
        function convertTS($tmp) {
            $retour = array();

            $retour['second'] = $tmp % 60;

            $tmp = floor( ($tmp - $retour['second']) /60 );
            $retour['minute'] = $tmp % 60;

            $tmp = floor( ($tmp - $retour['minute'])/60 );
            $retour['hour'] = $tmp % 24;

            $tmp = floor( ($tmp - $retour['hour'])  /24 );
            $retour['day'] = $tmp;

            return $retour;
        }

        $activities = Activity::all()->where('user_id', $user_id);
        $total=0;

        /**
         * time spent
         */
        foreach($activities as $keys => $data){
            $tmp = abs(strtotime($data->start_date) - strtotime($data->end_date));
            $total += $tmp;

            $activities[$keys]['time'] = convertTS($tmp);
        }

        $activities['total_time'] = convertTS($total);

        return $activities;

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Show one activities
     */
    public function show($id)
    {
        $activitie = Activity::where('id', $id)->firstOrFail();

        return view('activities.show',compact('activitie'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Edit activities
     */
    public function edit($id)
    {
        $activitie = Activity::where('id', $id)->firstOrFail();

        $activitie->start_date = str_replace(" ","T",$activitie->start_date);
        $activitie->end_date = str_replace(" ","T",$activitie->end_date);

        return view('activities.edit',compact('activitie'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * Update activities
     */
    public function update(Request $request, $id){
        $this->validate($request, [
            'activities_name' => 'required',
            'language' => 'required',
            //'activities_ressource' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $input = $request->all();

        if(empty($input['teacher_commentaire'])) {
            $input['teacher_commentaire'] = "";
        }

        if(empty($input['user_commentaire'])) {
            $input['user_commentaire'] = "";
        }

        DB::table('activities')->where('id', $id)->update($input);

        $activitie = Activity::where('id', $id)->firstOrFail();

        return redirect()->route('activities.show',$activitie->id)->with('success', 'Activité mise à jour');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Delete activities => Delete permanently from the database
     */
    public function destroy($id){

        Activity::find($id)->delete();
        return back()->with('success', 'Activité supprimé');
    }

}
