<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\AuthorizedPersonPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\AuthorizedPerson;

/**
 * Class AuthorizedPersonRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class AuthorizedPersonRepositoryEloquent extends BaseRepository implements AuthorizedPersonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AuthorizedPerson::class;
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
        return AuthorizedPersonPresenter::class;
    }
}
