<?php

namespace ApiWebPsp\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Presenters\UserPresenter;
use ApiWebPsp\Models\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;
    /**
     * @param $status
     * @return mixed
     */
    public function listUsers($status)
    {
        if($status == 'all')
        {
            $result = $this->model->orderBy('id')
                ->paginate();
        }else{
            $result = $this->model->where('status',$status)->orderBy('name')
                ->paginate();
        }

        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * @return mixed
     */
    public function listUsersAttendant()
    {
        $result = $this->model->where('role','drs-attendant')->where('status','ativo')->orderBy('name')
            ->get();
        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * @param $status
     * @return mixed
     */
    public function listUsersTrash($status)
    {
        $result = $this->model->where('status',$status)->where('deleted_at','<>', null)->orderBy('name')->withTrashed()
            ->paginate();
        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        return UserPresenter::class;
    }
}
