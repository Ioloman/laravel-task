<?php


namespace App\GraphQL\Types;

use App\Models\Lead;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LeadType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Lead',
        'description' => 'Lead Type',
        'model' => Lead::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the client',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of the client',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the client',
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'The string of the client',
            ],
            'wantsToBuy' => [
                'type' => Type::boolean(),
                'description' => 'True, if the client wants to buy',
            ]
        ];
    }
}

