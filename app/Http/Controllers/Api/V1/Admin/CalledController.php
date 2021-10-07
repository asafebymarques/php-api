<?php


namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;


use ApiWebPsp\Http\Controllers\Controller;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class CalledController extends Controller
{
    use UtilTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function send(Request $request)
    {
        $data = $request->all();

        $type = $data["type"];

        $patient = $data["patient"];

        $product = $data["product"];

        $cellphone = [
            $data["cellphone"]
        ];

        $message = "Olá Sr(a) $patient, Somos da DRS SAC, operadora Logística da Novo Nordisk, estamos tentando contato, referente a ".$this->humanType($type)." do medicamento $product. Por gentileza, assim que possível, retorne o contato para a DRS SAC (11) 3198-9005.";

        $result = $this->sendSms('DRS SAC', $message, $cellphone);

        $code = $result->Success == false ? 400 : 200;

        $title = $result->Success == false ? 'Erro':'Sucesso';

        return response()->json(['message' => $result->Message, 'title' => $title],$code);
    }


}
