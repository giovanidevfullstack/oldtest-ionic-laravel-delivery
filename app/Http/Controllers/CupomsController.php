<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminCupomRequest;
use Delivery\Repositories\CupomRepository;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class CupomsController extends Controller
{
    private $repository;

    public function __construct(CupomRepository $repository){
        $this->repository = $repository;
    }

    public function index(){

        $cupoms = $this->repository->paginate();

        return view('admin.cupoms.index', ['cupoms'=> $cupoms]);
    }

    public function create(){
        return view('admin.cupoms.create');
    }

    public function edit($id){
        return false;
    }

    public function store(AdminCupomRequest $request){
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.cupoms.index');
    }

}
