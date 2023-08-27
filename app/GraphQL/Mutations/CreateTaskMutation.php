<?php

namespace App\GraphQL\Mutations;

use App\Models\Task;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTask',
        'description' => 'Creates a task'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' =>  Type::nonNull(Type::string()),
                'rules'=>['unique:tasks,title']
            ],
            'description' => [
                'name' => 'description',
                'type' =>  Type::string(),
            ],
            'status'=>[
                'name' => 'status',
                'type' =>  Type::string(),
            ],
            'category_id'=>[
                'name'=>'category_id',
                'type'=>Type::string(),
                'rules'=>['exists:categories,id']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $task = new Task();
        $task->fill($args);
        $task['user_id'] = auth()->user()->id;
        $task->save();

        return $task;
    }
}