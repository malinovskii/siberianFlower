<?php 
	ob_start(); // Function to start sessions 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="../assets/css/stars.css">
    <link rel="stylesheet" href="../assets/css/rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php require "functions.php" ?>
    <title>Siberian Flower</title>
    
</head>
<body>
    <nav class="py-2 bg-light border-bottom">
        <div class="container">
          <ul class="nav me-auto">
            <li class="nav-item"><a href="../about.php" class="nav-link link-dark px-2">О нас</a></li>
            <li class="nav-item"><a href="../delivery.php" class="nav-link link-dark px-2">Доставка</a></li>
            <li class="nav-item"><a href="../promotions.php" class="nav-link link-dark px-2">Акции</a></li>
            <li class="nav-item"><a href="../catalog.php" class="nav-link link-dark px-2">Каталог</a></li>
          </ul>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <img class="bi me-2" width="40" height="32" src="../assets/img/logo.svg"></img>
            <span class="fs-4">Siberian Flower</span>
            </a>
            <ul class="nav">
            <?php if(!isset($_SESSION['user'])):?>
              <li class="nav-item"><a href="login.php" class="nav-link link-dark p-2">Вход</a></li>
              <li class="nav-item" style="margin-left: .5rem"><a href="register.php" class="nav-link link-dark p-2">Регистрация</a></li>
            <?php else: ?>
              <li class="nav-item"><a href="profile.php" class="nav-link link-dark p-2"><i class="fa-solid fa-user"></i>&nbsp; <?php echo $_SESSION['user']['username']?></a></li>
            <?php endif?>
            <li class="nav-item"  style="margin-left: .5rem"><button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-outline-primary p-2"><i class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp;Корзина (<?php echo $_SESSION['subtotal']?> руб)</button></li>
          </ul>
    </div>
    </header>
    <?php 
    // Delete from cart
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['delete_from_cart'])) {
          unset($_SESSION['cart'][array_search($_POST['product_id'], $_SESSION['cart'])]);
          header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $_POST['product_id']);
      }
  }
    ?>
    <!-- END HEADER -->