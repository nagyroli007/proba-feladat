<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Picture;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function showForm() {
        return view('upload');
    }

    public static function storePicture(request $request){
        
        // If the user has given file
        if ($request->hasFile('picture')){

            $str_arr = preg_split ("/\./", $request->picture->getClientOriginalName());  

            $kiterjesztes = $str_arr[sizeof($str_arr) - 1];

            // Check file type
            if (!($kiterjesztes == 'jpg' || $kiterjesztes == 'jpeg' || $kiterjesztes == 'png'))
                return 'Hibás kiterjesztésű file!<br/><a href="/pictureviewer">Vissza a képekhez</a>';

            // Store user and username
            $user = auth()->user();
            $uName = $user->username;
            // The picture path will be: public/upload/<username>
            $path = 'public/upload/';
            $path .= $uName;
            // Get the name of the file
            $filename = $request->picture->getClientOriginalName();
            // Store the uploaded file
            $request->picture->storeAs($path, $filename);
            // Create new model in the Picture db
            $file = new Picture;
            $file->name = $request->picture->getClientOriginalName();
            $file->size = $request->picture->getClientSize();
            $file->username = $uName;
            $file->description = $request->desc;
            $file->save();

            return view('pictureviewer');
        }

        return $request->all();
    }

    public function replacePicture(request $request){

    }

    public function toEdit(Request $request) 
    {
        return view('pictureEditor');
    }

    public static function delete($picname) {
        Picture::where('name', $picname)->where('username', auth()->user()->username)->delete();
        // CHECK IF GOOD
        Storage::delete('/public/upload/'.auth()->user()->username.'/'.$picname);

        return view('pictureEditor');
    }
}
 