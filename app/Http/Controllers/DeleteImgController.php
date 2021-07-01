<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeleteImgController extends Controller implements ShouldQueue
{
    public static function DeleteImg($img){

        try {

            $url = Str::replaceFirst('storage','public', $img);
            Storage::delete($url);

            return true;


        } catch (\Throwable $th) {

            return false;

        }

    }

    public static function CreateImg($img){

        try {

            $imagen = $img->store('public/blogs');
            $url = Storage::url($imagen);

            return $url;


        } catch (\Throwable $th) {

            return false;

        }

    }

}
