<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserPermissionRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface UserPermissionRepository extends RepositoryInterface
{
    /**
     * @param $id
     * @param $idUser
     * @return mixed
     */
    public function findWherePermission($id, $idUser);
}
