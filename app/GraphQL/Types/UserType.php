<?php

declare(strict_types=1);

namespace ApiWebPsp\GraphQL\Types;

use ApiWebPsp\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'Name User Api'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'Email User Api'
            ],
            'role' => [
                'type' => Type::string(),
                'description' => 'Role User Api'
            ],
            'extension' => [
                'type' => Type::string(),
                'description' => 'Extension User Api'
            ],
            'img_profile' => [
                'type' => Type::string(),
                'description' => 'Image Profile User Api'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'Status User Api'
            ],
            'last_login_at' => [
                'type' => Type::string(),
                'description' => 'Last Login User Api'
            ],
        ];
    }
}
