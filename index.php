<?php
$locatie = 'mysql';
$databasenaam = 'm3tdb';
$gebruikersnaam = 'willem';
$wachtwoord = 'Password123!';
try {
    $db_handler = new PDO("mysql:host=$locatie;dbname=$databasenaam", $gebruikersnaam, $wachtwoord);
} catch (Exception $ex) {
    print($ex);
}
if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $stmt = $db_handler->prepare("SELECT passHash FROM accounts WHERE username = :username");
        $stmt->bindParam("username", $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();
        $passHash = $stmt->fetch(PDO::FETCH_ASSOC)['passHash'];

        if($passHash and password_verify($_POST['password'], $passHash))
        {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header('Location: succes.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Log in</h1>
    <form action="index.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit">Log in</button>
    </form>
    <a href="register.php">Create a new account</a>
</body>

</html>