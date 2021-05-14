<?php

namespace App\GraphQL\Queries;

use App\Models\Lead;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class LeadsQuery extends Query
{
    protected $attributes = [
        'name' => 'leads',
    ];

    /**
     * Type returned by query
     * @return Type
     */
    public function type(): Type
    {
        return Type::nonNull(Type::listOf(GraphQL::type('Lead')));
    }

    /**
     * Optional filter parameters
     * @return array|array[]
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ]
        ];
    }

    /**
     * Custom query resolver. Same function for both list and single element
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Lead[]|\Illuminate\Database\Eloquent\Collection
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Lead::where('id' , $args['id'])->get();
        }

        if (isset($args['email'])) {
            return Lead::where('email', $args['email'])->get();
        }

        return Lead::all();
    }
}
