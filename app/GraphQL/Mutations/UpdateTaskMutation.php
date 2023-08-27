<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTask',
        'description' => 'Updates a task'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' =>  Type::nonNull(Type::string()),
                'rules'=>['exists:tasks,id']
            ],
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::string(),
            ],
            'status' => [
                'name' => 'status',
                'type' =>  Type::string(),
            ],
            'category_id' => [
                'name' => 'category_id',
                'type'=>Type::string(),
                'rules'=>['exists:categories,id']
            ],

        ];
    }

    public function resolve($root, $args)
    {
        $task = Task::findOrFail($args['id']);
        $task->fill($args);
        $task->save();

        return $task;
    }
}