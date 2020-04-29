<?php
session_start();
require 'Users.php';
$users = new Users;
$users->logout();