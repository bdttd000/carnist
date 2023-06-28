<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();


if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}

$user = $SessionController->unserializeUser();
$defaultCityId = $user->getUserInfo()->getCityId();
$defaultCityName = $user->getUserInfo()->getCityName();
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>home</title>
</head>

<body>
    <main>
        <?php
        print_r($defaultCityId);
        print_r($defaultCityName);
        ?>
        <br>
        <a href="logout">wyloguj</a>
    </main>
</body>

</html>