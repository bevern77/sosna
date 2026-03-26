<?php
    session_start();
    require 'db.php';
    $komunikat = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $haslo = trim($_POST['haslo'] ?? '');

        if ($login === '' || $haslo === '') {
            $komunikat = "Podaj login i hasło!";
        } else {
            $stmt = $mysqli->prepare("SELECT id, haslo, rola FROM users WHERE login = ?");
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                if (password_verify($haslo, $row['haslo'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_login'] = $login;
                    $_SESSION['role'] = $row['rola'];

                    header('Location: ../index.php');
                    exit;
                } else {
                    $komunikat = "Błędne hasło!";
                }
            } else {
                $komunikat = "Nie znaleziono takiego użytkownika!";
            }
            $stmt->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="utf-8"><title>Logowanie</title>
<link rel="stylesheet" href="../log_rej.css">
</head>
<body>
    <h1 class="formularz_naglowek">Logowanie</h1>

    <form method="post">
        <label>Login: <input type="text" name="login"></label><br>
        <label>Hasło: <input type="password" name="haslo"></label><br><br>
        <button type="submit">Zaloguj</button>
    </form>

    <p style="color:darkred;"><?= htmlspecialchars($komunikat) ?></p>
    <a href="register.php">Nie masz konta? Zarejestruj się</a>
</body>
</html>
