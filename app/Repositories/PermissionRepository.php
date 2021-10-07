<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface PermissionRepository extends RepositoryInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function findWherePermission($name);
}
