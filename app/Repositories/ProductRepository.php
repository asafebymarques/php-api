<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface ProductRepository extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function productFilter($data);
}
