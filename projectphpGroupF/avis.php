<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8"/>
    <title>Avis clientèle</title>
    <?php require("./includes/landingpageheader.php"); ?>
</head>

<body>
<h1>Avis Film</h1>    

<form method="post">
    <h3>Votre pseudo:</h3>
    <input type="text" id="pseudo" name="pseudo"> 

    <h3>Nom du Film:</h3>
    <input type="text" id="nomFilm" name="nomFilm"> <br>

    <h3>Commentaire:</h3>
    <textarea id="commentaire" name="commentaire" rows="4"></textarea><br>

    <label for="note">Note:</label>
    <select id="note" name="note">
        <option value="1">1/5</option>
        <option value="2">2/5</option>
        <option value="3">3/5</option>
        <option value="4">4/5</option>
        <option value="5">5/5</option>
    </select><br>

    <button type="submit">Ajouter l'Avis</button>
</form>

<?php
require("./includes/db.php");

function addAvis($db, $pseudo, $nomFilm, $note, $commentaire) {
    $stmt = $db->prepare('INSERT INTO avisfilm(pseudo, nomFilm, note, commentaire) VALUES (:pseudo, :nomFilm, :note, :commentaire)');
    $stmt->execute(['pseudo' => $pseudo, 'nomFilm' => $nomFilm, 'note' => $note, 'commentaire' => $commentaire]);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['pseudo']!=NULL && $_POST['nomFilm']!=NULL
                                     && $_POST['note']!=NULL && $_POST['commentaire']!=NULL ) {

    $pseudo = $_POST['pseudo'];
    $nomFilm = $_POST['nomFilm'];
    $note = $_POST['note'];
    $commentaire = $_POST['commentaire'];
    
    addAvis($db, $pseudo, $nomFilm, $note, $commentaire);
    echo "Success";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['pseudo']==NULL || $_POST['nomFilm']==NULL || $_POST['note']==NULL || $_POST['commentaire']==NULL )) {
    echo "Tous les champs doivent être rempli pour poster un avis";
}
?>
</body>
</html>
