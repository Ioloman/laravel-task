<?php

namespace App\GraphQL\Mutations;

use App\Models\Lead;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateLeadMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateLeadMutation'
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
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
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
        $lead = Lead::find($args['id']);

        if (isset($args['name']))
            $lead->name = $args['name'];
        if (isset($args['phone']))
            $lead->phone = $args['phone'];
        if (isset($args['wantsToBuy']))
            $lead->wantsToBuy = $args['wantsToBuy'];

        $lead->save();

        return $lead;
    }
}
