<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\AuthorizedPeopleSolicitationPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\AuthorizedPeopleSolicitation;

/**
 * Class AuthorizedPeopleSolicitationRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class AuthorizedPeopleSolicitationRepositoryEloquent extends BaseRepository implements AuthorizedPeopleSolicitationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AuthorizedPeopleSolicitation::class;
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
        return AuthorizedPeopleSolicitationPresenter::class;
    }
}
