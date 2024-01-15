<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingelogd</title>
</head>
<body>
    <main>
        <h1>Ingelogd!</h1>
        <?php
        $username=$_SESSION["username"];
        echo "Welkom $username";
        ?>
    </main>
</body>
</html>