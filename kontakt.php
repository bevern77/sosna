<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt i Pomoc - Sosna Event</title>
    <link rel="stylesheet" href="kontakt_c.css?v=2">
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
            <a href="logowanie/login.php" class="btn-login">Zaloguj</a>
            <a href="logowanie/register.php" class="btn-register">Zarejestruj się</a>
        </div>
    </nav>

    <div class="event-header" style="height: 250px; background-image: linear-gradient(to bottom, rgba(17, 24, 39, 0.5), rgba(17, 24, 39, 1)), url('https://picsum.photos/seed/contact/1200/400');">
        <div class="header-content">
            <h1>Centrum Pomocy</h1>
        </div>
    </div>

    <div class="contact-container">
        
        <div class="left-column" style="display: flex; flex-direction: column; gap: 20px;">
            
            <div class="contact-info-box">
                <h2>Dane kontaktowe</h2>
                
                <div class="contact-detail">
                    <strong>Siedziba firmy:</strong>
                    <p>Sosna Event Sp. z o.o.<br>ul. Kociborska 31<br>31-301 Modliborzyce</p>
                </div>
                
                <div class="contact-detail">
                    <strong>Infolinia biletowa:</strong>
                    <p>+48 540 140 220<br>(Czynna pn-pt, 08:00 - 16:00)</p>
                </div>
                
                <div class="contact-detail">
                    <strong>Adres e-mail:</strong>
                    <p>pomoc@sosnaevent.pl</p>
                </div>
            </div>

            <div class="contact-info-box">
                <h2>Dokumenty</h2>
                <div class="contact-detail">
                    <p style="margin-bottom: 15px;">Pobierz aktualny regulamin serwisu oraz zasady rezerwacji biletów (plik PDF).</p>
                    <a href="regulamin.pdf" class="btn-download" target="_blank">Pobierz Regulamin</a>
                </div>
            </div>

        </div>

        <div class="faq-box">
            <h2>Najczęściej zadawane pytania (FAQ)</h2>

            <details class="faq-item">
                <summary>W jaki sposób otrzymam zakupiony bilet?</summary>
                <p>Po pomyślnym opłaceniu zamówienia, bilety wysyłane są w formie elektronicznej (plik PDF) na adres e-mail podany podczas logowania/rezerwacji. Dodatkowo bilety znajdziesz w zakładce "Moje rezerwacje" w panelu klienta.</p>
            </details>

            <details class="faq-item">
                <summary>Czy muszę drukować bilet elektroniczny?</summary>
                <p>Nie, dbamy o ekologię! Wystarczy, że okażesz bilet na ekranie swojego smartfona. Upewnij się tylko, że kod kreskowy lub kod QR jest wyraźnie widoczny, a jasność ekranu ustawiona jest na maksimum przed skanowaniem.</p>
            </details>

            <details class="faq-item">
                <summary>Czy mogę zwrócić zakupiony bilet?</summary>
                <p>Zgodnie z polskim prawem, bilety na wydarzenia rozrywkowe, sportowe i kulturalne ze ściśle określoną datą nie podlegają standardowemu prawu zwrotu w ciągu 14 dni. Wyjątkiem jest sytuacja, w której wydarzenie zostaje odwołane przez organizatora.</p>
            </details>

            <details class="faq-item">
                <summary>Co się stanie, jeśli wydarzenie zostanie odwołane?</summary>
                <p>W przypadku odwołania imprezy, niezwłocznie wyślemy do Ciebie wiadomość e-mail z instrukcjami. Standardowo oferujemy automatyczny zwrot 100% środków na konto lub możliwość wymiany biletu na voucher do wykorzystania na inne eventy w naszym serwisie.</p>
            </details>
            
            <details class="faq-item">
                <summary>Jak zmienić dane na bilecie imiennym?</summary>
                <p>Zmiana danych na bilecie imiennym jest możliwa do 48 godzin przed rozpoczęciem wydarzenia. Koszt takiej operacji to 30 zł. Prosimy o kontakt z naszą infolinią w celu dokonania zmian.</p>
            </details>

        </div>

    </div>

    <footer>
        &copy; Wyborowa grupa szturmowa | Akcja Sosna
    </footer>

</body>
</html>
