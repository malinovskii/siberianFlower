<?php
session_start();

unset($_SESSION['cart']);
unset($_SESSION['user']);
unset($_SESSION['login_err']);
unset($_SESSION['register_err']);

header('Location: ../../index.php');