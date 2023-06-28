<?php
$SessionController = new SessionController;
if ($SessionController::isLogged()) {
    $SessionController->redirectToHome();
}
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>Logowanie</title>
</head>

<body>
    <main class="login container">
        <div class="login-logo">
            <img class="login-logo-img" src="public/img/logo.svg" alt="asdasd">
            <h1 class="login-logo-text">CARNIST</h1>
        </div>
        <form class="login-form" action="checkLogin" method="POST">
            <div class="login-error-message">
                <?php echo $messages['error']; ?>
            </div>
            <div class="login-success-message">
                <?php echo $messages['success']; ?>
            </div>
            <input type="text" name="email" placeholder="podaj email" value="<?php if (isset($messages['email']))
                echo $messages['email']; ?>" required>
            <input type="password" name="password" placeholder="podaj haslo">
            <button class='button drop-shadow-animate' type='submit'>Zaloguj</button>
            <a href="register">Zarejestruj</a>
        </form>
    </main>
</body>

</html>