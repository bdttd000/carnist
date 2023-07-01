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
            <!-- <div>SZUKAJKA</div> -->
            <section class="car-container">
                <h2>
                    <?= $car->getCarInfo()->getName(); ?>
                </h2>
                <div class="car-info">
                    <h3>Dane kontaktowe:</h3>
                    <p>
                        <?= $owner->getUserInfo()->getAddress(); ?>
                    </p>
                    <p>
                        <?= $owner->getUserInfo()->getPhone(); ?>
                    </p>
                    <p>
                        <?= $owner->getEmail(); ?>
                    </p>
                </div>
                <div class="car-description">
                    <h3>Opis:</h3>
                    <p>

                        <?= $car->getCarInfo()->getDescription(); ?>
                    </p>
                </div>
                <div class="car-photo-container">
                    <img src="public/uploads/<?= $car->getCarInfo()->getDirectoryUrl(); ?>/<?= $car->getCarInfo()->getAvatarUrl(); ?>"
                        alt="Zdjecie auta">
                    <?php
                    $photos = $car->getCarInfo()->getPhotos();
                    foreach ($photos as $photoInfo) {
                        echo '<img 
                        src="public/uploads/' . $car->getCarInfo()->getDirectoryUrl() . '/' . $photoInfo['photo_url'] . '"
                        alt="Zdjecie auta">';
                    }
                    ?>
                </div>
            </section>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>