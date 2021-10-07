<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\AuditPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Audit;

/**
 * Class AuditRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class AuditRepositoryEloquent extends BaseRepository implements AuditRepository
{

    protected $skipPresenter = true;

    /**
     * @param $data
     * @return mixed
     */
    public function auditFilter($data)
    {
        $order[0] = $order[0] ?? 'created_at';
        $order[1] = $order[1] ?? 'desc';

        if($data['like'] == ''){
            $results = $this->model
                ->orderBy($order[0],$order[1])->get();
        }else{
            $results = $this->model
                ->orderBy($order[0],$order[1])
                ->where(function ($query) use ($data) {
                    if ($data){
                        return $query
                            ->where('id',$data['like'])
                            ->orWhere('user_id',$data['like']);
                    }
                    return $query;
                })
                ->get();
        }

        if ($results){
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audit::class;
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
        return AuditPresenter::class;
    }

}
