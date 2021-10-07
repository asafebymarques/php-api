<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\PermissionPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Permission;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    protected $skipPresenter = true;

    /**
     * @param $name
     * @return mixed
     */
    public function findWherePermission($name){
        return $this->model->where('name',$name)->first();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
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
        return PermissionPresenter::class;
    }

}
