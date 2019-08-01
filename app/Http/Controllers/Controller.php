<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


//    function Login()
//    {
//        if(Auth::check())
//        {
//            view()->share('user_login',Auth::user());
//        }
//    }

    function timkiem(Requets $requets)
    {
        $tukhoa = $requets->tukhoa;
        $productype = ProducType::where('name','like',"%$tukhoa%")
            ->take(5);
        return view('admin.search',['productype'=>$productype,'tukhoa'=>$tukhoa]);
    }


}
