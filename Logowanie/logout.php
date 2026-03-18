<?php
    session_start();
    session_unset();    // czyści wszystkie dane sesji
    session_destroy();  // usuwa plik sesji z serwera
    header('Location: ../index.php');
    exit;
?>
