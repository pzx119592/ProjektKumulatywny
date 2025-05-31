<?php
session_start();
require_once __DIR__ . "/Uzytkownik.php"; // Ładujemy klasę Uzytkownik

// Sprawdzamy, czy użytkownik wysłał formularz logowania
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['imie'], $_POST['nazwisko'], $_POST['haslo'])) {
    $uzytkownik = new Uzytkownik($_POST['imie'], $_POST['nazwisko'], $_POST['haslo']);

    if (!$uzytkownik->walidujDane()) {
        echo "<script>alert('Wszystkie pola muszą być wypełnione!'); window.location.href='login.php';</script>";
        exit();
    }

    $uzytkownik->zaloguj();
}

// Obsługa wylogowania
if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("imie", "", time() - 3600, "/");
    setcookie("nazwisko", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="login.css">
    <script src="script.js"></script>
</head>
<body>
    <h2>Podaj swoje dane</h2>

    <form action="login.php" method="POST">
        <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" value="<?php echo isset($_COOKIE['imie']) ? htmlspecialchars($_COOKIE['imie']) : ''; ?>"><br><br>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" value="<?php echo isset($_COOKIE['nazwisko']) ? htmlspecialchars($_COOKIE['nazwisko']) : ''; ?>"><br><br>

        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo"><br><br>

        <input type="submit" value="Zaloguj">
    </form>
</body>
</html>