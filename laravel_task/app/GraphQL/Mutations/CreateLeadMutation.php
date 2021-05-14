<?php

namespace App\GraphQL\Mutations;

use App\Models\Lead;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateLeadMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createLeadMutation'
    ];

    /**
     * Type returned by mutation
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('Lead');
    }

    /**
     * Arguments of mutation
     * @return array|array[]
     */
    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'phone' => [
                'name' => 'phone',
                'type' => Type::string(),
            ],
            'wantsToBuy' => [
                'name' => 'wantsToBuy',
                'type' => Type::boolean(),
            ],
        ];
    }

    /**
     * Mutation resolver
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Lead
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $lead = new Lead();

        $lead->email = $args['email'];
        $lead->name = isset($args['name']) ? $args['name'] : '';
        $lead->phone = isset($args['phone'])? $args['phone'] : '';
        $lead->wantsToBuy = isset($args['wantsToBuy']) ? $args['wantsToBuy'] : false;

        $lead->save();

        return $lead;
    }
}
