<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wydarzenia</title>
    <link rel="stylesheet" href="stylowanie.css">
</head>
<body>
        <link rel="stylesheet" href="stylowanie.css?v=6">

    <nav class="nawigacja">
        <div class="logo">
            <a href="index.php">Sosna Event</a>
        </div>
        <div class="linki-glowne">
            <a href="index.php">Strona główna</a>
            <a href="q.php">Wydarzenia</a>
            <a href="kontakt.php">Kontakt</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="moje_konto.php" style="color: var(--primary); font-weight: bold; margin-right: 15px; text-decoration: none;">
        Witaj <?= htmlspecialchars($_SESSION['user_login']) ?>!</a>
                <a href=Logowanie/logout.php class="btn-login">Wyloguj</a>
                <?php else: ?>
            <a href="logowanie/login.php" class="btn-login">Zaloguj</a>
            <a href="logowanie/register.php" class="btn-register">Zarejestruj się</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">
        <?php
        
        $conn = mysqli_connect('localhost', 'root', '', 'system_rezerwacji');

        if (!$conn) {
            die("Błąd połączenia z bazą: " . mysqli_connect_error());
        }
        mysqli_set_charset($conn, "utf8");

       
        $sql = "SELECT w.id, w.nazwa, w.opis, w.data, w.kategoria, w.limit_biletow 
                FROM wydarzenia w 
                ORDER BY w.kategoria, w.data ASC";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            
            $aktualna_kategoria = null;

            
            while ($row = mysqli_fetch_assoc($result)) {
                
            
                if ($row['kategoria'] !== $aktualna_kategoria) {
                    
                
                    if ($aktualna_kategoria !== null) {
                        echo '</div>'; 
                        echo '</div>'; 
                    }
                    
                    $aktualna_kategoria = $row['kategoria'];

               
                    echo '<div class="sekcja-kategorii">';
                    
                
                    echo '  <div class="naglowek-kategorii">';
                    echo '      <h2>' . htmlspecialchars($aktualna_kategoria) . '</h2>';
                    echo '      <div class="strzalki">';
                    echo '          <div class="strzalka nieaktywna">&#10094;</div>';
                    echo '          <div class="strzalka">&#10095;</div>';
                    echo '      </div>';
                    echo '  </div>';
                    
                    echo '  <div class="karuzela">';
                }

               
                $img_url = "https://picsum.photos/seed/" . $row['id'] . "/300/300";

                echo '      <div class="karta">';
                echo '          <img src="' . $img_url . '" alt="Plakat wydarzenia">';
                echo '          <h3>' . htmlspecialchars($row['nazwa']) . '</h3>';
                echo '          <a href="rezerwuj.php?id=' . $row['id'] . '" class="link-zamow">Zamów (pozostało: ' . $row['limit_biletow'] . ')</a>';
                echo '      </div>';
            }

          
            if ($aktualna_kategoria !== null) {
                echo '  </div>'; 
                echo '</div>'; 
            }

        } else {
            echo "<p>Brak wydarzeń w bazie danych.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <script>
      
        document.addEventListener("DOMContentLoaded", function() {
            
         
            const sekcje = document.querySelectorAll('.sekcja-kategorii');

         
            sekcje.forEach(sekcja => {
                const karuzela = sekcja.querySelector('.karuzela');
                const strzalki = sekcja.querySelectorAll('.strzalka');

                if (karuzela && strzalki.length === 2) {
                    const lewaStrzalka = strzalki[0];
                    const prawaStrzalka = strzalki[1];

                    lewaStrzalka.addEventListener('click', () => {
                        karuzela.scrollBy({
                            left: -320,
                            behavior: 'smooth' 
                        });
                    });

                 
                    prawaStrzalka.addEventListener('click', () => {
                        karuzela.scrollBy({
                            left: 320, 
                            behavior: 'smooth'
                        });
                    });
                }
            });
        });
    </script>

</body>
</html>
