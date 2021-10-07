<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use ApiWebPsp\Services\AuditService;
use Illuminate\Http\Request;

class AuditsController extends Controller
{
    /**
     * @var AuditService
     */
    private $service;

    /**
     * AuditsController constructor.
     * @param AuditService $service
     */
    public function __construct(AuditService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return $this->service->getAudits();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function auditFilter(Request $request)
    {
        return $this->service->auditFilter($request->all());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id) {
        $result = $this->service->getId($id);

        return $result;
    }
}
