<?php
    require 'db.php';
    $komunikat = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $haslo = trim($_POST['haslo'] ?? '');
        $rola = 'user';

        if ($login === '' || $haslo === '' || $email === '') {
            $komunikat = "Uzupełnij wszystkie dane!";
        } else {
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE login = ?");
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $komunikat = "Ten login jest już zajęty!";

            } else {
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows>0){
                $komunikat="Ten adres email jest już użyty!";
            } else {
                $hash = password_hash($haslo, PASSWORD_DEFAULT);
                $stmt = $mysqli->prepare("INSERT INTO users (login, email, haslo, rola) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('ssss', $login, $email, $hash, $rola);
                $stmt->execute();
                $komunikat = "Pomyślnie zarejestrowano!";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
</head>
<body>
    <h1>Rejestracja</h1>

    <form method="post">
        <label>Login: <input type="text" name="login"></label><br>
        <label>Email: <input type="email" name="email"></label><br><br>
        <label>Hasło: <input type="password" name="haslo"></label><br><br>
        <button type="submit">Zarejestruj się</button>
    </form>

    <p style="color:darkred;"><?= htmlspecialchars($komunikat) ?></p>

    <a href="login.php">Masz już konto? Zaloguj się</a>
</body>
</html>
