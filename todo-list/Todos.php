<?php

require 'Todo.php';

class Todos {
    private $todos;

    /**
     * Construct a new Todo object
     */
    public function __construct() {
        $this->todos = $_SESSION['todos'] ?? [];
    }

    /**
     * Get the list of todos
     * 
     * @return Array List of todos
     */
    public function get() {
        // Return the list of todos
        return array_map(function($todo) {
            return unserialize($todo);
        }, $this->todos);
    }

    /**
     * Add a new todo to the list
     * 
     * @param String $todo A new todo to add
     * 
     * @return void
     */
    public function store(String $todo) {
        // Prepend the new todo
        array_unshift($this->todos, serialize(new Todo($todo, false)));

        // Update the session
        $_SESSION['todos'] = $this->todos;

        // Redirect the page to prevent multiple form injection
        // and update the view
        header('Location: ./');
    }

    /**
     * Complete one of the todos
     * 
     * @param Int $todo The index of the todo
     */
    public function update(Int $todo) {
        // Update the todo to completed
        $TODO = unserialize($_SESSION['todos'][$todo]);
        $TODO->completed = true;
        $_SESSION['todos'][$todo] = serialize($TODO);

        // Redirect the page to update the view
        header('Location: ./');
    }
}