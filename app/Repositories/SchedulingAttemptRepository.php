<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SchedulingAttemptRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface SchedulingAttemptRepository extends RepositoryInterface
{
    //
    /**
     * @param $id
     * @return mixed
     */
    public function countAttempts($id);
}
