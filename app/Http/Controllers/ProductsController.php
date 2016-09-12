<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminCategoryRequest;
use Delivery\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class ProductsController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
    }

    public function index(){

        $products = $this->repository->paginate();

        return view('admin.products.index', ['products'=> $products]);
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(AdminCategoryRequest $request){
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.products.index');
    }

    public function edit($id){
        $products = $this->repository->find($id);

        return view('admin.products.edit', compact('products'));
    }

    public function update(AdminCategoryRequest $request, $id){
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.products.index');
    }

}
