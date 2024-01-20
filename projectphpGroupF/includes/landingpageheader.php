<?php
    require_once("./user.account.php");
    require("./includes/db.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        header {
            background-color: grey;
            width: 100%;
            padding: 1%;
        }

        .top {
            display: flex;
            justify-content: space-between;
            width: 80%;
            align-items: center;
            margin: auto;
        }

        .divtop {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        a {
            text-decoration: none;
            color: black;
            cursor: pointer;
            font-family: 'Roboto', sans-serif;
        }
        
    </style>
</head>
<body>
    <header>
        <div class="top">
            <a href="landingpage.php">Home</a>
            <div class="divtop">
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
                <a href="quizz.php">Quizz</a>
                <a href="avis.php">Avis</a>
                <?php if (isset($_SESSION['USER_ID'])) : ?>
                    <a href="profile.php">Mon profil</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>
</html>