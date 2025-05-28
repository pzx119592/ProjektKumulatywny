<?php
session_start();

// Włącz wyświetlanie błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inicjalizacja salda, jeśli jeszcze nie istnieje
if (!isset($_SESSION['saldo'])) {
    $_SESSION['saldo'] = 1000; // Początkowe saldo
}

// Funkcja do wpłacania pieniędzy
function wplac($kwota) {
    if ($kwota > 0) {
        $_SESSION['saldo'] += $kwota;
        return "<p>Wpłacono $kwota PLN. Nowe saldo: " . $_SESSION['saldo'] . " PLN.</p>";
    } else {
        return "<p>Kwota wpłaty musi być większa niż 0.</p>";
    }
}

// Funkcja do wypłacania pieniędzy
function wyplac($kwota) {
    if ($kwota > 0 && $kwota <= $_SESSION['saldo']) {
        $_SESSION['saldo'] -= $kwota;
        return "<p>Wypłacono $kwota PLN. Nowe saldo: " . $_SESSION['saldo'] . " PLN.</p>";
    } elseif ($kwota > $_SESSION['saldo']) {
        return "<p>Brak wystarczających środków na koncie.</p>";
    } else {
        return "<p>Kwota wypłaty musi być większa niż 0.</p>";
    }
}

// Funkcja do sprawdzania salda
function saldo() {
    return "<p>Aktualne saldo: " . $_SESSION['saldo'] . " PLN.</p>";
}

// Pobieranie danych z formularza
$akcja = $_GET['akcja'] ?? null;
$kwota = $_GET['kwota'] ?? 0;

$wynik = "";

if ($akcja == 'wplac') {
    $wynik = wplac($kwota);
} elseif ($akcja == 'wyplac') {
    $wynik = wyplac($kwota);
} elseif ($akcja == 'saldo') {
    $wynik = saldo();
}

// Przekierowanie użytkownika do result.html i zapis wyniku w sessionStorage
echo "<script>
    sessionStorage.setItem('wynik', '$wynik');
    window.location.href = 'result.html';
</script>";
exit;