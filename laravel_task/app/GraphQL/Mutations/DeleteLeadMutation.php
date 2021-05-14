<?php

namespace App\GraphQL\Mutations;

use App\Models\Lead;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class DeleteLeadMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteLeadMutation'
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
                'type' => Type::string(),
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
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
        $lead = null;

        if (isset($args['id'])) {
            $lead = Lead::find($args['id']);
            $lead->delete();
        }

        if (isset($args['email'])) {
            $lead = Lead::where('email', $args['email'])->first();
            $lead->delete();
        }

        return $lead;
    }
}
