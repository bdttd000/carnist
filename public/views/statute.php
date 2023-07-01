<?php
$SessionController = new SessionController();
if ($SessionController::isLogged() === false) {
    $SessionController->redirectToLogin();
}
?>

<html lang="en">

<head>
    <?php include('public/views/components/headImports.php'); ?>
    <title>Regulamin</title>
</head>

<body>
    <?php include('public/views/components/navbar.php'); ?>
    <main>
        <div class="container white-text">
            <h2>
                Witamy na stronie "Carnist" - platformie wypożyczania samochodów. Przed skorzystaniem z naszej strony
                internetowej, prosimy o zapoznanie się z poniższymi zasadami regulaminu. Korzystając z naszej strony,
                akceptujesz i zobowiązujesz się do przestrzegania niniejszych warunków. W przypadku braku akceptacji,
                prosimy o
                niekorzystanie z naszej strony.
            </h2>

            <h3>Usługi świadczone przez "Carnist"</h3>
            <ul>
                <li>1.1. "Carnist" to platforma internetowa, która umożliwia użytkownikom wypożyczanie samochodów od
                    innych
                    użytkowników.</li>
                <li>1.2. "Carnist" nie jest właścicielem ani operatorem pojazdów. Jesteśmy jedynie pośrednikiem,
                    umożliwiającym
                    transakcje między wynajmującymi a wypożyczającymi.</li>
                <li>1.3. "Carnist" nie ponosi odpowiedzialności za jakość, stan techniczny ani bezpieczeństwo samochodów
                    dostępnych
                    do wypożyczenia. Wszelkie roszczenia w tym zakresie powinny być kierowane bezpośrednio do
                    właściciela
                    pojazdu.</li>
            </ul>

            <h3>Rejestracja i konto użytkownika</h3>

            <ul>
                <li>2.1. Aby korzystać z funkcji strony "Carnist", użytkownik musi zarejestrować konto.</li>
                <li>2.2. Podczas rejestracji należy podać prawdziwe, dokładne i aktualne informacje. Użytkownik ponosi
                    pełną
                    odpowiedzialność za poufność swojego konta i za wszelkie działania podejmowane za pośrednictwem
                    swojego
                    konta.</li>
                <li>2.3. Użytkownik jest odpowiedzialny za aktualizację swoich danych osobowych, w tym informacji
                    dotyczących
                    prawa
                    jazdy, ubezpieczenia i danych kontaktowych.</li>
            </ul>

            <h3>Warunki wypożyczenia</h3>

            <ul>
                <li>3.1. Użytkownik zobowiązuje się do przestrzegania prawa dotyczącego wypożyczania samochodów, w tym
                    wymagań
                    wiekowych, posiadania prawa jazdy i innych przepisów obowiązujących w danym kraju lub regionie.</li>
                <li>3.2. Wypożyczający i wynajmujący są odpowiedzialni za ustalenie warunków wypożyczenia, w tym ceny,
                    okresu
                    wynajmu i ewentualnych dodatkowych opłat.</li>
                <li>3.3. Wynajmujący zobowiązuje się do zachowania należytej ostrożności i odpowiedzialności podczas
                    korzystania
                    z
                    wypożyczonego samochodu. Wynajmujący ponosi pełną odpowiedzialność za wszelkie szkody.</li>
            </ul>
        </div>
    </main>
    <?php include('public/views/components/footer.php'); ?>
</body>

</html>