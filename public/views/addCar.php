<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();

$carController = new CarController();
$cars = $carController->getCars();

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
    <?php include('public/views/components/navbar.php'); ?>
    <main>
        <div class="container">
            <section class="addCar">

            </section>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>