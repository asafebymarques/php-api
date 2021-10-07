<?php

namespace ApiWebPsp\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Presenters\CompanyPresenter;
use ApiWebPsp\Models\Company;

/**
 * Class CompanyRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
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
        return CompanyPresenter::class;
    }

    /**
     * @param $status
     * @return mixed
     */
    public function listCompanies($status)
    {
        //dd($status);
        $result = $this->model->where('ativo',$status)->orderBy('name')
            ->paginate();
        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * @param $status
     * @return mixed
     */
    public function listCompaniesTrash()
    {
        $result = $this->model->where('deleted_at','<>', null)->orderBy('name')->withTrashed()
            ->paginate();
        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

}
