<?php
session_start();
require 'config.php';

// Inicjalizacja sesji salda
if (!isset($_SESSION["saldo"])) {
    $_SESSION["saldo"] = 1000; // Domyślne saldo
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kwota"], $_POST["akcja"])) {
    $kwota = (float) $_POST["kwota"];
    $akcja = $_POST["akcja"];
    $imie = $_SESSION["imie"] ?? "Anonim";
    $nazwisko = $_SESSION["nazwisko"] ?? "";

    // WALIDACJA: kwota musi być większa niż 0
    if ($kwota <= 0) {
        echo "<p style='color: red;'>Podaj poprawną kwotę!</p>";
        exit();
    }

    if ($akcja == "wplata") {
        $_SESSION["saldo"] += $kwota;
    } elseif ($akcja == "wyplac") {
        if ($_SESSION["saldo"] >= $kwota) {
    $_SESSION["saldo"] -= $kwota;
} else {
    echo "<script>
        alert('Brak wystarczających środków!');
        window.location.href = 'index.php';
    </script>";
    exit();
}

    } else {
        echo "<p style='color: red;'>Niepoprawna operacja!</p>";
        exit();
    }

    // Zapis do bazy danych
    $stmt = $conn->prepare("INSERT INTO transakcje (imie, nazwisko, kwota, typ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $imie, $nazwisko, $kwota, $akcja);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>System bankowy</title>
    <link rel="stylesheet" href="index.css">
    <script src="script.js"></script>
</head>

<body>
    <h1>System bankowy</h1>
    <h3>Witaj, <?= htmlspecialchars($_SESSION['imie'] ?? 'Gościu') ?> <?= htmlspecialchars($_SESSION['nazwisko'] ?? '') ?>!</h3>

    <form action="index.php" method="POST">
        <label>Kwota:</label>
        <input type="number" name="kwota" placeholder="Podaj kwotę">
        <button type="submit" name="akcja" value="wplata">Wpłata</button>
        <button type="submit" name="akcja" value="wyplac">Wypłata</button>
    </form>

    <p>Aktualne saldo: <?= $_SESSION["saldo"]; ?> zł</p>

    <a class="history-button" href="result.php">Zobacz historię transakcji</a>
    <br>
    <form method="POST" action="login.php">
        <button type="submit" name="logout">Wyloguj</button>
    </form>

</body>
</html>