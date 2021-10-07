<?php

namespace ApiWebPsp\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CompanyRepository.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
interface CompanyRepository extends RepositoryInterface
{
    /**
     * @param $status
     * @return mixed
     */
    public function listCompanies($status);

    /**
     * @param $status
     * @return mixed
     */
    public function listCompaniesTrash();
}
