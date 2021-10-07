<?php

namespace ApiWebPsp\Transformers;

use League\Fractal\TransformerAbstract;
use ApiWebPsp\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace ApiWebPsp\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['company','permission'];

    /**
     * Transform the User entity.
     *
     * @param \ApiWebPsp\Models\User $model
     *
     * @return array
     */
    public function transform(User $model = null)
    {
        if ($model != null) {
            return [
                'id' => $model->id == null ? 1 : $model->id,
                'name' => $model->name == null ? "" : $model->name,
                'email' => $model->email == null ? "" : $model->email,
                'role' => $model->role == null ? "" : $model->role,
                'status' => $model->status == null ? "" : $model->status,
                'extension' => $model->extension == null ? "" : $model->extension,
                'img_profile' => env('APP_URL').'/storage/users/'.$model->img_profile,
                /* place your other model properties here */

                'last_login_at' => $model->last_login_at,
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ];
        } else {
            return [
                'id' => 0,
                'name' => "",
                'email' => "",
                'role' => "",
                'status' => "",
                'extension' => "",
                'img_profile' => env('APP_URL').'/storage/users/',
                /* place your other model properties here */

                'last_login_at' => "",
                'created_at' => "",
                'updated_at' => "",
            ];
        }
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeCompany(User $user = null)
    {
        if ($user != null) {
            return $user->company ? $this->item($user->company, new CompanyTransformer()): null;
        } else {
            return null;
        }
    }

    public function includePermission(User $user = null)
    {
        if ($user != null) {
            return $user->permissions ? $this->collection($user->permissions, new UserPermissionTransformer()) : null;
        } else {
            return null;
        }
    }
}
