<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterface;

class TaskController extends Controller
{
    private $task;
    function __construct()
    {
        $this->task = new TaskRepository(new Task);
    }

    public function task($id){
        return response(['task'=>$this->task->get($id),'success'=>true],200);
    }
    
}
