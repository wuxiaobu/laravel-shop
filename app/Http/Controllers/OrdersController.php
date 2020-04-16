<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\ProductSku;
use App\Models\UserAddress;
use App\Models\Order;
use Carbon\Carbon;

class OrdersController extends Controller
{   
    public function store(OrderRequest $a) 
    {   
        
        return [];
    }
}
