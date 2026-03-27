<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'system_rezerwacji');
$conn->set_charset("utf8");

$user_id = $_SESSION['user_id'];

$sql = "SELECT r.id, w.nazwa AS wydarzenie, w.data, m.nazwa AS miejsce, r.ilosc_biletow
        FROM rezerwacje r
        JOIN wydarzenia w ON r.id_wydarzenia = w.id
        JOIN miejsca m ON w.id_miejsca = m.id
        WHERE r.id_user = $user_id
        ORDER BY w.data DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Konto - Sosna Event</title>
    <link rel="stylesheet" href="moje_konto.css">
</head>
<body>
    <nav>
    <div class="logo">
        <a href="index.php">Sosna Event</a>
    </div>
    <div class="nav-links">
        <a href="index.php">Strona główna</a>
        <a href="q.php">Wydarzenia</a>
        <a href="kontakt.php">Kontakt</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="moje_konto.php" class="user-link">Witaj <?=htmlspecialchars($_SESSION['user_login'])?>!</a>
            <a href="Logowanie/logout.php" class="btn-login">Wyloguj</a>
        <?php else: ?>
            <a href="logowanie/login.php" class="btn-login">Zaloguj</a>
            <a href="logowanie/register.php" class="btn-register">Zarejestruj się</a>
        <?php endif; ?>
    </div>
</nav>
<h2>Moje rezerwacje</h2>
<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Wydarzenie</th>
            <th>Miejsce</th>
            <th>Data</th>
            <th>Ilość biletów</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['wydarzenie']) ?></td>
            <td><?= htmlspecialchars($row['miejsce']) ?></td>
            <td><?= date('d.m.Y H:i', strtotime($row['data'])) ?></td>
            <td><?= $row['ilosc_biletow'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Nie masz żadnych rezerwacji.</p>
<?php endif; ?>
</body>
</html>
