<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 13/03/2019
 * Time: 10:21
 */

namespace ApiWebPsp\Services;


use ApiWebPsp\Repositories\AddressRepository;
use ApiWebPsp\Repositories\ReceiverRepository;
use Illuminate\Support\Facades\DB;

class AddressService
{
    /**
     * @var AddressRepository
     */
    private $addressRepository;
    /**
     * @var ReceiverRepository
     */
    private $ReceiverRepository;


    /**
     * AddressService constructor.
     * @param AddressRepository $addressRepository
     * @param ReceiverRepository $receiverRepository
     */
    public function __construct(AddressRepository $addressRepository, ReceiverRepository $receiverRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->ReceiverRepository = $receiverRepository;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getBuyer($limit)
    {
        return $this->addressRepository->skipPresenter(false)->paginate($limit);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->addressRepository->skipPresenter(false)->find($id);
    }

    /**
     * @param $data
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function update($data, int $id)
    {
        DB::beginTransaction();
        try {

            $result = $this->addressRepository->update($data, $id);

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

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
    public function create($data)
    {
        DB::beginTransaction();
        try {
            $result = $this->addressRepository->create($data);

            DB::commit();
            //dd($result);
            return ['status' => 'success', 'id' => $result->id];
        } catch (\Exception $exception) {
            DB::rollBack();

            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function Receiver($id)
    {
        return $this->ReceiverRepository->skipPresenter(false)->find($id);
    }
}
