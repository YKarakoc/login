<?php
$locatie = 'localhost';
$databasenaam = 'm3tdb';
$gebruikersnaam = 'm3t';
$wachtwoord = 'Password123!';
try {
    $db_handler = new PDO("mysql:host=$locatie;dbname=$databasenaam", $gebruikersnaam, $wachtwoord);
} catch (Exception $ex) {
    print($ex);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password1">Repeat Password</label>
        <input type="password" name="password1" id="password1">
        <button type="submit">Register!</button>
    </form>
    <a href="./index.php">Already have an account?</a>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') 
    {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
            if ($_POST['password'] == $_POST['password1']) 
            {


                try 
                {
                    $passHash= password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $stmt = $db_handler->prepare("INSERT INTO accounts (username, email, passHash)
                                              VALUES(:username, :email, :passHash)");


                    $stmt->bindParam("username", $_POST['username'], PDO::PARAM_STR);
                    $stmt->bindParam("email", $_POST['email'], PDO::PARAM_STR);
                    $stmt->bindParam("passHash", $passHash, PDO::PARAM_STR);

                    $stmt->execute();
                    echo "Account is created";
                } 
                catch (Exception $ex) 
                {
                    print($ex);
                }
            }
            else
            {
                echo 'The password is not the same';
            }
            
        }
    }
    ?>
</body>

</html>