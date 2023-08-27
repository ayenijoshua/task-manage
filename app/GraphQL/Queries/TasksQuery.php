<?php

namespace App\GraphQL\Queries;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class TasksQuery extends Query
{
    protected $attributes = [
        'name' => 'task',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Task'));
    }


    public function resolve($root, $args)
    {
        $tasks = Task::where('user_id',auth()->user()->id)->with('category')->get();
        info('tasks',[$tasks]);
        return $tasks;
    }
}