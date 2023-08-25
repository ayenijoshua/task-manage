<?php

// app/graphql/types/CategoryType 

namespace App\GraphQL\Types;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'title' => 'Task',
        'description' => 'Collection of tasks',
        'model' => Task::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of task'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the task'
            ],
            'status' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'status of task'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The date the task was created',
                'resolve' => function($model) {
                    return $model->created_at;
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the task was last updated',
                'resolve' => function($model) {
                    return $model->updated_at;
                }
            ]
        ];
    }
}