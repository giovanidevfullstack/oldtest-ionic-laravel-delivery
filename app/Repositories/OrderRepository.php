<?php

namespace Delivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository
 * @package namespace App\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    public function getByIdAndDeliveryman($id, $idDeliveryman);
}
