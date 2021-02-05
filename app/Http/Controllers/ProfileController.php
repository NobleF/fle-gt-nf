<?php


namespace App\Http\Controllers;

use App\Activity;
use App\FileStorage;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class ProfileController extends Controller
{
    public function __construct(){

    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * View profil
     */
    public function index(Request $request){

        $user = Auth::user();
        $previous_uploads = FileStorage::all()->where('user_id', $user->id);

        $activities = app('App\Http\Controllers\ActivitiesController')->getActivities($user->id);

        $total = $activities['total_time'];
        unset($activities['total_time']);

        return view('profiles.index', compact('activities', 'previous_uploads', 'total'))
            ->with(['user' => $user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * Update user
     */
    public function update(Request $request){

        $id = Auth::user()->getAuthIdentifier();

        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'role' => 'required|integer|min:0|max:1',
        ]);

        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('profile')
            ->with('success','Modification enregistrée avec succès');

    }

}
