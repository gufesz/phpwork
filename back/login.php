<?php
session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = trim($_POST['felhasznalonev']);
    $jelszo = trim($_POST['jelszo']);
    $emlekezteto = isset($_POST['emlekezteto']) ? true : false;

    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $felhasznalonev)) {
        $error_message = 'A felhasználónév csak alfanumerikus karakterekből állhat, és legalább 5 karakter hosszú kell legyen!';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $jelszo)) {
        $error_message = 'A jelszónak legalább 8 karakter hosszúnak kell lennie, és tartalmaznia kell egy nagybetűt, egy kisbetűt és egy számot!';
    }

    if (empty($error_message)) {
        $valid_felhasznalonev = $felhasznalonev;
        $valid_jelszo = $jelszo;

        if ($felhasznalonev === $valid_felhasznalonev && $jelszo === $valid_jelszo) {
            $_SESSION['felhasznalonev'] = $felhasznalonev;

            if ($emlekezteto) {
                setcookie('felhasznalonev', $felhasznalonev, time() + (7 * 24 * 60 * 60));
            }

            header('Location: fooldal.php');
            exit();
        } else {
            $error_message = 'Hibás felhasználónév vagy jelszó!';
        }
    }
}

$savedfelhasznalonev = isset($_COOKIE['felhasznalonev']) ? $_COOKIE['felhasznalonev'] : '';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
    <h2>Bejelentkezés</h2>
    <?php
    if ($error_message) {
        echo "<div style='color: red;'>$error_message</div>";
    }
    ?>
    <form method="POST" action="login.php">
        <label for="felhasznalonev">Felhasználónév:</label>
        <input type="text" id="felhasznalonev" name="felhasznalonev" value="<?php echo htmlspecialchars($savedfelhasznalonev); ?>" required><br><br>

        <label for="jelszo">Jelszó:</label>
        <input type="password" id="jelszo" name="jelszo" required><br><br>

        <label for="emlekeztezo">
            <input type="checkbox" id="emlekezteto" name="emlekezteto"> Emlékezz rám
        </label><br><br>

        <input type="submit" value="Bejelentkezés">
    </form>
</body>
</html>
