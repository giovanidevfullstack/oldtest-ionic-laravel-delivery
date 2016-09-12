<?php

namespace Delivery\Http\Controllers;

use Delivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(CategoryRepository $categoryRepository){

        $categories = $categoryRepository->paginate(5   );

        return view('admin.categories.index', ['categories'=> $categories]);
    }

    public function create(CategoryRepository $categoryRepository){
        return view('admin.categories.create');
    }

}
