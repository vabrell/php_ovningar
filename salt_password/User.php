<?php

class User {
    public $name;
    public $email;
    private $password;

    /**
     * Construct a new user
     * 
     * @param String $name The name of the user
     * @param String $email The email of the user
     * @param String $password The plaintext password of the user
     */
    public function __construct(String $name, String $email, String $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify the users password
     * 
     * @param String $password Password to match in plaintext
     * 
     * @return Bool true | false
     */
    public function verifyPassword(String $password) {
        return password_verify($password, $this->password);
    }
}