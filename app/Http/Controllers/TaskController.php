<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RepositoryInterface;

class TaskController extends Controller
{
    private $task;
    function __construct(RepositoryInterface $task)
    {
        $this->task = $task;
    }

    function all($paginate=null)
    {
        $companies = $paginate ? $this->task->with('employees')->paginate(5) : $this->task->all();
        return response(['companies'=>$companies,'success'=>true],200);
    }

    public function companies()
    {
        return view('admin.companies');
    }

    public function task($id){
        return response(['task'=>$this->task->get($id),'success'=>true],200);
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $this->task->createTask($request);
        return response(['message'=>"Task created successfully",'success'=>true]);
    }


    public function employees(Company $id){
        $company = $id;
        $employees = $company->employees()->paginate(5);
        return response(['employees'=>$employees,'success'=>true],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $id)
    { 
        $company = $id;
        $this->company->updateCompany($company,$request);
        return response(['message'=>'Company updated successfully','success'=>true],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $id)
    {
        $company = $id;
        $this->company->dissociateRelations($company,'company', ['employees']);
        
        $this->company->delete($company);

        return response(['message'=>"Company delete successfully",'success'=>true]);
    }
}
