<?php
session_start();

// Add database connection
require_once '../DBController.php';

// Create db object
$db = new DBController();


// Get data from register form
$username = $_POST['username'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['con-password'];


// If passwords matches
if ($password == $confirm_password) {

    // Hash password
    $password = md5($password);

    // Execute query
    $db->connection->query(
        "INSERT INTO `users` (`id`, `login`, `password`, `username`, `email`) VALUES (NULL, '$login', '$password', '$username', '$email')");
    
    // Select user with entered data
    $check_user = $db->connection->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");

    // Get user
    $user = mysqli_fetch_assoc($check_user);

    // Set session variable 
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email'],
        'username' => $user['username']
    ];

    
    // Redirect to profile
    header('Location: ../../profile.php');   
    

} else {

    // Error message
    $_SESSION['register_err'] = 'Пароли не совпадают';
    header('Location: ../../index.php');
}