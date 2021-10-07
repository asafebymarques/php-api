<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SchedulingSolicitationRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface SchedulingSolicitationRepository extends RepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getSchedulingActive($id);
}
