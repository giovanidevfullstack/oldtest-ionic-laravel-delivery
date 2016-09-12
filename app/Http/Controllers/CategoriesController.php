<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(){
        return view('admin.categories.index');
    }


}
