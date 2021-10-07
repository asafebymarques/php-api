<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2019
 * Time: 15:26
 */

namespace ApiWebPsp\Http\Controllers\Api\V1\Admin;

use ApiWebPsp\Http\Controllers\Controller;
use ApiWebPsp\Imports\SolicitationsImport;
use ApiWebPsp\Mail\RegisterBuyer;
use ApiWebPsp\Services\SolicitationService;
use ApiWebPsp\Mail\InvoiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use ApiWebPsp\Models\Solicitation;
use Illuminate\Support\Facades\DB;

class SolicitationsController extends Controller
{

    use UtilTrait;

    /**
     * @var SolicitationService
     */
    private $service;

    /**
     * SolicitationsController constructor.
     * @param SolicitationService $service
     */
    public function __construct(SolicitationService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista chamados
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $filter = empty($request->get('status')) ? null : $request->get('status');
        $filterProtocol = empty($request->get('protocol')) ? null : $request->get('protocol');
        $filterNumber = empty($request->get('number_solicitation')) ? null : $request->get('number_solicitation');
        $filterPI = empty($request->get('pi')) ? null : $request->get('pi');

        $status = $request->get('status') != '' || $request->get('status') != null ? $request->get('status'): 'aberto';
        $userId = $request->get('userId') ? $request->get('userId') : null;
        $protocols = $request->get('protocols') ? $request->get('protocols') : null;
        return $this->service->getSolicitations($status, $userId, $protocols, $filter, $filterProtocol, $filterNumber, $filterPI);
    }

        /**
     * Lista chamados
     * @param Request $request
     * @return mixed
     */
    public function indexProtocols(Request $request)
    {
        //status=&protocol=&=&=44

        $data = $request->all();

        $filter = empty($request->get('status')) ? null : $request->get('status');

        $filterProtocol = empty($request->get('protocol')) ? null : $request->get('protocol');
        $filterNumber = empty($request->get('number_solicitation')) ? null : $request->get('number_solicitation');
        $filterPI = empty($request->get('pi')) ? null : $request->get('pi');

        $status = $request->get('status') != '' || $request->get('status') != null ? $request->get('status'): 'aberto';
        $userId = $request->get('userId') ? $request->get('userId') : null;
        $protocols = $data['protocols'] != '' || $data['protocols'] != null ? $data['protocols'] : null;
        return $this->service->getSolicitations($status, $userId, $protocols, $filter, $filterProtocol, $filterNumber, $filterPI);
    }

    public function total() {
        return $this->service->totalSolicitations();
    }

    /**
     * Get por id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->service->getId($id);
    }

    /**
     * Criar solicitação e envia email para sac novonordisk
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            //'voucher' => 'required',
            'items.data' => 'required|array|min:1',
            'items.data.*.product.data.id' => 'required',
            'items.data.*.qtd' => 'required',
            'type' => 'required',
            'receiver.data.id' => 'required',
            'document' => 'unique:receivers,document',
            'description_other_type' => 'unique:solicitations,description_other_type',
        ], [
            //'voucher.required' => 'Voucher é obrigatório',
            'items.*.product.id' => 'Produto é obrigatório',
            'items.*.qtd.required' => 'Quantidade é obrigatória',
            'items.data.required' => 'É necessário selecionar ao menos um produto',
            'items.Data.length' => 'É necessário selecionar ao menos um produto',
            'type.required' => 'Tipo é obrigatório',
            'receiver.data.id.required' => 'Paciente é obrigatório',
            'document.unique' => 'Número do chamado já está em uso no sistema',
            'description_other_type.unique' => 'Número do chamado já em uso'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }


        $data = $request->all();
        $type_access = $data['type_access'];

        if ($type_access == 'psp') {
            $result = $this->service->create($data);
        } else if ($type_access == 'sac') {
            $result = $this->service->createSac($data);
        }

        //dd($result);
        if ($result['status'] == 'success') {
            $solicitation = $this->service->getSolicitation($result['id']);

           /* Mail::to(['cs.novonordisk@drsgroup.com.br', 'leiviton.silva@drsgroup.com.br', 'michel.santos@drsgroup.com.br', 'caio.moraes@drsgroup.com.br','raquel.mota@drsgroup.com.br'])
                ->queue(new InvoiceOrder('allan.santos@drsgroup.com.br', $solicitation));*/

            return response()->json(['message' => 'Chamado incluído com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }



    /**
     * update em construção
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request)
    {

        $type_access = $request['type_access'];

        if ($type_access == 'psp') {
            $result = $this->service->update($id, $request->all());
        } else if ($type_access == 'sac') {
            $result = $this->service->updateSac($id, $request->all());
        }

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Solicitação atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido comunique o administrador do sistema', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Delte logico
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($id)
    {
        $result = $this->service->delete($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario excluido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido comunique o administrador do sistema', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Criar agendamento caso nao tenha agendamento ativo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function scheduleSolicitation(Request $request)
    {
        $validator = Validator($request->all(), [
            'solicitation_id' => 'required',
            'date_scheduling' => 'required',
            'user_create' => 'required',
            'period' => 'required'
        ], [
            'solicitation_id.required' => 'Codigo da solicitação é obrigatório',
            'user_create.required' => 'Endereço é obrigatório',
            'period.required' => 'Manifestação é obrigatória',
            'date_scheduling.required' => 'Data de agendamento é obrigatória'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $feriados = $this->diasFeriados();

        $isFeriado = false;

        for($i = 0; $i < count($feriados);$i++)
        {
            if ($request->get('date_scheduling') == $feriados[$i])
            {
                $isFeriado = true;
                break;
            }
        }

        if ($isFeriado == true) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => 'Data de agendamento não pode ser um feriado'
            ], 406);
        }

        $data = $request->all();
        $idSolicitation = $data['solicitation_id'];

        $result = $this->service->scheduling($data);
        $this->service->updateStatus($idSolicitation, array('status' => 'agendado', 'date_scheduling' => (new \DateTime())->format('d/m/Y')));

        if ($result['status'] == 'success') {

            $solicitation = $this->service->getSolicitation($result['id']);

            /*
            Mail::to(
                [
                    'cs.novonordisk@drsgroup.com.br',
                    'leiviton.silva@drsgroup.com.br',
                    'michel.santos@drsgroup.com.br',
                    'caio.moraes@drsgroup.com.br'
                ])
                ->queue(new RegisterBuyer(
                    $solicitation->patient->patient_contacts[0]->email,
                    $solicitation,
                    $result['scheduling']));
            */
            return response()->json(
                [
                    'message' => 'Agendamento realizado com sucesso',
                    'status' => 'success',
                    'title' => 'Sucesso'
                ], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(
                [
                    'message' => 'Erro desconhecido, contate o Good do software',
                    'status' => 'error',
                    'title' => 'Erro'
                ], 400);
        }
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->service->assignAnalyst();
    }

    /**
     * retorna os contadores do dash
     * @return mixed
     */
    public function counts()
    {
        $result = $this->service->countStatus();
        // dd($result->qtd);
        return $result;
    }

    /**
     * Iniciar atendimento
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function initSolicitation($id)
    {
        $result = $this->service->initSolicitation($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Chamado iniciado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Cancelar agendamento
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function canceledSchedule($id)
    {
        $result = $this->service->canledScheduling($id);
        $idSolicitation = $result['result']['solicitation_id'];
        $this->service->updateStatus($idSolicitation, array('status' => 'atendimento', 'date_scheduling' => (new \DateTime())->format('d/m/Y')));

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Agendamento cancelado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Mudar endereço na solicitação
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateAddress($id, Request $request)
    {
        $result = $this->service->updateAddress($id, $request->all());

        if ($result['status'] == 'success') {
            $solicitation = $this->service->getId($result["id"]);
            return response()->json(['message' => 'Endereço atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso', 'data' => $solicitation["data"]], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * Criar agendamento caso nao tenha agendamento ativo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function schedulingAttempt(Request $request)
    {
        $validator = Validator($request->all(), [
            'user_id' => 'required',
            'solicitation_id' => 'required',
            'phone' => 'required',
            'sms' => 'required'
        ], [
            'user_id.required' => 'Codigo da usuario é obrigatório',
            'solicitation_id.required' => 'Codigo solicitação é obrigatório',
            'sms.required' => 'SMS é obrigatório',
            'phone.required' => 'Telefone é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $data = $request->all();

        $data['user'] = $data['user_id'];

        $result = $this->service->attempt($data);

        if ($result['status'] == 'success') {
            return response()->json(
                [
                    'message' => 'Tentativa salva com sucesso',
                    'status' => 'success',
                    'title' => 'Sucesso'
                ], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(
                [
                    'message' => 'Erro desconhecido, contate o Good do software',
                    'status' => 'error',
                    'title' => 'Erro'
                ], 400);
        }
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function countMounth()
    {
        return $this->service->countMounth();
    }

    public function countNow()
    {
        return $this->service->countNow();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateAttendant(Request $request)
    {
        $idSolicitation = $request->get('solicitation_id');

        $idUser = $request->get('user_id');

        $result = $this->service->updateAttendant($idSolicitation, $idUser);
        $this->service->updateStatus($idSolicitation, array('status' => 'atendimento', 'date_scheduling' => (new \DateTime())->format('d/m/Y')));

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Chamado atribuido com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido comunique o administrador do sistema', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateStatus($id, Request $request) {
        $result = $this->service->updateStatus($id, $request->all());

        if ($result['status'] == 'success') {
            $solicitation = $this->service->getId($result["id"]);
            return response()->json(['message' => 'Status atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso', 'data' => $solicitation["data"]], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        } else {
            return response()->json(['message' => 'Erro desconhecido, contate o Good do software', 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $voucher
     * @return int
     */
    public function getVoucher($voucher)
    {
        return $this->service->getVoucher($voucher);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function import(Request $request)
    {
        //dd('aquui');
        if ($request->hasFile('excel') && $request->file('excel')->isValid()) {

            Excel::import(new SolicitationsImport(), $request->excel);

            return response()->json(['message' => 'Chamado cadastrado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        }
    }

    
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateCompanies(){

        $solicitations = Solicitation::all();

        foreach ($solicitations as $value) {
            
            $id_solicitation = $value['id'];

            $estudo = $value['voucher'];

            $tabela_temporaria = $this->retornaEstudo($estudo);

            if($tabela_temporaria != null){

                $cod_tp_estoque = $tabela_temporaria->cod_tp_estoque;

                $cod_depositante = $tabela_temporaria->cod_depositante;
    
                if($cod_depositante != null && $cod_tp_estoque != null){
                    
                    $company = $this->retornaCompany($cod_depositante);
    
                    if($company != null){
    
                        print($id_solicitation);
                        print($company->id);
                        print($cod_tp_estoque);
                        print($cod_depositante);
        
                        try{
        
                            $solicitation = Solicitation::find($id_solicitation);
                            $solicitation->cod_tp_estoque = $cod_tp_estoque;
                            $solicitation->company_id = $company->id;
                            $solicitation->save();
    
                        } catch(\Execption $e){
                            print($e);
                        }
                    } 
                }
            }
        }

        print('---------------------------------------------');

        print(count($solicitations));

        return response()->json(['message' => 'Status atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
    }

    public function retornaEstudo($voucher){
        $result = DB::table('estudos_temporary')
            ->select('*')
            ->where('voucher', $voucher)
            ->first();
        
        return $result;
    }

    public function retornaCompany($cnpj){
        $result = DB::table('companies')
            ->select('*')
            ->where('cnpj', $cnpj)
            ->first();
  
        
        return $result;
    }
}
