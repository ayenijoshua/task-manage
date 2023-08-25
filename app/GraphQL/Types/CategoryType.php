<?php

// app/graphql/types/CategoryType 

namespace App\GraphQL\Types;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Collection of categories',
        'model' => Category::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of qcategory'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'name of category'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the category was created',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the category was last updated',
                'resolve' => function($model) {
                    return $model->updated_at;
                }
            ]
        ];
    }
}