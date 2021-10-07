<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\ReceiverRepository;
use ApiWebPsp\Repositories\AuthorizedPersonRepository;
use Illuminate\Support\Facades\DB;

use ApiWebPsp\Models\AuthorizedPerson;

class ReceiverService
{
    /**
     * @var ReceiverRepository
     */
    private $repository;

    /**
     * CompanyService constructor.
     * @param ReceiverRepository $repository
     */
    public function __construct(ReceiverRepository $repository, AuthorizedPersonRepository $authPersonRepo)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id,$skipe=true)
    {
        return $this->repository->skipPresenter($skipe)->find($id);
    }

    /**
     * @param $cpf
     * @return mixed
     */
    public function getCpf($cpf)
    {
        return $this->repository->skipPresenter(false)->getCpf($cpf);
    }

    public function getCompanyName($name)
    {
        return $this->repository->skipPresenter(false)->getCompanyName($name);
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

            if ($data['type'] == 'paciente') {
                $data['date_birth'] = $data['date_birth'] != '' ? $this->invertDate($data['date_birth']) : null;
            }
            else if ($data['type'] == 'clinica') {
                $data['date_birth'] = new \DateTime();
            }

            $data['document'] = $this->clear($data['document']);

            $result = $this->repository->create($data);

            $persons = $data['authorized']['data'];
            $addresses = $data['address']['data'];
            $contacts = $data['contact']['data'];

            if(count($persons) > 0) {
                foreach ($persons as $person) {
                    $person['document'] = $this->clear($person['document']);
                    $result->authorized_people()->create($person);
                }
            }

            foreach ($addresses as $address) {
                $address['postal_code'] = $this->clear($address['postal_code']);

                $result->addresses()->create($address);
            }

            foreach ($contacts as $contact) {
                $contact['content'] = $contact['type'] == 'phone' || $contact['type'] == 'cellphone' ?
                    $this->clear($contact['content']) : $contact['content'];
                $result->receiver_contacts()->create($contact);
            }



            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
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
            $data['date_birth'] = $this->invertDate($data['date_birth']);

            //$Receiver = $this->repository->find($id);
            //$Receiver->document = $this->clear($data['document']);
            //$Receiver->date_birth = $data['date_birth'] == "" ? null : $data['date_birth'];
            //$Receiver->name = $data['name'];
            $receiver = $this->repository->update($data, $id);
            //$Receiver->save();


            $persons = $data['authorized']['data'];
            $addresses = $data['address']['data'];
            $contacts = $data['contact']['data'];

            if (empty($persons)) {
                $receiver->authorized_people()->delete();
            } else {
                //AUTHORIZED PEOPLE
                foreach ($receiver->authorized_people as $authPerson) {
                    $found = false;
                    foreach ($persons as $key => $person) {
                        if ($authPerson->id != $person['id']) continue;

                        $authPerson->update($person);
                        unset($persons[$key]); //remove elemento, pois já foi atualizado
                        $found = true;
                    }

                    if (!$found)
                        $authPerson->delete($person);
                }

                foreach ($persons as $key => $person) {
                    $receiver->authorized_people()->create($person);
                    unset($persons[$key]);
                }
            }

            //ADDRESS
            foreach ($receiver->addresses as $address) {
                $found = false;
                foreach ($addresses as $key => $add) {
                    if ($address->id != $add['id']) continue;

                    $address->update($add);
                    unset($addresses[$key]); //remove elemento, pois já foi atualizado
                    $found = true;
                }

                if (!$found)
                    $address->delete($add);
            }

            foreach ($addresses as $key => $add) {
                $receiver->addresses()->create($add);
                unset($add[$key]);
            }

            //CONTACT
            foreach ($receiver->receiver_contacts as $contact) {
                $found = false;
                foreach ($contacts as $key => $cont) {
                    if (!isset($cont['id']) || $contact->id != $cont['id']) continue;

                    $contact->update($cont);
                    unset($contacts[$key]); //remove elemento, pois já foi atualizado
                    $found = true;
                }

                if (!$found)
                    $contact->delete($cont);
            }

            foreach ($contacts as $key => $cont) {
                $receiver->receiver_contacts()->create($cont);
                unset($contacts[$key]);
            }



            /*
            if(count($persons) > 0) {
                foreach ($persons as $person) {
                    if (isset($person['id']) && $person['id'] > 0) continue;
                    $person['document'] = $this->clear($person['document']);
                    $result->authorized_people()->create($person);
                }
            }

            foreach ($addresses as $address) {
                if (isset($address['id']) && $person['id'] > 0) continue;
                $address['postal_code'] = $this->clear($address['postal_code']);

                $result->addresses()->create($address);
            }

            foreach ($contacts as $contact) {
                if (isset($contact['id']) && $person['id'] > 0) continue;
                $contact['content'] = $contact['type'] == 'phone' || $contact['type'] == 'cellphone' ?
                    $this->clear($contact['content']) : $contact['content'];
                $result->receiver_contacts()->create($contact);
            }
            */


            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @return mixed
     */
    public function getReceivers()
    {
        return $this->repository->skipPresenter(false)->paginate(200);
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

            $result = $this->repository->delete($id);

            DB::commit();

            return ['status' => 'success', 'id' => $id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $date
     * @return \DateTime
     * @throws \Exception
     */
    public function invertDate($date)
    {
        $result = '';
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return new \DateTime($result);
        } elseif (count(explode("-", $date)) > 1) {
            $result1 = implode("/", array_reverse(explode("-", $date)));
            $result = implode("-", array_reverse(explode("/", $result1)));
            return new \DateTime($result);
        }
    }

    /**
     * @param $id
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function people($id, $data)
    {
        DB::beginTransaction();
        try {
            $receiver = $this->repository->find($id);

            $result = $receiver->authorized_people()->create($data);

            DB::commit();

            return ['status' => 'success', 'result' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function address($id, array $data)
    {
        DB::beginTransaction();
        try {
            $receiver = $this->repository->find($id);

            $result = $receiver->addresses()->create($data);

            DB::commit();

            return ['status' => 'success', 'result' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function contact($id, array $data)
    {
        DB::beginTransaction();
        try {
            $receiver = $this->repository->find($id);

            $data['content'] = $data['type'] == 'phone' || $data['type'] == 'cellphone' ?
                $this->clear($data['content']):$data['content'];

            $result = $receiver->receiver_contacts()->create($data);

            DB::commit();

            return ['status' => 'success', 'result' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
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
