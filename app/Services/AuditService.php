<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\AuditRepository;
use Illuminate\Support\Facades\DB;

class AuditService
{
    /**
     * @var AuditRepository
     */
    private $repository;

    /**
     * AuditService constructor.
     * @param AuditRepository $repository
     */
    public function __construct(AuditRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->repository->skipPresenter(false)->find($id);
    }

    /**
     * @return mixed
     */
    public function getAudits()
    {
        return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->paginate();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function auditFilter($data)
    {
        return $this->repository->skipPresenter(false)->auditFilter($data);
    }
}
