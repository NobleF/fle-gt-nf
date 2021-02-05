<?php

namespace App\Http\Controllers;

use App\Activity;
use App\FileStorage;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller {

    /**
     * UserController constructor.
     */
    public function __construct(){
        $this->middleware('permission:user.list|user.create|user.edit|user.delete', ['only' => ['index','store','show']]);
        $this->middleware('permission:user.create', ['only' => ['create','store']]);
        $this->middleware('permission:user.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request){

        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        //return view('users.index');
    }

    /**
     * @return Response
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ValidationException
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    /**
     * @param  int  $id
     * @return Application|Factory|Response|View
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $previous_uploads = FileStorage::all()->where('user_id', $user->id);

        $activities = app('App\Http\Controllers\ActivitiesController')->getActivities($user->id);

        $total = $activities['total_time'];
        unset($activities['total_time']);

        return view('users.show',compact('user', 'previous_uploads', 'activities', 'total'));
    }

    /**
     * @param  int  $id
     * @return Response
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $input['role'] = $request['role'];


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success','User updated successfully');
    }

    /**
     * @param  int  $id
     * @return Response
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }

    /**
     * @param Request $request
     * FileStorage upload
     */
    public function fileupload(Request $request){

        if($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'files/';

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg","jpg","png","pdf");

            // Check extension
            if(in_array(strtolower($extension), $validextensions)){

                // Rename file
                $fileName = Str::slug(Carbon::now()->toDayDateTimeString()).rand(11111, 99999) .'.' . $extension;

                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);

            }

        }
    }
}
