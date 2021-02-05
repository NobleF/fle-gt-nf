<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Class DropzoneController
 * @package App\Http\Controllers
 * OLD This class is no longer used
 */
class DropzoneController extends Controller {
    function index() {
        return view('dropzone');
    }

    function upload(Request $request) {
        $file = $request->file('file');

        $fileName = time() . '.' . $file->extension();

        $file->move(public_path('uploads'), $fileName);

        return response()->json(['success' => $fileName]);
    }

    function fetch() {
        $files = File::allFiles(public_path('uploads'));
        $output = '<div class="row">';
        foreach($files as $file)
        {
            $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('uploads/' . $file->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$file->getFilename().'">Remove</button>
            </div>
      ';
        }
        $output .= '</div>';
        echo $output;
    }

    function delete(Request $request)
    {
        if($request->get('name'))
        {
            File::delete(public_path('uploads/' . $request->get('name')));
        }
    }
}
