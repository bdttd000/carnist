<?php
$SessionController = new SessionController();
if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}

$user = $SessionController->unserializeUser();
$defaultCityId = $user->getUserInfo()->getCityId();
$defaultCityName = $user->getUserInfo()->getCityName();

$carController = new CarController();
$cars = $carController->getCars($defaultCityId);
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
            <section class="card_container">
                <?php if ($cars)
                    foreach ($cars as $car): ?>
                        <a href="car?id=<?= $car->getCarId(); ?>" class="card">
                            <div class="card_info">
                                <h2>
                                    <?= $car->getCarInfo()->getName(); ?>
                                </h2>
                                <p>
                                    <?php
                                    echo strlen($car->getCarInfo()->getDescription()) > 200 ? substr($car->getCarInfo()->getDescription(), 0, 300) . '...' : $car->getCarInfo()->getDescription();
                                    ?>
                                </p>
                            </div>
                            <div class="card_img_container">
                                <img class="card_img"
                                    src="public/uploads/<?= $car->getCarInfo()->getDirectoryUrl(); ?>/<?= $car->getCarInfo()->getAvatarUrl(); ?>"
                                    alt="Zdjecie auta">
                            </div>
                        </a>
                    <?php endforeach; ?>
            </section>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>