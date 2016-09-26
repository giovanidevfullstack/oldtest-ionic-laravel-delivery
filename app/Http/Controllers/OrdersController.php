<?php

namespace Delivery\Http\Controllers;

use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository){

        $this->orderRepository = $orderRepository;
    }

    public function index(){
        $orders = $this->orderRepository->paginate();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $userRepository){
        $list_status = [
            0=>'pendente',
            1=>'a caminho',
            2=>'entregue'
        ];

        $order = $this->orderRepository->find($id);

        $deliveryman = $userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('order','list_status', 'deliveryman'));
    }

    public function update(Request $request, $id){
        $all = $request->all();
        $this->orderRepository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }

}