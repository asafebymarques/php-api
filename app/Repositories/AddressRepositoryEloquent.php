<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\AddressPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Address;

/**
 * Class AddressRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class AddressRepositoryEloquent extends BaseRepository implements AddressRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Address::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return AddressPresenter::class;
    }
}
