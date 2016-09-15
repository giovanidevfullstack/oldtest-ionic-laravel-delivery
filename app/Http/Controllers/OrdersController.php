<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function __construct(){

    }

    public function index(){
        return view('admin.orders.index');
    }

}
