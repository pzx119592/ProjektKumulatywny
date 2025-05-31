<?php
session_start();
require 'config.php';
// Pobieramy dane użytkownika oraz historię transakcji
$imie = $_SESSION["imie"] ?? "Anonim";

$sql = "SELECT kwota, typ, data_operacji FROM transakcje WHERE imie = ? ORDER BY data_operacji DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $imie);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Historia operacji</title>
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <h2>Historia operacji</h2>
    <!-- Sprawdzamy, czy użytkownik ma jakieś zapisane transakcje -->
    <?php if ($result->num_rows == 0): ?>
        <p style="color: gray;">Brak transakcji do wyświetlenia.</p>
    <?php else: ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php $data = date("d-m-Y H:i:s", strtotime($row["data_operacji"])); ?>
                <li><?= $data ?> → <?= ucfirst($row["typ"]) ?>: <?= $row["kwota"] ?> zł</li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>

    <a class="back-button" href="index.php">Wróć</a>
</body>
</html>
<!-- Zamknięcie SQL i  połąćzenia z bazą danych -->
<?php
$stmt->close();
$conn->close();
?>