<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<h2 style='color:white; text-align:center; margin-top:50px;'>Błąd: Nie wybrano wydarzenia. <a href='q.php' style='color:#8b5cf6;'>Wróć na stronę główną</a></h2>");
}

$id_wydarzenia = intval($_GET['id']);

$conn = new mysqli('localhost', 'root', '', 'system_rezerwacji');
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
$conn->set_charset("utf8");

$sql = "SELECT w.*, m.nazwa AS miejsce_nazwa, m.adres 
        FROM wydarzenia w 
        JOIN miejsca m ON w.id_miejsca = m.id 
        WHERE w.id = $id_wydarzenia";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("<h2 style='color:white; text-align:center; margin-top:50px;'>Nie znaleziono takiego wydarzenia. <a href='q.php' style='color:#8b5cf6;'>Wróć na stronę główną</a></h2>");
}

$event = $result->fetch_assoc();
$conn->close();

$miesiadze = ['Jan'=>'Stycznia', 'Feb'=>'Lutego', 'Mar'=>'Marca', 'Apr'=>'Kwietnia', 'May'=>'Maja', 'Jun'=>'Czerwca', 'Jul'=>'Lipca', 'Aug'=>'Sierpnia', 'Sep'=>'Września', 'Oct'=>'Października', 'Nov'=>'Listopada', 'Dec'=>'Grudnia'];
$data_obj = strtotime($event['data']);
$dzien = date('d', $data_obj);
$miesiac_ang = date('M', $data_obj);
$rok = date('Y', $data_obj);
$godzina = date('H:i', $data_obj);
$polska_data = $dzien . ' ' . $miesiadze[$miesiac_ang] . ' ' . $rok . ', godz. ' . $godzina;

$adres_czesci = explode(',', $event['adres']);
$miasto = trim(end($adres_czesci));

$img_url = "https://picsum.photos/seed/" . $event['id'] . "event/1200/500";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['nazwa']) ?> - Sosna Event</title>
    <link rel="stylesheet" href="podstrony.css">
</head>
<body>

    <nav>
        <div class="logo">
            <a href="q.php">Sosna Event</a>
        </div>
        <div class="nav-links">
            <a href="index.php">Strona główna</a>
            <a href="q.php">Wydarzenia</a>
            <a href="kontakt.php">Kontakt</a>
            <a href="Logowanie/login.php" class="btn-login">Zaloguj</a>
            <a href="Logowanie/register.php" class="btn-register">Zarejestruj się</a>
        </div>
    </nav>

    <div class="event-header" style="background-image: linear-gradient(to bottom, rgba(17, 24, 39, 0.3), rgba(17, 24, 39, 1)), url('<?= $img_url ?>');">
        <div class="header-content">
            <span class="header-badge"><?= htmlspecialchars($event['kategoria']) ?></span>
            <h1><?= htmlspecialchars($event['nazwa']) ?></h1>
        </div>
    </div>

    <div class="details-container">
        <div class="description-box">
            <h2>O wydarzeniu</h2>
            <p><?= nl2br(htmlspecialchars($event['opis'])) ?></p>
        </div>

        <div class="booking-card">
            <div class="info-row">
                <span class="info-label">Kiedy?</span>
                <span class="info-value"><?= $polska_data ?></span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Gdzie?</span>
                <span class="info-value"><?= htmlspecialchars($event['miejsce_nazwa']) ?></span>
                <span style="color: #9ca3af; font-size: 14px; margin-top: 3px;"><?= htmlspecialchars($event['adres']) ?></span>
            </div>

            <form action="potwierdzenie.php" method="POST">
                <input type="hidden" name="id_wydarzenia" value="<?= $event['id'] ?>">
                <button type="submit" class="btn-buy">Kup bilet</button>
            </form>
            <div class="tickets-left">
                Dostępnych biletów: <strong><?= $event['limit_biletow'] ?></strong>
            </div>
        </div>
    </div>

    <footer>
        &copy; Wyborowa grupa szturmowa | Akcja Sosna
    </footer>

</body>
</html>