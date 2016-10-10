<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
       $id = Authorizer::getResourceOwnerId();
       $clientId = $this->userRepository->find($id)->client->id;
       $orders = $this->orderRepository->with(['items'])->scopeQuery(function ($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
       })->paginate();

       return $orders;
    }

    public function store(Request $request)
    {
        $id = Authorizer::getResourceOwnerId();
        $data = $request->all();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $o = $this->service->create($data);
        $o = $this->orderRepository->with('items')->find($o->id);

        return $o;
    }

    public function show($id){
        $order = $this->orderRepository->with(['client','items','cupom'])->find($id);
        $order->items->each(function ($item){
            $item->product;
        });

        return $order;
    }

}
