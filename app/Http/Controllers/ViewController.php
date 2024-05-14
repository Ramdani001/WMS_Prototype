<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ViewController extends Controller {

    public function index (){
        $title = 'Dashboard';

        return view('templates/adminPages/dashboard', \compact('title'));
    }

}