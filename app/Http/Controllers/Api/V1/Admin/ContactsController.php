<?php

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Models\ReceiverContact;
use Illuminate\Http\Request;
use ApiWebPsp\Http\Controllers\Controller;

class ContactsController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ReceiverContact::find($id);
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
            'cellphone' => 'required'
        ], [
            'cellphone.required' => 'Celular é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        return ReceiverContact::create($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        return ReceiverContact::update($data);
    }
}
