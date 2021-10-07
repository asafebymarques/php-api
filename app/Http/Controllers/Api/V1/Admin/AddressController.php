<?php

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Services\AddressService;
use Illuminate\Http\Request;
use ApiWebPsp\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
     * @var AddressService
     */
    private $service;

    /**
     * AddressController constructor.
     * @param AddressService $service
     */
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->service->getId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'street' => 'required',
            'neighborhood' => 'required',
            'number' => 'required',
            'postal_code' => 'required'
        ], [
            'street.required' => 'Logradouro é obrigatório',
            'neighborhood.required' => 'Bairro é obrigatório',
            'number.required' => 'Numero endereço é obrigatório',
            'postal_code.required' => 'Cep é obrigatório'
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
            $patient = $this->service->patient($data['patient_id']);
            return response()->json(['message' => 'Endereço cadastrado com sucesso', 'status' => 'success', 'title' => 'Sucesso', 'id' => $result['id'], 'patient' => $patient], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'street' => 'required',
            'neighborhood' => 'required',
            'number' => 'required',
            'type' => 'required',
            'postal_code' => 'required'
        ], [
            'street.required' => 'Logradouro é obrigatório',
            'neighborhood.required' => 'Bairro é obrigatório',
            'number.required' => 'Numero endereço é obrigatório',
            'type.required' => 'Tipo endereço é obrigatório',
            'postal_code.required' => 'Cep é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        $result = $this->service->update($data, $id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Endereço atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }
}
