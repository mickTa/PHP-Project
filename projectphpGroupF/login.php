<?php
session_start();
require("./user.account.php");
require("./includes/landingpageheader.php");

if (isset($_SESSION['USER_ID'])) {
    echo '<h3 style="color: red;">Vous êtes déjà connecté</h3>';
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['USER_ID'])) {
    require("./includes/db.php");
    $result = login($db);
    $permissionresult = permission($db);
    if ($result === false) {
        $errorMessage = "Saisie invalide";
    } else {
        $_SESSION['USER_ID'] = $result['id'];
        $_SESSION['USER_EMAIL'] = $result['email'];
        $_SESSION['USER_PERMISSION'] = $permissionresult;
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
    <title>Login Page</title>
</head>
<body>
    <div class="center">
        <h1>Login</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<h3 style="color: red;">' . $errorMessage . '</h3>';
        }
        ?>
        
        <form class="post" method="post">
            <input type="text" name="email"/>
            <input type="password" name="password"/>
            <input type="Submit" value="Login"/>
            
        </form>
        <a href="modifypassword.php">Edit password</a>
        
    </div>
    

</body>
</html>