<?php require "components/header.php"?>
<link href="assets/css/signin.css" rel="stylesheet">
<main class="form-signin w-100 m-auto">
  <form action="./database/auth/Register.php" method="post">
    <h1 class="h3 mb-4 text-center fw-normal">Регистрация</h1>
    <?php if($_SESSION['register_err']):?>
      <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['register_err'];?>
      </div>
    <?php endif?>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username">
      <label for="floatingInput">Имя пользователя</label>
    </div>
    <div class="form-floating mt-3">
      <input type="email" class="form-control" id="floatingPassword" placeholder="Email" name="email">
      <label for="floatingPassword">Электронная почта</label>
    </div>
    <div class="form-floating mt-3">
      <input type="text" class="form-control" id="floatingPassword" placeholder="Login" name="login">
      <label for="floatingPassword">Логин</label>
    </div>
    <div class="form-floating mt-3">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Пароль</label>
    </div>
    <div class="form-floating mt-3">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Con-Password" name="con-password">
      <label for="floatingPassword">Повторите пароль</label>
    </div>
    <small>Уже зарегистрированы? <a href="register.php">Войдите в аккаунт</a></small>
    <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit">Создать аккаунт</button>
  </form>
</main>
<?php require "components/footer.php"?>