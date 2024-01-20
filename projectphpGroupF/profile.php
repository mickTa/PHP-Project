<?php
    session_start();
    require_once('./user.account.php');
    require_once("./includes/landingpageheader.php");

    $loggedin = true;
    $deleted = false;
    if (!isset($_SESSION['USER_ID'])) {
        echo '<h3 style="color: red;">Vous n\'êtes pas connecté</h3>';
        echo '<a href="login.php">connectez-vous</a>';
        $loggedin = false;
        exit();
    }

    require_once("./includes/db.php");
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'deleteacc') {
            accdeletion($db, $_SESSION['USER_ID']);
            $deleted = true;
            session_destroy();
        }
        else if ($_GET['action'] === 'logout') {
            session_destroy();
            header('Location: landingpage.php');
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
        <style>
            .profile-page {
                padding-top: 7%;;
                margin-left : auto;
                margin-right: auto;
                max-width: 60%;
                font-family: 'Roboto', sans-serif;
            }
            .profile-page h1 {
                font-weight: 700;
                margin-bottom: 7%;
            }
            .profile-info div, button {
                display: flex;
                margin-bottom: 2%;
                line-height: 20px;
            }
            .profile-left {
                font-weight: 500;
                width: 30%;
            }
            .profile-right {
                width: 30%;
            }
            button {
                border-style: solid;
                border-radius: 8px;
                border-width: 1px;
                padding: 7px;
                background-color: transparent;
                font-size: 14px;
                font-family: 'Roboto';
            }
            .password-btn {
                border-color: gray;
            }
            .deletion-btn, .logout-btn {
                border-color: #c62d49;
                color: #c62d49;
                margin-top: 3%;
            }
            .account-deletion {
                margin-top: 5%;
            }
            .account-deletion h2, p {
                margin-top: 1%;
            }
            .subtext {
                color: gray;
                font-size: 13px;
            }
        </style>
    </head>
    <body>
        <div class='profile-page'>
            <h1>Profile page</h1>
            <div class='profile-content'>
                <?php if($loggedin && !$deleted) : ?>
                    <div class='profile-info'>
                        <div>
                            <div class='profile-left'>Addresse email</div>
                            <div class='profile-right'><?= $_SESSION['USER_EMAIL'] ?></div>
                        </div>
                        <div>
                            <div class='profile-left'>Quizz score</div>
                            <div class='profile-right'><?= checkScore($db) ?></div> 
                        </div>
                        <div>
                            <div class='profile-left'>Permissions</div>
                            <div class='profile-right'><?= $_SESSION['USER_PERMISSION'][0] ?></div> 
                        </div>
                        <div>
                            <div class='profile-left'>Mot de passe</div>
                            <a href="modifypassword.php">
                                <button class='password-btn'>Changer le mot de passe</button>
                            </a>
                        </div>
                        <div>
                            <a href="profile.php?action=logout">
                                <button class='logout-btn'>Se déconneter</button>
                            </a>
                        </div>
                    </div>
                    <?php if(!($_SESSION['USER_PERMISSION'][0] === 'admin')) : ?>
                        <div class='account-deletion'>
                            <h2>Suppression de compte</h2>
                            <p class="subtext">Toute suppression est définitive</p>
                            <a href="profile.php?action=deleteacc">
                                <button class='deletion-btn'>Supprimer le compte</button>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($deleted) : ?>
                    <h2>Votre compte a bien été supprimé.<h2>
                    <p class="subtext">Vos avis seront conservés de manière anonyme.</p>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>