<?php
$SessionController = new SessionController;
if ($SessionController::isLogged()) {
    $SessionController->redirectToHome();
}

$Repository = new Repository;
$cities = $Repository->getAllCities();
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>Rejestracja</title>
</head>

<body>
    <main class="login container">
        <div class="login-logo">
            <img class="login-logo-img" src="public/img/logo.svg" alt="asdasd">
            <h1 class="login-logo-text">CARNIST</h1>
        </div>
        <form class="login-form" action="checkRegister" method="POST">
            <div class="login-error-message">
                <?php echo $messages['error']; ?>
            </div>
            <input type="text" name="email" placeholder="podaj email" value="<?php if (isset($messages['email']))
                echo $messages['email']; ?>" required>
            <input type="password" name="password" placeholder="Podaj hasło" required>
            <input type="password" name="password2" placeholder="Powtórz hasło" required>
            <input type="text" name="name" placeholder="Imię" value="<?php if (isset($messages['name']))
                echo $messages['name']; ?>" required>
            <input type="text" name="surname" placeholder="Nazwisko" value="<?php if (isset($messages['surname']))
                echo $messages['surname']; ?>" required>
            <input type="text" name="phone" placeholder="Numer telefonu (np. +48 ...)" value="<?php if (isset($messages['phone']))
                echo $messages['phone']; ?>" required>
            <select name="city" required>
                <?php
                foreach ($cities as $city) {
                    echo '<option value="' . $city[0] . '">' . $city[1] . '</option>';
                }
                ?>
            </select>
            <input type="text" name="address" placeholder="Adres zamieszkania" value="<?php if (isset($messages['address']))
                echo $messages['address']; ?>" required>
            <button class='button drop-shadow-animate' type='submit'>Zarejestruj</button>
            <br>
            Masz juz konto?
            <a href="login">Zaloguj</a>
        </form>
    </main>
</body>

</html>