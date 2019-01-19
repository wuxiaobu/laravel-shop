<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;

class LoginController extends Controller
{
  function login()
  { 
    $socialite = new SocialiteManager(config('services'));
    return $socialite->driver('github')->redirect();
  }

  function callback()
  {
    $socialite = new SocialiteManager(config('services'));
    $user = $socialite->driver('github')->user();
    dd($user);
  }
}
