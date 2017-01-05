<?php

namespace Delivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CupomRepository
 * @package namespace App\Repositories;
 */
interface CupomRepository extends RepositoryInterface
{
    public function findByCode($code);
}
