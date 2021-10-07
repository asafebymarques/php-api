<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ApiWebPsp\Services\CompanyService;

class CompaniesController extends Controller
{
    use UtilTrait;
    /**
     * @var CompanyService
     */
    private $service;

    /**
     * CompaniesController constructor.
     * @param CompanyService $service
     */
    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->service->getCompanies(array('ativo' => $request->get('ativo')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator($data,
            [
                'cnpj' => 'required|unique:companies',
                'name' => 'required',
                'email' => 'required|unique:companies,email',
                'phone' => 'required',
                'contact_name' => 'required'
            ],
            [
                'cnpj.required' => 'CNPJ é obrigatorio',
                'name.required' => 'Razão Social é obrigatorio',
                'phone.required' => 'Telefone é obrigatorio',
                'contact_name.required' => 'Contato é obrigatorio',
                'email.required' => 'Email é obrigatorio',
                'email.unique' => 'Email já cadastrado no sistema'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        /*$upload = $this->upload($request, 'companies');

        if($upload == false) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => 'Logo invalido'
            ], 406);
        }

        $data["logo"] = $upload['file'];*/

        //dd(json_decode($data['status'],true));

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success',
                'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error',
                'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error',
                'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator($data,
            [
                'cnpj' => ['required', \Illuminate\Validation\Rule::unique('companies')->ignore($id)],
                'name' => 'required',
                'email' => 'required|unique:companies,email,'.$id,
                'phone' => 'required',
                'contact_name' => 'required'
            ],
            [
                'cnpj.required' => 'CNPJ é obrigatorio',
                'name.required' => 'Razão Social é obrigatorio',
                'phone.required' => 'Telefone é obrigatorio',
                'contact_name.required' => 'Contato é obrigatorio',
                'email.required' => 'Email é obrigatorio',
                'email.unique' => 'Email já cadastrado no sistema'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->update($id,$data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cliente atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cliente excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id) {
        $result = $this->service->getId($id);

        return $result;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($id)
    {

        $result = $this->service->updateStatus($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Status atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }
}
