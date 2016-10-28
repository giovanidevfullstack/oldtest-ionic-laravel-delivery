<?php

namespace Delivery\Http\Controllers;


use Delivery\Http\Requests\CheckoutRequest;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    private $orderRepository;
    private $userRepository;
    private $productRepository;
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(OrderRepository $orderRepository,
                                UserRepository $userRepository,
                                ProductRepository $productRepository,
                                OrderService $service)
    {

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->service = $service;
    }

    public function index()
    {
       $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
       $orders = $this->orderRepository->scopeQuery(function ($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
       })->paginate();

       return view('custumer.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->lists('column', null);
        return view('custumer.order.create', compact('products'));
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->service->create($data);

        return redirect()->route('custumer.order.index');
    }

}
