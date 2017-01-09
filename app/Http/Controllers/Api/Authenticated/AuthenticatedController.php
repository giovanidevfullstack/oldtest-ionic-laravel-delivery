<?php

namespace Delivery\Http\Controllers\Api\Authenticated;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class AuthenticatedController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $id = Authorizer::getResourceOwnerId();

        return $this->userRepository->skipPresenter(false)->find($id);
    }

}
