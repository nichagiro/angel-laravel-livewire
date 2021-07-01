<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShowBlogController extends Controller
{


    public function visualizar($id){

        // CONDICIONAL SENCILLO
        // if(Auth::check()){

        //     $blog = blog::find($id);

        //     return view('blog' , compact('blog'));

        // }

        // else {

        //     abort(403,'Estos blog por el momento no se pueden visualizar');

        // }

        $blog = blog::find($id);

        //POLICY
        // Gate::authorize('view', $blog);

        return view('blog' , compact('blog'));
      

    }
}
