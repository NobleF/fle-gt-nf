<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileStorage;
use Illuminate\Support\Facades\Auth;

/**
 * Class FileUpload
 * @package App\Http\Controllers
 * OLD This class is no longer used
 */
class FileUpload extends Controller
{
    /*public function createForm(){
        return view('file-upload');
    }*/

    /*public function store(Request $request){

        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => "mimes:docs,pdf,docx,zip,txt"
        ]);

        $userName = Auth::User()->getAuthIdentifier();

        if($request->hasfile('filename')) {
            foreach($request->file('filename') as $file) {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/'.$userName.'/', $name);
                $data[] = $name;
            }
        }

        $file= new FileStorage();
        $file->name=json_encode($data);
        $file->file_path=(public_path().'/files/'.$userName.'/'.$name);

        $file->save();


        return back()
            ->with('success', 'Fichier téléversé')
            ->with('file', $file);

    }*/
}
