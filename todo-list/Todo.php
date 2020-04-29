<?php

class Todo {
    public $task;
    public $completed;

    /**
     * Construct a new todo
     * 
     * @param String $task The task
     * @param Bool $completed The status of the task 
     */
    public function __construct(String $task, Bool $completed)
    {
       $this->task = $task;
       $this->completed = $completed; 
    }
}