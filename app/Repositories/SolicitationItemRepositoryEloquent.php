<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\SolicitationItemPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Repositories\SolicitationItemRepository;
use ApiWebPsp\Models\SolicitationItem;
use ApiWebPsp\Validators\SolicitationItemValidator;

/**
 * Class SolicitationItemRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class SolicitationItemRepositoryEloquent extends BaseRepository implements SolicitationItemRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SolicitationItem::class;
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
        return SolicitationItemPresenter::class;
    }
}
