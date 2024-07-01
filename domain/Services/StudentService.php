<?php

namespace domain\Services;

use App\Models\Student;

class StudentService
{

    protected $task;
    public function __construct()
    {

        $this->task = new Student();
    }

    public function all()
    {
        return  $this->task->all();
    }
    public function store($request)
    {
        return $this->task->create($request);
    }
    public function delete($task_id)
    {
        $task = $this->task->find($task_id);
        return  $task->delete();
    }
    public function done($task_id)
    {
        $task = $this->task->find($task_id);
        if ($task->status == 0) {
            $task->status = 1;
        } else {
            $task->status = 0;
        }
        return  $task->save();
    }

    public function get($request)
    {
        return $this->task->find($request);
    }


}
