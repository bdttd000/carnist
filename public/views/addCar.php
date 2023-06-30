<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();

if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}

$Repository = new Repository;
$cities = $Repository->getAllCities();
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
                <form class="login-form" action="addCarForm" method="POST" enctype="multipart/form-data">
                    <div class="login-error-message">
                        <?php echo $messages['error']; ?>
                    </div>
                    <input class="input input-text-primary" type="text" name="title" placeholder="Podaj tytuł" value="<?php if (isset($messages['email']))
                        echo $messages['email']; ?>" required>
                    <textarea class="textarea" name="description" id="" cols="30" rows="10"
                        placeholder="Dodaj opis"></textarea>
                    <select name="city" required>
                        <?php
                        foreach ($cities as $city) {
                            echo '<option value="' . $city[0] . '">' . $city[1] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="file" name="avatar">
                    <input type="file" name="photos[]" multiple>
                    <button class='button button-primary drop-shadow-animate' type='submit'>Dodaj samochód</button>
                </form>
            </section>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>