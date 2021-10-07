<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AuditRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface AuditRepository extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function auditFilter($data);
}
