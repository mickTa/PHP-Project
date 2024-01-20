<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
<style>

.modh1{
    display:flex;
    font-family:'Roboto',sans-serif;
    font-weight: 700;
    margin-bottom: 2.5%;
    margin-top: 2%;
    margin-left:4.5%;

}
.moderationh1{
    display:flex;
    justify-content:center;
    font-family:'Roboto',sans-serif;
    font-weight: 700;
    margin-bottom: 2.5%;
    margin-top: 2%;
}
.modbutton{
    border-style: solid;
    border-radius: 8px;
    border-width: 1px;
    padding : 0.2%;
    background-color: transparent;
    font-size: 14px;
    font-family: 'Roboto';
    Margin-left: 0.2%;
}
.limod{
    display:flex;
    justify-content:center;
    align-items:space-between;
    font-family:'Roboto',sans-serif;
    margin-bottom: 2%;
    margin-top: 0.5%;


}
input{
    
    text-align:center;
    padding: 0.5%;
    border-radius: 15px;
    border-color:grey;
}
.submit_button {
    border : none;
}

</style>
<?php
require("./includes/landingpageheader.php");
require("./includes/selectdata.php");
require("./includes/db.php");
session_start();
//Si l'utilisateur n'a pas les permissions pour être sur cette page alors il est déconnecté
if (!isset($_SESSION['USER_PERMISSION']) || ($_SESSION['USER_PERMISSION'][0] != "admin" && $_SESSION['USER_PERMISSION'][0] != "allowed")) {
    header('Location: logout.php');
    exit();
}

//Affiche la permission de l'utilisateur qui est actuellement connecté


$result= checkpermission($db);

echo "La permission de l'utilisateur est : " . $result['permission'];

//Récupére toutes les permissions de la table permission

$permissions = getAllPermissions($db);
if($result['permission']== "admin"){
    // Here we delete permission
    if (isset($_GET['action']) && $_GET['action'] === "delete") {

        deletePermission($db,$_GET['id']);
        header('Location: moderation.php');
    }
    // Here we add permission
    if (isset($_GET['action']) && $_GET['action'] === "allowed") {

        permissionAllowed($db,$_GET['id']);
        header('Location: moderation.php');
    }
}

?>

<ul>
    <?php foreach ($permissions as $permission): ?>
        <li class="limod">
            Email: <?php echo $permission['email']; ?>, 
            Permission: <?php echo $permission['permission']; ?>
            <a class="modbutton" href="moderation.php?action=delete&id=<?= $permission['id']?>">Delete</a>
            <a class="modbutton" href="moderation.php?action=allowed&id=<?= $permission['id']?>">allowed</a>

            </a>
        </li>
    <?php endforeach; ?>
</ul>


<?php
//Supprime Film & Real de la base de donne si Delete

$allMovie=getAllMovie($db);
$allReal=getAllReal($db);

if (isset($_GET['action'])) {
    if($_GET['action'] === "deleteMovie") {
        deleteMovie($db,$_GET['id']);
        header('Location: moderation.php');
    }
    if($_GET['action'] === "deleteReal") {
        deleteReal($db,$_GET['id']);
        header('Location: moderation.php');
    }
}

//Affiche tous les films et tous les réalisateurs avec leur bouton supression
?>
<a class="moderationh1" href="moderation.php?action=deleteInfo">Supprimer une valeur</a>


<?php 
//Bouton pour pouvoir delete des informationns de la base de donnée
    if (isset($_GET['action']) && $_GET['action'] === "deleteInfo"):?>
    <ul>
    <h1 class="moderationh1">Liste des Films</h1>
        <?php foreach ($allMovie as $line): ?>
            <br>
        
            <li class="limod">
                Nom: <?php echo $line['nom']; ?>, 
                Annee: <?php echo $line['annee']; ?>
                Realisateur: <?php echo $line['realisateur']; ?>
                <a class="modbutton" href="moderation.php?action=deleteMovie&id=<?= $line['id']?>">Delete</a>

                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul>
    <h1 class="moderationh1">Liste des Real</h1>
        <?php foreach ($allReal as $line): ?>
            <br>
        
           <li class="limod">
                Nom: <?php echo $line['nom']; ?>, 
                Prenom: <?php echo $line['prenom']; ?>
                Age: <?php echo $line['age']; ?>
                <a class="modbutton" href="moderation.php?action=deleteReal&id=<?= $line['id']?>">Delete</a>

                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<form method="post">
    <h1 class="modh1">Insérer dans la table Film</h1>
    <input type="text" name="nom" placeholder="Saisissez le nom">
    <input type="text" name="annee" placeholder="Saisissez l'année">
    <input type="text" name="realisateur" placeholder="Saisissez le nom du real">
    <input class="submit_button" type="Submit" value="Insert">
</form>

<?php 
//Création d'une zone d'insertion de tuple pour la table FILM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomFilm = $_POST['nom'];
    $anneeFilm = $_POST['annee'];
    $realisateurFilm = $_POST['realisateur'];
    try {
        $anneeFilmEntier = intval($anneeFilm);
        if (is_numeric($anneeFilmEntier)) {
            $newMovie = addFilm($db, $nomFilm, $anneeFilmEntier, $realisateurFilm);
        } else {
            echo "L'année n'est pas un entier valide.";
        }
    } catch (Exception $e) {
        echo "<p>Une erreur s'est produite vérifier que l'année est bien de type int</p> ";
    }
}

?>

<form method="post">
    <h1 class="modh1">Insérer dans la table Realisateur</h1>
    <input type="text" name="nom" placeholder="Saisissez le nom">
    <input type="text" name="prenom" placeholder="Saisissez le prenom">
    <input type="text" name="age" placeholder="Saisissez l'âge">
    <input class="submit_button" type="Submit" value="Insert">
</form>

<?php 
//Création d'une zone d'insertion de tuple pour la table FILM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomReal = $_POST['nom'];
    $prenomReal = $_POST['prenom']; 
    $ageReal = $_POST['age'];
    try {
        $anneeAgeEntier = intval($ageReal);
        if (is_numeric($anneeAgeEntier)) {
            $newReal = addReal($db, $nomReal, $prenomReal, $anneeAgeEntier);
        } else {
            echo "L'âge n'est pas un entier valide.";
        }
    } catch (Exception $e) {
        echo "<p>Une erreur s'est produite, vérifiez que l'âge est bien de type int</p> ";
    }
}
?>   

<form method="post">
    <h1 class="modh1">Insérer dans la table question</h1>
    <input type="text" name="title" placeholder="Saisissez la question">
    <input type="text" name="respons" placeholder="Saisissez la reponse">
    <input class="submit_button" type="Submit" value="Insert">
</form>

<?php 
//Ajoute une question
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['title'];
    $respons = $_POST['respons'];
    $addQuest = addQuestion($db, $question, $respons);
}

$allQuestions = getAllQuestions($db);
?>

