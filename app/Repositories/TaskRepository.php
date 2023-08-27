<?php
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Task;

class TaskRepository extends EloquentRepository implements RepositoryInterface
{
    public $task;

    public function __construct(Task $task)
    {
        parent::__construct($task);
        $this->task = $task;
    }

    /**
     * get user instance
     */
    public function getModel(){
        return $this->task;
    }

    // public function updateCompany($model,$request){
    //     $this->update($model,$request->except('logo_path'));
    //     if($request->hasFile('logo_path')){
    //         $file = $this->storeLocalFile($request,'logo_path','company-logos');
    //         $this->update($model,['logo_path'=>$file]);
    //     }
    // }

    // public function createCompany($request){
    //     $company = $this->create($request->except('logo_path'));
    //     if($request->hasFile('logo_path')){
    //         $file = $this->storeLocalFile($request,'logo_path','company-logos');
    //         $this->update($company,['logo_path'=>$file]);
    //     }
    // }
}