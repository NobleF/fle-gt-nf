<?php
namespace App\Http\Controllers;


use App\FileStorage;
use Faker\Provider\Uuid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class FileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * File view
     */
    public function create()
    {
        return view('create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * Show the application dashboard.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required',
            //'filename.*' => "mimes:docs,pdf,docx,zip,txt"
        ]);

        $userName = Auth::User()->getAuthIdentifier();

        if($request->hasfile('filename')) {
            foreach($request->file('filename') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/'.$userName, $filename, 'public');

                $file= new FileStorage();
                $file->name=$filename;

                $file->file_path = $filePath;
                $file->user_id = $userName;
                $file->uuid = (string) Str::uuid();

                $file->save();
            }
        }
        return back()
            ->with('success', 'Fichier téléversé');
    }

    /**
     * @param $uuid
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * Download file
     */
    public function downloadFile($uuid){
        $file = FileStorage::where('uuid', $uuid)->firstOrFail();
        //$pathToFile = storage_path($file->file_path);
        //$pathToFile = Storage::disk('public')->files($file->file_path);
        //dd($pathToFile);
        return response()->download(storage_path("app/public/$file->file_path"));
    }

    /**
     * @param $uuid
     * @return RedirectResponse
     * Destroy file
     */
    public function destroy($uuid){
        $file_db = FileStorage::where('uuid', $uuid)->firstOrFail();
        if(Storage::disk("public")->exists($file_db->file_path)) {
            Storage::disk("public")->delete($file_db->file_path);
            FileStorage::where('uuid', $uuid)->delete();
        }else{
            return back()->with('error', 'File not found');
        }

        return back()
            ->with('success', 'Fichier supprimé');

    }

}
