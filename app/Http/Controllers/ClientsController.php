<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminProductRequest;
use Delivery\Repositories\CategoryRepository;
use Delivery\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class ClientsController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository){
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){
    }

    public function create(){
    }

    public function store(AdminProductRequest $request){
    }

    public function edit($id){
    }

    public function update(AdminProductRequest $request, $id){
    }

    public function destroy($id){
    }

}
