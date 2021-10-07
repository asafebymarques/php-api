<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\StatusCompanyPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\StatusCompany;

/**
 * Class StatusCompanyRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class StatusCompanyRepositoryEloquent extends BaseRepository implements StatusCompanyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatusCompany::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return StatusCompanyPresenter::class;
    }

}
