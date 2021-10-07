<?php


namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;


use Faker\Provider\ka_GE\DateTime;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Comtele\Services\TextMessageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait UtilTrait
{
    public function login360($data)
    {
        $url = env('DRS_AUTH_API') . '/auth';

        $postData = [
            'username' => $data['username'],
            'password' => $data['password'],
        ];
        try {
            $client = new Client([
                'verify' => false,
                'headers' => [ 'Content-Type' => 'application/json'],
                'timeout'  => 50.0,
            ]);
            $response = $client->post($url, [
                RequestOptions::FORM_PARAMS => $postData
            ]);

            $data = json_decode($response->getBody()->getContents());
        }
        catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            $response = $e->getResponse();
            if ($response != null) {
                $data = json_decode($response->getBody()->getContents());
            } else {
                $obj = new \stdClass();
                $obj->success = false;
                $obj->message = 'Ocorreu um erro. Não foi encontrado o usuário';
                $data = json_encode($obj);
            }
        }

        return $data;
    }

    public function getAuthenticatedUser360($token360)
    {
//        $url = env('DRS_AUTH_API') . '/my-permissions?module=CABLI';
        $url = env('DRS_AUTH_API') . '/user-info?info=companies-protocols&module=REQTS';
        try {
            $client = new Client([
                'verify' => false,
                'headers' => [ 'Content-Type' => 'application/json' ],
                'timeout'  => 50.0,
            ]);
            $response = $client->get($url, [
                'headers' => ['authorization' => "Bearer $token360"]
            ]);

            $data = json_decode($response->getBody()->getContents());
        }
        catch (RequestException $e) {
            $response = $e->getResponse();
            $data = json_decode($response->getBody()->getContents());
        }

        return $data;
    }

    public function loginLocal($data) {
         //$url = env('DRS_AUTH_API') . '/oauth/token';
        //$url = 'https://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/oauth/token';
        $url = 'https://requestapi.drsgroup.com.br/oauth/token';
      // $url = 'http://' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] . '/oauth/token';

        $postData = [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'NRCx71HwSJ0VCNCgRkw8wVI73vSmCwyWEIsb0qLG',
            'username' => $data['username'],
            'password' => $data['password'],
            'scope' => ''
        ];
        try {
            $client = new Client([
                'verify' => false,
                'headers' => [ 'Content-Type' => 'application/json'],
                'timeout'  => 90.0,
            ]);
            $response = $client->post($url, [
                RequestOptions::JSON => $postData
            ]);

            $data = json_decode($response->getBody()->getContents());
        }
        catch (RequestException $e) {
            //dd($e->getMessage());
            //$response = $e->getResponse();
            //$data = json_decode($response->getBody()->getContents());
        }

        return $data;
    }

    /**
     * @param $image
     * @param string $folder
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteFile($image, $folder = 'users')
    {
        if ($image != 'default.png' && $image != 'logo-default.jpg') {
            Storage::disk('public')->delete($folder.'/'.$image);
            return response(['message' => 'delete file','type' => 'success']);
        } else {
            return response(['message' => 'delete error', 'type' => 'error']);
        }
    }

    /**
     * @param Request $request
     * @param string $folder
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function upload(Request $request, $folder = 'users')
    {
        $nameFile = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->image->storeAs($folder, $nameFile, 'public');

            if (!$upload) {
                dd('caio no false');
            } else {
                return response(['file' => $nameFile]);
            }
        } else if ($request->get('image') == null || $request->get('image') == '') {
            return response(['file' => 'default.png']);
        } else {
            return false;
        }
    }

    /**
     * @param $cnpj
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCnpj($cnpj)
    {
        $client = new Client(['verify' => false]);
        $url = "http://receitaws.com.br/v1/cnpj/$cnpj";
        return $client->get($url);
    }

    /**
     * @param $cep
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCep($cep)
    {
        $guzzle = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        try{
            $response = $guzzle->get("https://viacep.com.br/ws/{$cep}/json/unicode/");
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        }
        $res = $response->getBody();
        return response($res, $response->getStatusCode());
        //return response([json_decode((string)$response->getBody(), true)], $response->getStatusCode());
    }

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    /**
     * @param $sender
     * @param $mensage
     * @param $receiver
     * @return mixed
     */
    public function sendSms($sender, $mensage, $receiver)
    {
        $key = "90c197cb-0c7d-4a49-b774-8027b874ce88";

        $textMessageService = new TextMessageService($key);

        $result = $textMessageService->send($sender, $mensage, $receiver);

        return $result;
    }

    /**
     * @param string $type
     * @return string
     */
    public function humanType(string $type):string
    {
        switch ($type) {
            case 'delivery':
                return 'Entrega';
                break;
            case 'collect':
                return  'Coleta';
                break;
            case 'other':
                return 'Outro';
                break;
            case 'exchange':
                return 'Troca';
                break;
            default:
                return 'Não localizado';
                break;
        }
    }

    /**
     * @param null $ano
     * @return array
     */
    public function diasFeriados($ano = null)
    {
        if ($ano === null)
        {
            $ano = intval(date('Y'));
        }

        $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
        $dia_pascoa = date('j', $pascoa);
        $mes_pascoa = date('n', $pascoa);
        $ano_pascoa = date('Y', $pascoa);

        $feriados = array(
            // Datas Fixas dos feriados Nacionail Basileiras
            date('d/m/Y',mktime(0, 0, 0, 1,  1,   $ano)), // Confraternização Universal - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 4,  21,  $ano)), // Tiradentes - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 5,  1,   $ano)), // Dia do Trabalhador - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 9,  7,   $ano)), // Dia da Independência - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 10,  12, $ano)), // N. S. Aparecida - Lei nº 6802, de 30/06/80
            date('d/m/Y',mktime(0, 0, 0, 11,  2,  $ano)), // Todos os santos - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 11, 15,  $ano)), // Proclamação da republica - Lei nº 662, de 06/04/49
            date('d/m/Y',mktime(0, 0, 0, 12, 25,  $ano)), // Natal - Lei nº 662, de 06/04/49

            // These days have a date depending on easter
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa)),//2ºferia Carnaval
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa)),//3ºferia Carnaval
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa)),//6ºfeira Santa
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa)),//Pascoa
            date('d/m/Y',mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa)),//Corpus Cirist
        );

        sort($feriados);

        return $feriados;
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function invertDate($date)
    {
        $result = '';
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
        }
    }

    /**
     * @param Request $request
     * @return bool|string
     */
    public function initCall(Request $request)
    {
       // dd($request);
        $destination = substr($request->get('destination'),0,2) == '11' ? substr($request->get('destination'),2,9) : $request->get('destination');

        $user = Auth::user();

        $data_clicktocall = array
        (
            "domain_uuid"	=> "0fa8e6f1-d3a5-4617-bb80-2da24e6463d3",
            "domain_name"	=> "drs.myuc2b.com",
            "destination"   => $destination,
            "extension"   	=> $user->extension
        );

        $data_clicktocall_json = json_encode($data_clicktocall);

        $ch = curl_init('http://drs.myuc2b.com:4438/clicktocall/call/destinations/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_clicktocall_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt
        (
            $ch, CURLOPT_HTTPHEADER, array
            (
                'Content-Type: application/json',
                'Accept: application/json',
                'Content-Length: ' . strlen($data_clicktocall_json),
                'Authorization: 23057bed-ae05-44b5-b702-7e4dc2fd65d6'
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 2000);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2000);

        /**
        execute post
         */
        $result = curl_exec($ch);

        /**
        close connection
         */
        curl_close($ch);

        return $result;
    }

    /**
     * @param $valor
     * @return mixed|string
     */
    public function clear($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }
}
