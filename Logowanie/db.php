<?php
    $mysqli = new mysqli('localhost', 'root', '', 'rezerwacje');
    if ($mysqli->connect_errno) {
        die('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
    }
?>
