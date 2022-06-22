<?php 

session_start();


// Add database connection
require_once '../DBController.php';

// Create db object
$db = new DBController();

// Get data from login form
$login = $_POST['login'];
$password = md5($_POST['password']);

// Select user with entered data
$check_user = $db->connection->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");

// If user exists
if(mysqli_num_rows($check_user) > 0) {

    // Get user
    $user = mysqli_fetch_assoc($check_user);

    // Set session variable 
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email'],
        'username' => $user['username']
    ];

    
    unset($_SESSION['login_err']);
    
    header('Location: ../../profile.php');   
    
    
} else {

    // Error message
    $_SESSION['login_err'] = 'Неверный пароль или имя пользователя';
    header('Location: ../../login.php');  
};