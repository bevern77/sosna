<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'system_rezerwacji');
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
$conn->set_charset("utf8");

$id_user = $_SESSION['user_id'];
$id_wydarzenia = intval($_POST['id_wydarzenia']);
$max_bilety_per_user = 2; 

$sql_check = "SELECT SUM(ilosc_biletow) AS suma 
              FROM rezerwacje 
              WHERE id_user = $id_user AND id_wydarzenia = $id_wydarzenia";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
$kupione = $row_check['suma'] ?? 0;

$message = "";
$message_color = "green";
$show_buttons = true;

if ($kupione >= $max_bilety_per_user) {
    $message = "Osiągnąłeś limit $max_bilety_per_user biletów na to wydarzenie.";
    $message_color = "red";
    $show_buttons = false;
} else {
    $sql_event = "SELECT limit_biletow FROM wydarzenia WHERE id = $id_wydarzenia";
    $result_event = $conn->query($sql_event);
    $row_event = $result_event->fetch_assoc();
    $dostepne_bilety = $row_event['limit_biletow'];

    if ($dostepne_bilety <= 0) {
        $message = "Brak dostępnych biletów.";
        $message_color = "red";
        $show_buttons = false;
    } else {
        $conn->query("INSERT INTO rezerwacje (id_user, id_wydarzenia, ilosc_biletow) VALUES ($id_user, $id_wydarzenia, 1)");
        $conn->query("UPDATE wydarzenia SET limit_biletow = limit_biletow - 1 WHERE id = $id_wydarzenia");

        $message = "Bilet został zakupiony pomyślnie!";
        $message_color = "green";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potwierdzenie zakupu</title>
    <link rel="stylesheet" href="potwierdzenie.css">
</head>
<body>
    <div class="confirmation-container">
        <h2 style="color: <?= $message_color ?>"><?= htmlspecialchars($message) ?></h2>
        <?php if ($show_buttons): ?>
            <a href="moje_konto.php" class="btn">Moje rezerwacje</a>
            <a href="q.php" class="btn" style="margin-top:10px;">Wróć do wydarzeń</a>
        <?php else: ?>
            <a href="q.php" class="btn">Wróć do wydarzeń</a>
        <?php endif; ?>
    </div>
</body>
</html>