<?php require "components/header.php"?>
<link href="assets/css/signin.css" rel="stylesheet">
<main class="form-signin w-100 m-auto">
  <form action="./database/auth/Login.php" method="post">
    <h1 class="h3 mb-4 text-center fw-normal">Вход</h1>
    <?php if($_SESSION['login_err']):?>
      <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['login_err'];?>
      </div>
    <?php endif?>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="login">
      <label for="floatingInput">Логин</label>
    </div>
    <div class="form-floating mt-3">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Пароль</label>
    </div>

    <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit">Войти</button>
  </form>
</main>
<?php require "components/footer.php"?>