<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\CompanyRepository;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    /**
     * CompanyService constructor.
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
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
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {

            $this->repository->create($data);

            DB::commit();

            return ['status' => 'success'];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @return mixed
     */
    public function getCompanies($data)
    {
        $ativo = (int) $data['ativo'];
        if ($ativo) {
            return $this->repository->skipPresenter(false)->listCompanies($ativo);
        }    
        return $this->repository->skipPresenter(false)->paginate();
    }

    /**
     * @param $id
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function update($id, $data) {
        DB::beginTransaction();
        try {
            //dd($data);
            $client = $this->repository->find($id);

            $client->name = $data['name'];
            $client->cnpj = $data['cnpj'];
            $client->email = $data['email'];
            $client->phone = $data['phone'];
            $client->contact_name = $data['contact_name'];

            $client->save();

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
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param $password
     * @return array
     * @throws \Exception
     */
    public function updateStatus($id)
    {
        DB::beginTransaction();
        try {

            $user = $this->repository->find($id);

            if ($user->ativo == true) {
                $user->ativo = false;
            } else {
                $user->ativo = true;
            }

            $user->save();

            DB::commit();

            return ['status' => 'success', 'id' => $user->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }
}
