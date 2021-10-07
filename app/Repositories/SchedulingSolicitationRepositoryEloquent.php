<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\SchedulingSolicitationPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\SchedulingSolicitation;

/**
 * Class SchedulingSolicitationRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class SchedulingSolicitationRepositoryEloquent extends BaseRepository implements SchedulingSolicitationRepository
{
    protected $skipPresenter = true;

    /**
     * @param $id
     * @return mixed
     */
    public function getSchedulingActive($id)
    {

        $result = $this->model->where('solicitation_id', $id)->where('status', 'ativo')->count();

        return $result;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SchedulingSolicitation::class;
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
        return SchedulingSolicitationPresenter::class;
    }
}
