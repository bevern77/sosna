<?php
    $mysqli = new mysqli('localhost', 'root', '', 'system_rezerwacji');
    if ($mysqli->connect_errno) {
        die('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
    }
?>
