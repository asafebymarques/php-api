<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\AddressRepository;
use ApiWebPsp\Repositories\AuthorizedPeopleSolicitationRepository;
use ApiWebPsp\Repositories\ReceiverRepository;
use ApiWebPsp\Repositories\SchedulingAttemptRepository;
use ApiWebPsp\Repositories\SchedulingSolicitationRepository;
use ApiWebPsp\Repositories\SolicitationRepository;
use ApiWebPsp\Repositories\ProductRepository;
use ApiWebPsp\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SolicitationService
{
    /**
     * @var SolicitationRepository
     */
    private $repository;
    /**
     * @var ReceiverRepository
     */
    private $repositoryReceiver;
    /**
     * @var SchedulingSolicitationRepository
     */
    private $schedulingSolicitationRepository;
    /**
     * @var AddressRepository
     */
    private $addressRepository;
    /**
     * @var SchedulingAttemptRepository
     */
    private $attemptRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var AuthorizedPeopleSolicitationRepository
     */
    private $authorizedPeopleSolicitationRepository;

    /**
     * SolicitationService constructor.
     * @param SolicitationRepository $repository
     * @param ReceiverRepository $repositoryReceiver
     * @param SchedulingSolicitationRepository $schedulingSolicitationRepository
     * @param AddressRepository $addressRepository
     * @param SchedulingAttemptRepository $attemptRepository
     * @param ProductRepository $attemptRepository
     * @param AuthorizedPeopleSolicitationRepository $authorizedPeopleSolicitationRepository
     */
    public function __construct(SolicitationRepository $repository,
                                ReceiverRepository $repositoryReceiver,
                                SchedulingSolicitationRepository $schedulingSolicitationRepository,
                                AddressRepository $addressRepository,
                                SchedulingAttemptRepository $attemptRepository,
                                ProductRepository $productRepository,
                                UserRepository $userRepository,
                                AuthorizedPeopleSolicitationRepository $authorizedPeopleSolicitationRepository)
    {
        $this->repository = $repository;
        $this->repositoryReceiver = $repositoryReceiver;
        $this->schedulingSolicitationRepository = $schedulingSolicitationRepository;
        $this->addressRepository = $addressRepository;
        $this->attemptRepository = $attemptRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->authorizedPeopleSolicitationRepository = $authorizedPeopleSolicitationRepository;
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
     * @param $id
     * @return mixed
     */
    public function getSolicitation($id)
    {
        return $this->repository->find($id);
    }

    private function updateProduct($data) {
        try {
            $product = $this->productRepository->find($data['id']);
            $product->product = $data['product'];
            $product->presentation = $data['presentation'];
            $product->update();
            return $product->id;
        }
        catch (\Exception $e) {
            $data['cnpj'] = isset($data['cnpj'])?$data['cnpj']:'';
            $result = $this->productRepository->create($data);
            return $result->id;
        }

    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {
            $data['company_id'] = $data['company']['data']['id'];
            $data['address_id'] = $data['address']['data']['id'];

            $items = $data['items']['data'];
            $data['receiver_id'] = $data['receiver']['data']['id'];

            $document = (isset($data['document']) && $data['document'] != '') ? $data['document'] : null;
            if ($document) {
                $solicitationDoc = $this->repository->findWhere(['document' => $document])->first();
                if ($solicitationDoc) {
                    return ['status' => 'error', 'message' => 'Esta minuta já foi associado a outra solicitação.'];
                }
            }

            $description_other_type = (isset($data['description_other_type']) && $data['description_other_type'] != '') ? $data['description_other_type'] : null;
            if ($description_other_type) {
                $solicitationDesc = $this->repository->findWhere(['description_other_type' => $description_other_type])->first();
                if ($solicitationDesc) {
                    return ['status' => 'error', 'message' => 'Este número de documento já foi associado a outra solicitação.'];
                }
            }

            $result = $this->repository->create($data);

            $persons = $data['authorized']['data'];
            foreach ($persons as $person) {
                $person['document'] = $this->clear($person['document']);
                $result->authorized_people_solicitation()->create($person);
            }

            foreach ($items as $item) {
                $item['product_id'] = $item['product']['data']['id'];
                //$item['expiration_date'] = $item['expiration_date'] != '' && $item['expiration_date'] != null ? $this->invertDate($item['expiration_date']) : null;
                $item['expiration_date'] = substr($item['expiration_date'], 0, 10);

                if (isset($item['product']['data']['update']) && $item['product']['data']['update']) {
                    $productId = $this->updateProduct($item['product']['data']);
                    $item['product_id'] = $productId;
                }
                $result->solicitation_items()->create($item);
            }

            //QrCode::format('png')->size(350)->generate($result->voucher,public_path("storage/qrcode/".$result->voucher.'.png'));

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function createSac($data)
    {
        DB::beginTransaction();
        try {
            $data['company_id'] = $data['company']['data']['id'];
            $data['address_id'] = $data['address']['data']['id'];

            $items = $data['items']['data'];
            $data['receiver_id'] = $data['receiver']['data']['id'];

            $document = (isset($data['document']) && $data['document'] != '') ? $data['document'] : null;
            if ($document) {
                $solicitationDoc = $this->repository->findWhere(['document' => $document])->first();
                if ($solicitationDoc) {
                    return ['status' => 'error', 'message' => 'Esta minuta já foi associado a outra solicitação.'];
                }
            }

            $description_other_type = (isset($data['description_other_type']) && $data['description_other_type'] != '') ? $data['description_other_type'] : null;
            if ($description_other_type) {
                $solicitationDesc = $this->repository->findWhere(['description_other_type' => $description_other_type])->first();
                if ($solicitationDesc) {
                    return ['status' => 'error', 'message' => 'Este número de documento já foi associado a outra solicitação.'];
                }
            }

            $result = $this->repository->create($data);

            foreach ($items as $item) {
                $item['product_id'] = $item['product']['data']['id'];
                //$item['expiration_date'] = $item['expiration_date'] != '' && $item['expiration_date'] != null ? $this->invertDate($item['expiration_date']) : null;
                $item['expiration_date'] = substr($item['expiration_date'], 0, 10);

                if (isset($item['product']['data']['update']) && $item['product']['data']['update']) {
                    $productId = $this->updateProduct($item['product']['data']);
                    $item['product_id'] = $productId;
                }
                $result->solicitation_items()->create($item);
            }

            //QrCode::format('png')->size(350)->generate($result->voucher,public_path("storage/qrcode/".$result->voucher.'.png'));

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }


 /**
     * @return mixed
     */
    public function getSolicitations($status = 'aberto', $userId = null, $protocols = null, $filter = null, $filterProtocol = null, $filterNumberSolicitation = null, $filterPI = null)
    {

        if ($userId) {
            $user = $this->userRepository->skipPresenter(false)->find($userId);
            $user = $user['data'];
            return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitationsByUser($user);
        }

        if ($protocols) {
            $array_protocols  = explode(',', $protocols);

            if ($filterNumberSolicitation) {
                return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitationsByNumberSolicitation($array_protocols, $filterNumberSolicitation);
            }

            if ($filterPI) {
                return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitationsByPi($array_protocols, $filterPI);
            }

            if ($filter) {
                return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->filterSolicitationByProtocol($array_protocols, $filter);
            } else {
                return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->filterSolicitationByProtocol($array_protocols);
            }
        }

        if ($filterProtocol) {
            return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitationsByProtocol($filterProtocol);
        }

        if ($filter) {
            return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitationsByStatus($filter);
        }

        $user = Auth::guard('api')->user();
        if ($user->hasPermission('assignSolicitation') == true || $user->hasPermission('reopenSolicitation') == true) {
            return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->paginate();
        }
//        return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->paginate();
        return $this->repository->skipPresenter(false)->orderBy('created_at', 'desc')->getSolicitations($user, $status, $protocols);
    }

    /**
     * @param $id
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function update($id, $data)
    {
        DB::beginTransaction();
        try {
            $data['company_id'] = $data['company']['data']['id'];
            $data['address_id'] = $data['address']['data']['id'];

            $peoples = $data['authorized']['data'];

            $document = (isset($data['document']) && $data['document'] != '') ? $data['document'] : null;
            if ($document) {
                $solicitationDoc = $this->repository->findWhere(['document' => $document])->first();
                if ($solicitationDoc && $id != $solicitationDoc->id) {
                    return ['status' => 'error', 'message' => 'Esta minuta já foi associado a outra solicitação.'];
                }
            }

            $description_other_type = (isset($data['description_other_type']) && $data['description_other_type'] != '') ? $data['description_other_type'] : null;
            if ($description_other_type) {
                $solicitationDesc = $this->repository->findWhere(['description_other_type' => $description_other_type])->first();
                if ($solicitationDesc && $id != $solicitationDesc->id) {
                    return ['status' => 'error', 'message' => 'Este número de documento já foi associado a outra solicitação.'];
                }
            }

            $solicitation = $this->repository->update($data, $id);

            $items = $data['items']['data'];

            //ITEMS

            foreach ($solicitation->solicitation_items as $item) {
                $found = false;

                foreach ($items as $key => $it) {
                    if ($item->id != $it['id']) continue;

                    $expiration_date = substr($it['expiration_date'], 0, 10);

                    $data = array();
                    $data['product_id'] = $it['product']['data']['id'];
                    $data['lot'] = $it['lot'];
                    $data['qtd'] = $it['qtd'];
                    $data['expiration_date'] = $expiration_date;
                    $data['item_type'] = $it['item_type'];

                    $item->update($data);
                    unset($items[$key]); //remove elemento, pois já foi atualizado
                    $found = true;

                }

                if (!$found)
                    $item->delete($item);
            }

            foreach ($items as $key => $it) {
                $it['product_id'] = $it['product']['data']['id'];
                $it['expiration_date'] = substr($it['expiration_date'], 0, 10);

                if (isset($it['product']['data']['update']) && $it['product']['data']['update']) {
                    $productId = $this->updateProduct($it['product']['data']);
                    $it['product_id'] = $productId;
                }
                $solicitation->solicitation_items()->create($it);
                unset($items[$key]);
            }

            $solicitation->authorized_people_solicitation()->delete();

//            foreach ($solicitation->authorized_people_solicitation as $item) {
//                $found = false;
//
//                foreach ($peoples as $key => $people) {
//                    if ($item->id != $people['id']) continue;
//
//                    $item->update($people);
//                    unset($people[$key]); //remove elemento, pois já foi atualizado
//                    $found = true;
//                }
//
//                if (!$found)
//                    $item->delete($people);
//            }

            foreach ($peoples as $key => $person) {
                $solicitation->authorized_people_solicitation()->create($person);
                unset($peoples[$key]);
            }

//            $persons = $data['authorized']['data'];
//            foreach ($persons as $person) {
//                $person['document'] = $this->clear($person['document']);
//                $solicitation->authorized_people()->create($person);
//            }
//
//            foreach ($solicitation->authorized_people as $authPerson) {
//                $found = false;
//                foreach ($persons as $key => $person) {
//                    if ($authPerson->id != $person['id']) continue;
//
//                    $authPerson->update($person);
//                    unset($persons[$key]); //remove elemento, pois já foi atualizado
//                    $found = true;
//                }
//
//                if (!$found)
//                    $authPerson->delete($person);
//            }
//
//            foreach ($persons as $key => $person) {
//                $solicitation->authorized_people()->create($person);
//                unset($persons[$key]);
//            }

            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function updateSac($id, $data)
    {

        DB::beginTransaction();
        try {
            $data['company_id'] = $data['company']['data']['id'];
            $data['address_id'] = $data['address']['data']['id'];

            $document = (isset($data['document']) && $data['document'] != '') ? $data['document'] : null;
            if ($document) {
                $solicitationDoc = $this->repository->findWhere(['document' => $document])->first();
                if ($solicitationDoc && $id != $solicitationDoc->id) {
                    return ['status' => 'error', 'message' => 'Esta minuta já foi associado a outra solicitação.'];
                }
            }

            $description_other_type = (isset($data['description_other_type']) && $data['description_other_type'] != '') ? $data['description_other_type'] : null;
            if ($description_other_type) {
                $solicitationDesc = $this->repository->findWhere(['description_other_type' => $description_other_type])->first();
                if ($solicitationDesc && $id != $solicitationDesc->id) {
                    return ['status' => 'error', 'message' => 'Este número de documento já foi associado a outra solicitação.'];
                }
            }

            $solicitation = $this->repository->update($data, $id);

            $items = $data['items']['data'];


            //ITEMS

            foreach ($solicitation->solicitation_items as $item) {
                $found = false;

                foreach ($items as $key => $it) {
                    if ($item->id != $it['id']) continue;

                    $expiration_date = substr($it['expiration_date'], 0, 10);

                    $data = array();
                    $data['product_id'] = $it['product']['data']['id'];
                    $data['lot'] = $it['lot'];
                    $data['qtd'] = $it['qtd'];
                    $data['expiration_date'] = $expiration_date;
                    $data['item_type'] = $it['item_type'];

                    $item->update($data);
                    unset($items[$key]); //remove elemento, pois já foi atualizado
                    $found = true;

                }

                if (!$found)
                    $item->delete($item);
            }


            foreach ($items as $key => $it) {
                $it['product_id'] = $it['product']['data']['id'];
                $it['expiration_date'] = substr($it['expiration_date'], 0, 10);

                if (isset($it['product']['data']['update']) && $it['product']['data']['update']) {
                    $productId = $this->updateProduct($it['product']['data']);
                    $it['product_id'] = $productId;
                }
                $solicitation->solicitation_items()->create($it);
                unset($items[$key]);
            }



            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {

            $this->repository->delete($id);

            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function createReceiver($data)
    {
        DB::beginTransaction();
        try {

            $result = $this->repositoryReceiver->create($data);

            $address = $data['address'];

            $result->addresses()->create($address);

            $contact = $data['contact'];

            $result->Receiver_contacts()->create($contact);

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function assignAnalyst()
    {
        return $this->repository->getIdUser();
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
     * @return mixed
     */
    public function countStatus()
    {
        $contadorConcluido = $this->repository->countSatus('success');
        $contadorPendente = $this->repository->countSatus('pending');
        $contadorCancelados = $this->repository->countSatus('canceled');
        $contadorNovo = $this->repository->countSatus('created');

        return ['created' => $contadorNovo->qtd, 'success' => $contadorConcluido->qtd, 'pending' => $contadorPendente->qtd,
            'canceled' => $contadorCancelados->qtd];
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function initSolicitation($id)
    {
        DB::beginTransaction();
        try {
            //$status = $this->statusSolicitationRepository->findWhere(['short_description' => 'Em atendimento'])->first();

            $solicitation = $this->repository->find($id);

            //$solicitation->status_solicitation_id = $status->id;

            $solicitation->save();

            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function scheduling($data)
    {
        $verifyActive = $this->schedulingSolicitationRepository->getSchedulingActive($data['solicitation_id']);
        //dd($verifyActive);
        if ($verifyActive == 0) {
            DB::beginTransaction();
            try {

                $solicitation = $this->repository->find($data['solicitation_id']);
                //dd($solicitation);

                $data['date_scheduling'] = $data['date_scheduling'] != '' ? $this->invertDate($data['date_scheduling']) : null;
                $result = $this->schedulingSolicitationRepository->create($data);

                $solicitation->save();

                DB::commit();
                //dd($result);
                return ['status' => 'success', 'id' => $solicitation->id, 'scheduling' => $result];

            } catch (\Exception $exception) {
                DB::rollBack();
                return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Existe agendamento para a solicitação, cancele o agendamento para realizar um novo', 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function canledScheduling($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->schedulingSolicitationRepository->find($id);

            $result->status = 'inativo';

            //$solicitation = $this->repository->find($result->solicitation_id);

            //$solicitation->status = 'cancelled';

            $result->save();

            //$solicitation->save();

            DB::commit();

            //dd($result);
            return ['status' => 'success', 'id' => $result->id, 'result' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param $all
     * @return array
     * @throws \Exception
     */
    public function updateAddress($id, $all)
    {
        DB::beginTransaction();
        try {

            if (isset($all['create'])) {
                $result = $this->addressRepository->create($all);
                $addressId = $result->id;
            }
            else {
                $address = $this->addressRepository->find($all['addressId']);
                $addressId = $address->id;
            }

            $solicitation = $this->repository->find($id);

            $solicitation->address_id = $addressId;

            $solicitation->save();

            DB::commit();

            //dd($result);
            return ['status' => 'success', 'id' => $solicitation->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param $all
     * @return array
     * @throws \Exception
     */
    public function updateStatus($id, $data)
    {
        DB::beginTransaction();
        try {
            //$result = $this->addressRepository->create($all);

            $solicitation = $this->repository->find($id);

            $status = $data['status'];

            if ($status == 'aberto') {
                $field = 'updated_at';
            }
            else {
                $field = "data_$status";
            }

            $date = $data['date_scheduling'] != '' ? $this->invertDate($data['date_scheduling']) : null;
            $time = (isset($data['time_scheduling']) && $data['time_scheduling'] != '') ? $data['time_scheduling'] : null;
            if (!$date) {
                $now = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
                $date = $now->format('Y-m-d');
            }
            else {
                if ($time) {
                    $date = $date . ' ' . $time;
                }
            }

            $document = (isset($data['document']) && $data['document'] != '') ? $data['document'] : null;
            if ($document) {
                $solicitation->document = $document;

                $solicitationDoc = $this->repository->findWhere(['document' => $document])->first();
                if ($solicitationDoc && $solicitation->id != $solicitationDoc->id) {
                    return ['status' => 'error', 'message' => 'Esta minuta já foi associado a outra solicitação.'];
                }
            }



            $solicitation->status = $status;
            $solicitation->$field = $date;

            $solicitation->save();

            DB::commit();

            //dd($result);
            return ['status' => 'success', 'id' => $solicitation->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function attempt($data)
    {
        DB::beginTransaction();
        try {
            $result = $this->attemptRepository->create($data);

            DB::commit();
            //dd($result);
            return ['status' => 'success', 'id' => $data['solicitation_id'], 'scheduling' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function countMounth()
    {
        $statusConcluido = $this->repository->findWhere(['status' => 'aberto'])->first();
        $statusCancelados = $this->repository->findWhere(['status' => ''])->first();

        return $this->repository->countMounth($statusCancelados->id, $statusConcluido->id);
    }

    /**
     * @param $idSolicitation
     * @param $idUser
     * @return array
     * @throws \Exception
     */
    public function updateAttendant($idSolicitation, $idUser)
    {
        DB::beginTransaction();
        try {
            //dd($idSolicitation);
            $solicitation = $this->repository->find($idSolicitation);
            $solicitation->user_id = $idUser;
            $solicitation->save();
            DB::commit();
            //dd($result);
            return ['status' => 'success'];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    public function countNow()
    {
        return $this->repository->countStatusNow();
    }

    public function getVoucher($voucher)
    {
        $result = $this->repository->orderBy('created_at','desc')->findWhere(['voucher'=>$voucher])->first();
           // dd($result);
        $nextSend = $result == null ? 1 : $result->sends + 1;
        return $nextSend;
    }

    public function totalSolicitations() {
        $total = $this->repository->getTotalSolicitations();
        return ['status' => 'success', 'total' => $total];
    }

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
