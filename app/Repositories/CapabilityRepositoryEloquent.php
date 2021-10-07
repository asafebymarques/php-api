<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\CapabilityPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Capability;

/**
 * Class CapabilityRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class CapabilityRepositoryEloquent extends BaseRepository implements CapabilityRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Capability::class;
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
        return CapabilityPresenter::class;
    }

}
