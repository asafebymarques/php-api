<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 07/10/2019
 * Time: 11:30
 */

namespace ApiWebPsp\Services;

use ApiWebPsp\Repositories\PermissionRepository;
use ApiWebPsp\Repositories\UserPermissionRepository;
use ApiWebPsp\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AclService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;
    /**
     * @var UserPermissionRepository
     */
    private $userPermissionRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param PermissionRepository $permissionRepository
     * @param UserPermissionRepository $userPermissionRepository
     */
    public function __construct(
        UserRepository $userRepository,
        PermissionRepository $permissionRepository,
        UserPermissionRepository $userPermissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userPermissionRepository = $userPermissionRepository;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasPermission($name){
        $permission = $this->permissionRepository->skipPresenter(false)->findWherePermission($name);
        $user = Auth::guard()->user();

        if(!$permission)
        {
            return false;
        }

        if($this->userPermissionRepository->skipPresenter(false)
            ->findWherePermission(['permission_id'=>$permission->id],$user->id)->first()){
            return true;
        }else{
            return false;
        }
    }
}
