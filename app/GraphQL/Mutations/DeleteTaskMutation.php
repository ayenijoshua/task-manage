<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class DeleteTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteTask',
        'description' => 'deletes a task'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required','exists:tasks,id']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        info('id',[$args['id']]);
        $task = Task::findOrFail($args['id']);

        return  $task->delete() ? true : false;
    }
}