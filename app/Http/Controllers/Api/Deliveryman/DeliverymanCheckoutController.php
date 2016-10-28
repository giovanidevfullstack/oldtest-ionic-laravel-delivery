<?php

namespace Delivery\Http\Controllers\Api\Deliveryman;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{

    private $orderRepository;
    private $userRepository;
    /**
     * @var OrderService
     */
    private $service;

    public function __construct(OrderRepository $orderRepository,
                                UserRepository $userRepository,
                                OrderService $service)
    {

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    public function index()
    {
       $id = Authorizer::getResourceOwnerId();
       $orders = $this->orderRepository->with(['items'])->scopeQuery(function ($query) use($id){
            return $query->where('user_deliveryman_id', '=', $id);
       })->paginate();

       return $orders;
    }

    public function show($idDeliveryman)
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
    }

    public function updateStatus(Request $request, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->service->updateStatus($id, $idDeliveryman, $request->get('status'));
        if($order){
            return $order;
        }
        abort(400,'Order não encontrado');
    }
}
