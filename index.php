<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosna Event</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>

<nav class="nawigacja">
    <div class="logo">Sosna Event</div>
    <ul class="linki-glowne">
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="q.php">Wydarzenia</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li>
            <a href="moje_konto.php" style="color: var(--primary); font-weight: bold; margin-right: 15px; text-decoration: none;">
        Witaj <?= htmlspecialchars($_SESSION['user_login']) ?>!</a></li>
            <li><a href="Logowanie/logout.php" class="logowanie">Wyloguj się</a></li>
        <?php else: ?>
            <li><a href="Logowanie/login.php" class="logowanie">Zaloguj</a></li>
            <li><a href="Logowanie/register.php" class="logowanie">Zarejestruj się</a></li>
        <?php endif; ?>
    </ul>
</nav>

<section class="hero">
    <h1>Odkrywaj najlepsze wydarzenia</h1>
    <p>Koncerty • Konferencje • Warsztaty • Spotkania</p>
    <a href="q.php" class="glowne-eventy">Przeglądaj eventy</a>
</section>

<section class="eventy" id="wyroznione">
    <h2>Wyróżnione wydarzenia</h2>
    
    <div class="eventy-grid">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'system_rezerwacji');
        if ($conn->connect_error) {
            die("Błąd połączenia: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");

        $sql = "SELECT w.id, w.nazwa, w.data, m.nazwa AS miejsce_nazwa, m.adres 
                FROM wydarzenia w 
                JOIN miejsca m ON w.id_miejsca = m.id 
                ORDER BY w.limit_biletow DESC 
                LIMIT 3";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data_sformatowana = date('d.m.Y', strtotime($row['data']));
                
                $adres_czesci = explode(',', $row['adres']);
                $miasto = trim(end($adres_czesci)); 

                $img_url = "https://picsum.photos/seed/" . $row['id'] . "event/600/300";

              
                echo '<div class="karty-eventowe">';
                echo '    <img src="' . $img_url . '" alt="Wydarzenie">';
                echo '    <div class="eventy-info">';
                echo '        <h3>' . htmlspecialchars($row['nazwa']) . '</h3>';
                echo '        <p class="event-details">' . $data_sformatowana . ' &bull; ' . htmlspecialchars($miasto) . '</p>';
                echo '        <a href="rezerwuj.php?id=' . $row['id'] . '" class="karta-wiecej">Zobacz więcej</a>';
                echo '    </div>';
                echo '</div>';
            }
        } else {
            echo "<p>Brak wydarzeń do wyświetlenia.</p>";
        }

        $conn->close();
        ?>
    </div>
</section>

<footer>
    <p>© Wyborowa grupa szturmowa | Akcja Sosna </p>
</footer>

</body>
</html>
