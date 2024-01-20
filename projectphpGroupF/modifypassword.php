<?php
require("./user.account.php");
require("./includes/landingpageheader.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("./includes/db.php");
    $result = editpassword($db);
    if ($result === false) {
        $error = $result;
    } else {
        // Traitement réussi, par exemple, redirection vers une autre page
        header('Location: quizz.php');
        exit();
    }
}

?>
<h1>Modify password</h1>
<p>Veuillez tapez votre mail et votre nouveau mot de passe</p>
<form method="post">
<input type="text" name="email"/>
<input type="password" name="password"/>
<input type="Submit" value="Login"/>