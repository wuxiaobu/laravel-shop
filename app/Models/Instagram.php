<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instagram extends Authenticatable
{
    protected $table = 'instagram';
    public $timestamps = false;
}
