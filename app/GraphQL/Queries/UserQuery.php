<?php

declare(strict_types=1);

namespace ApiWebPsp\GraphQL\Queries;

use ApiWebPsp\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A query',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return User::where('id' , $args['id'])->paginate();
        }

        if (isset($args['email'])) {
            return User::where('email', $args['email'])->paginate();
        }

        return User::paginate();
    }
}
