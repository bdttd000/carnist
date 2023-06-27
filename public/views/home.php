<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();


if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>home</title>
    <a href="logout">asd</a>
</head>

<body>
    <main>home</main>
</body>

</html>