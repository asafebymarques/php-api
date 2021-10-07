<?php

namespace ApiWebPsp\Repositories;

use ApiWebPsp\Presenters\ProductPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiWebPsp\Models\Product;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace ApiWebPsp\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $skipPresenter = true;

    /**
     * @param $data
     * @return mixed
     */
    public function productFilter($data)
    {
        $order[0] = $order[0] ?? 'product';
        $order[1] = $order[1] ?? 'asc';

        if($data['like'] == ''){
            $results = $this->model
                ->orderBy($order[0],$order[1])->get();
        }else{
            $results = $this->model
                ->orderBy($order[0],$order[1])
                ->where(function ($query) use ($data) {
                    if ($data){
                        return $query
                            ->where('product','like','%'. $data['like'].'%')
                            ->orWhere('active_principle','like','%'. $data['like'].'%')
                            ->orWhere('ean','like','%'. $data['like'].'%')
                            ->orWhere('presentation','like','%'. $data['like'].'%')
                            ->orWhere('laboratory','like','%'. $data['like'].'%');
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
        return Product::class;
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
        return ProductPresenter::class;
    }
}
