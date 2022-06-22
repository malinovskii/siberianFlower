<?php require "components/header.php"?>


<?php 
if(!isset($_SESSION['user'])){
  header('Location: index.php');
}?>
<div class="container py-5">
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Профиль пользователя <?php echo $_SESSION['user']['username']?></h1>
        <p class="col-md-8 fs-4">Ваш email: <?php echo $_SESSION['user']['email']?></p>
        <form action="./database/auth/Logout.php">
            <button class="btn btn-danger btn-lg" type="submit">Выйти из аккаунта</button>
        </form>
      </div>
    </div>
</div>

<?php require "components/footer.php"?>