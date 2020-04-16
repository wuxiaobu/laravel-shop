<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserVerification;
use App\Mail\OrderShipped;
use Mail;

class TestController extends Controller
{
    public function sendMail(){
        $userVerification = new OrderShipped;
        Mail::to(['email'=>'woshilieqie@163.com'])
           ->send($userVerification);
    }

    public function index(){
        return view('test');
    }
}
