<?php

require 'User.php';

class Users {
    private $users;
    private $user;

    /**
     * Construct the list of users
     */
    public function __construct()
    {
        $this->users = $_SESSION['users'] ?? [];
        $this->user = $_SESSION['user'] ?? null;
    }

    /**
     * Add a new user
     * 
     * @param Array $user An array with user information
     *  name        - The name of the user
     *  email       - The email of the user
     *  password    - The password of the user in plaintext
     */
    public function store(Array $user) {
        // Add a new user in the user list
        $this->users[] = new User($user['name'], $user['email'], $user['password']);

        // Update the session users list
        $_SESSION['users'] = serialize($this->users);

        // Redirect the page to prevent multiple form injections
        // and update the view
        header('Location: ./');
    }

    /**
     * Login a user
     * 
     * @param String $email The input email
     * @param String $password The input password in plaintext
     * 
     * @return Mixed false | void
     */
    public function login(String $email, String $password) {
        $match = -1;

        // Try to find the user by email
        foreach (unserialize($this->users) AS $index => $user) {
            if ($user->email === $email) {
                $match = $index;
            }
        }

        // If the user wasn't found; return
        if ($match < 0) return false;

        // Verify the password, if not match; return
        if (!unserialize($this->users)[$match]->verifyPassword($password)) return false;

        // If all checks have passed; set the user session
        $_SESSION['user'] = serialize(unserialize($this->users)[$match]);

        // Redirect the page to update the view
        header('Location: ./');
    }

    /**
     * Get the logged in user
     * 
     * @return User::class The user object
     */
    public function getLoggedInUser() {
        // Return the user object
        return unserialize($this->user);
    }

    /**
     * Logout the current user
     */
    public function logout() {
        // Clear the current user from session
        $_SESSION['user'] = null;

        // Redirect the page to update the view
        header('Location: ./');
    }
}