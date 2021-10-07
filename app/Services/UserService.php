<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 13/03/2019
 * Time: 10:33
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\UserPermissionRepository;
use ApiWebPsp\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserPermissionRepository
     */
    private $permissionRepository;

    /**
     * SellerService constructor.
     * @param UserRepository $userRepository
     * @param UserPermissionRepository $permissionRepository
     */
    public function __construct(UserRepository $userRepository, UserPermissionRepository $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getUsers($limit)
    {
        //return $this->userRepository->skipPresenter(false)->listUsers($limit);
        return $this->userRepository->skipPresenter(false)->paginate();
    }
    /**
     * @return mixed
     */
    public function getUsersAttend()
    {
        return $this->userRepository->skipPresenter(false)->listUsersAttendant();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->userRepository->skipPresenter(false)->find($id);
    }

    public function getEmail($email)
    {
        $response = $this->userRepository->skipPresenter(false)->findByField('email', $email);
        if (count($response['data']) > 0) {
            return $response['data'][0];
        }
        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function authenticated($id)
    {
        $user = $this->userRepository->find($id);

        $user->last_login_at = Carbon::now()->toDateTimeString();

        $user->save();

        return $this->userRepository->skipPresenter(false)->find($id);
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

            $data['remember_token'] = str_random(10);

            $data['email_verified_at'] = new \DateTime();

            $data['password'] = bcrypt(123456);

            //dd($data);
            $result = $this->userRepository->create($data);

            $permissions = $data['permission'];
            if (count($permissions) > 0) {
                foreach ($permissions as $permissionId => $value) {
                    $this->updatePermission($result, $permissionId, $value);                    
                }
            }


            DB::commit();

            return ['status' => 'success', 'user' => $result];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update($data, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->find($id);

            $user->name = $data['name'];

            $user->role = $data['role'];

            $user->save();

            $permissions = $data['permission'];
            if (count($permissions) > 0) {
                foreach ($permissions as $permissionId => $value) {
                    $this->updatePermission($user, $permissionId, $value);                    
                }
            }

            DB::commit();

            return ['status' => 'success'];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    private function updatePermission($user, $permissionId, $value) {
        $data = [
          "user_id" => $user->id,
          "permission_id" => $permissionId
        ];

        $permission = $this->permissionRepository->findWhere($data)->first();

        if ($permission != null) {
            $this->permissionRepository->delete($permission->id);
        }

        if ($value == true) {
            $this->permissionRepository->create($data);
        }
    }

    /**
     * @param $id
     * @param $password
     * @return array
     * @throws \Exception
     */
    public function updatePassword($id, $password)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->find($id);

            $user->password = bcrypt($password);

            $user->save();
            DB::commit();
            return ['status' => 'success', 'id' => $user->id];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }


    public function updatePass($id, $password) {
        $password = bcrypt($password);
        $this->userRepository->update(['password' => $password], $id);
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

            $user = $this->userRepository->find($id);

            if ($user->status == 'ativo') {
                $user->status = 'inativo';
            } else {
                $user->status = 'ativo';
            }

            $user->save();

            DB::commit();
            return ['status' => 'success', 'id' => $user->id];

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
            $this->userRepository->delete($id);
            DB::commit();
            return ['status' => 'success'];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $id
     * @param $permissionId
     * @return array
     * @throws \Exception
     */
    public function createPermission($id, $permissionId)
    {
        DB::beginTransaction();
        try{
            $user = $this->userRepository->find($id);


            $data = [
              "user_id" => $user->id,
              "permission_id" => $permissionId
            ];

            $permision = $this->permissionRepository->findWhere($data)->first();
            //$message = '';
            if($permision == null){
                $this->permissionRepository->create($data);
                $message = 'Permissão adicionada';
            } else {
                $message = 'Permissão revogada';
                $this->permissionRepository->delete($permision->id);
            }

            DB::commit();

            return ['status' => 'success','message' => $message];
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }


}
