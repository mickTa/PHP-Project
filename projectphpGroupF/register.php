<?php

require("./user.account.php");
require("./includes/landingpageheader.php");
if (isset($_SESSION['USER_ID'])) {
    echo '<h3 style="color: red;">Vous êtes déjà connecté</h3>';
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['USER_ID'])) {
    require("./includes/db.php");
    $result = register($db);
    if (is_string($result)) {
        $error = $result;
    } else {
        // Traitement réussi, par exemple, redirection vers une autre page
        header('Location: landingpage.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <h1>REGISTER PAGE</h1>
    <form method="post">
        <input type="text" name="email"/>
        <input type="password" name="password"/>
        <input type="Submit" value="Login"/>
    
    </form>

</body>
</html>
