<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function home(){        
        return view("public/home");
    }
    public function courses(){
        return view('public/courses');
    }

    public function apply(){
        return view('public/apply');
    }

    public function response(Request $request){
        $data = $request->session()->pull('data');
        return view('public/response',$data);
    }

}
