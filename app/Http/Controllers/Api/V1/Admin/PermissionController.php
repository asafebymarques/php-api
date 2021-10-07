<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use ApiWebPsp\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    use UtilTrait;
    /**
     * @var PermissionService
     */
    private $service;

    /**
     * PermissionController constructor.
     * @param PermissionService $service
     */
    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return $this->service->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->service->create($data);
        return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
    }

}
