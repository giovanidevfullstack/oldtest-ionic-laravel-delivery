<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminClientRequest;
use Delivery\Repositories\ClientRepository;
use Delivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class ClientsController extends Controller
{
    private $clientsRepository;
    private $userRepository;

    public function __construct(ClientRepository $clientsRepository, UserRepository $userRepository){
        $this->clientsRepository = $clientsRepository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $clients = $this->clientsRepository->paginate();

        return view('admin.clients.index', ['clients'=> $clients]);
    }

    public function create(){
        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $state = $request->input('state');
        $zipcode = $request->input('zipcode');

        $user = [
          'name' => $name,
          'email' => $email,
          'password' => $password
        ];

        $this->userRepository->create($user);

        $user_id = $this->userRepository->orderBy('id','desc')->first()->id;

        $client = [
            'user_id' => $user_id,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode
        ];

        $this->clientsRepository->create($client);

        return redirect()->route('admin.clients.index');
    }

    public function edit($id){
        $client = $this->clientsRepository->find($id);
        $user = $this->userRepository->find($client->user_id);

        return view('admin.clients.edit', compact('client','user'));
    }

    public function update(AdminClientRequest $request, $id){
        $name = $request->input('name');
        $email = $request->input('email');
        //$password = $request->input('password');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $state = $request->input('state');
        $zipcode = $request->input('zipcode');

        $user = [
            'name' => $name,
            'email' => $email
        ];

        $user_id = $this->clientsRepository->find($id)->user_id;

        $this->userRepository->update($user,$user_id);

        $client = [
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode
        ];

        $this->clientsRepository->update($client,$id);

        return redirect()->route('admin.clients.index');
    }

    public function destroy($id){
        $user_id = $this->clientsRepository->find($id)->user_id;

        $this->userRepository->delete($user_id);
        $this->clientsRepository->delete($id);

        return redirect()->route('admin.clients.index');
    }

}
