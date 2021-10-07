<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use ApiWebPsp\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * ProductsController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return $this->service->getProducts();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function productFilter(Request $request)
    {
        return $this->service->productFilter($request->all());
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'active_principle' => 'required|min:4',
            'cnpj' => 'required',
            'laboratory' => 'required',
            'product' => 'required',
            'presentation' => 'required',
            'code_protheus' => 'required'
        ], [
            'active_principle.required' => 'Principio ativo é obrigatório',
            'active_principle.length' => 'Principio ativo deve conter no minimo 4 caracteres',
            'cnpj.required' => 'CNPJ é obrigatório',
            'laboratory.required' => 'Laboratório é obrigatório',
            'product.required' => 'Nome do produto é obrigatório',
            'presentation.required' => 'Apresentação é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'role.required' => 'Nível de usuário é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->update($id, $request->all());

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }
}
