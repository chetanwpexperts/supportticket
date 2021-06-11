<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadFileController extends Controller
{
    function index()
    {
        
    }
    function downloadFile($file_name){
        $file = Storage::disk('public/uploads')->get($file_name);
  
        return (new Response($file, 200))
              ->header('Content-Type', 'image/jpeg');
              
        $files = Storage::files("public/uploads");

        $imgFiles = array();

        foreach ($files as $key => $val) {
            $val = str_replace("public/uploads","",$val);
            array_push($imgFiles, $val);
        }

        //return view('welcome', ['images' => $imgFiles]);
        return view('panel.show', compact('imgFiles'));
    }
}
