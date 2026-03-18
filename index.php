<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sosna Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="nawigacja">
    <div class="logo">Sosna Event</div>
    <ul class="linki-glowne">
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="budowa.html">Wydarzenia</a></li>
        <li><a href="budowa.html">Kontakt</a></li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li>Witaj, <?= htmlspecialchars($_SESSION['user_login']) ?>!</li>
            <li><a href="Logowanie/logout.php">Wyloguj się</a></li>
        <?php else: ?>
            <li><a href="Logowanie/login.php" class="logowanie">Zaloguj</a></li> <!--trzeba zrobic lepsze okno logowania bo jest na ten moment takie prowizoryczne-->
            <li><a href="Logowanie/register.php" class="logowanie">Zarejestruj się</a></li> <!--tu tak samo-->
        <?php endif; ?>

    </ul>
</nav>

<section class="hero">
    <h1>Odkrywaj najlepsze wydarzenia</h1>
    <p>Koncerty • Konferencje • Warsztaty • Spotkania</p>
    <a href="budowa.html" class="glowne-eventy">Przeglądaj eventy</a>
</section>

<section class="eventy">
    <h2>Nadchodzące wydarzenia</h2>
    <div class="eventy-grid">
   
  <!-- tu sie wrzuci z bazy rzeczy ale mi sie nie chce narazie -->

        <div class="karty-eventowe">
            <img src="zdjecia/skolimek.jpg">
            <div class="eventy-info">
                <h3>Koncert Muzyczny</h3>
                <p>15.06.2026 • Warszawa</p>
                <button class="karta-wiecej">Zobacz więcej</button>
            </div>
        </div>

        <div class="karty-eventowe">
            <img src="zdjecia/rinki.jpg">
            <div class="eventy-info">
                <h3>Konferencja IT</h3>
                <p>22.06.2026 • Kraków</p>
                <button class="karta-wiecej">Zobacz więcej</button>
            </div>
        </div>

        <div class="karty-eventowe">
            <img src="zdjecia/cpjs.jpg">
            <div class="eventy-info">
                <h3>Śląsk Wrocław - Miedź Legnica</h3>
                <p>05.07.2026 • Wrocław</p>
                <button class="karta-wiecej">Zobacz więcej</button>
            </div>
        </div>

    </div>
</section>

<footer>
    <p>© Wyborowa grupa szturmowa | Akcja Sosna </p>
</footer>

</body>
</html>
