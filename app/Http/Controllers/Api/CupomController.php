<?php

namespace Delivery\Http\Controllers\Api;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\CupomRepository;

class CupomController extends Controller
{
    /**
    * @var CupomRepository
    */

    private $repository;

    public function __construct(CupomRepository $cupomRepository)
    {
        $this->repository = $cupomRepository;
    }

    public function show($code)
    {
        return $this->repository->skipPresenter(false)
                                ->findByCode($code);
    }


}
