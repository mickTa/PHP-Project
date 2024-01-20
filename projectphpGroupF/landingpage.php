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
        padding: 1%
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
    h2 {
        text-align: center;
        margin-top: 20%;
    }
    .formulaire {
        text-align: center;
    }
    input, select {
        border-radius: 5px;
        border: none;
        padding: 0.2%; 
        text-align: center;
        margin-bottom:1%;
    }
    .data {
    display: flex;
    flex-direction: inline;
    justify-content: center;
    align-items: center;
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
    <?php
    session_start();
    if (!isset($_SESSION['USER_ID'])) {
        echo "<h2>Bienvenue sur notre site en ligne pour démarrer le quizz connectez-vous</h2>";
    } 
    ?>
    
    
    <p class="formulaire">Vous cherchez des informations sur un film ou un réalisateur ?</p>
    <p class="formulaire">Saisissez son nom</p>
    <form class="formulaire" method="POST">
        <select name="selector" id="">Choisissez une option
            <option value="film">Film</option>
            <option value="realisateur">Realisateur</option>
        </select>
        <input type="text" name="researchinfo" placeholder="Saisissez le nom">
        <input type="Submit" value="Rechercher">
    </form>
    
</body>
</html>



<?php
require("./includes/db.php");
require("./includes/selectdata.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $researchinfo = $_POST['researchinfo'];
    if($_POST['selector']==='film') {
        $movie=nameMovie($db,$researchinfo);
        if ($movie === false) {
            $errorMessage = "Saisie invalide";
        } else {
            foreach ($movie as $line) {
                foreach ($line as $value) {
                    echo "<span class='data'>". $value . " </span>";
                }
                echo "<br>";
            }
            exit();
        }
    }
    if($_POST['selector']==='realisateur') {
        $real=nameReal($db,$researchinfo);
        if ($real === false) {
            $errorMessage = "Saisie invalide";
        } else {
            
            foreach ($real as $line) {
                foreach ($line as $value) {
                    echo "<span>". $value . " </span>";
                }
                echo "<br>";
            }
            exit();
        }
    }
    
}

?>
