<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\ReceiverPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Receiver;

/**
 * Class ReceiverRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class ReceiverRepositoryEloquent extends BaseRepository implements ReceiverRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Receiver::class;
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
        return ReceiverPresenter::class;
    }

    /**
     * @param $status
     * @return mixed
     */
    public function listReceivers()
    {
        $result = $this->model->orderBy('name')
            ->paginate();
        if ($result) {
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * @param $cpf
     * @return mixed
     */
    public function getCpf($cpf)
    {
        $result = $this->model->where('document',$cpf)
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }else{
            return response()->json(['data' => []]);
        }

    }

    public function getCompanyName($name)
    {
        $result = $this->model->where('name', 'like', '%' . $name . '%')
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }else{
            return response()->json(['data' => []]);
        }

    }

    /**
     * @param $status
     * @return mixed
     */
    public function listReceiversTrash()
    {
        $result = $this->model->where('deleted_at', '<>', null)->orderBy('name')->withTrashed()
            ->paginate();
        if ($result) {
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }
}
