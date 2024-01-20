<?php
function nameMovie($db, $fileName) {
    $stmt = $db->prepare('SELECT * FROM film WHERE nom LIKE :nom');
    $stmt->execute(['nom' => '%'.$fileName.'%']);
    $movie = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $movie;
}

function nameReal($db,$fileName) {
    $stmt = $db->prepare('SELECT * FROM realisateur WHERE nom LIKE :nom');
    $stmt->execute(['nom' => '%'.$fileName.'%']);
    $real = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $real;
}
function getAllMovie($db) {
    $stmt = $db->prepare('SELECT * FROM film ');
    $stmt->execute();
    $movie = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $movie;
}
function getAllReal($db) {
    $stmt = $db->prepare('SELECT * FROM realisateur ');
    $stmt->execute();
    $movie = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $movie;
}
function deleteMovie($db, $idToDelete) {
    $stmt = $db->prepare('DELETE FROM film WHERE id = :id');
    $stmt->execute(['id' => $idToDelete]);
}
function deleteReal($db, $idToDelete) {
    $stmt = $db->prepare('DELETE FROM realisateur WHERE id = :id');
    $stmt->execute(['id' => $idToDelete]);
}
function addFilm($db, $nomFilm, $anneeFilm, $realisateurFilm) {
    $stmt = $db->prepare('INSERT INTO film(nom, annee, realisateur) VALUES (:nom, :annee, :realisateur)');
    $stmt->execute(['nom' => $nomFilm, 'annee' => $anneeFilm, 'realisateur' => $realisateurFilm]);
    
}
function addReal($db, $nomReal, $prenomReal, $ageReal) {
    $stmt = $db->prepare('INSERT INTO realisateur(nom, prenom, age) VALUES (:nom, :prenom, :age)');
    $stmt->execute(['nom' => $nomReal, 'prenom' => $prenomReal, 'age' => $ageReal]);
}
function addQuestion($db, $title, $respons) {
    $stmt = $db->prepare('INSERT INTO question(title, respons) VALUES (:title, :respons)');
    $stmt->execute(['title' => $title, 'respons' => $respons]);
}
function getAllQuestions($db) {
    $stmt = $db->prepare('SELECT * FROM question ');
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $questions;
}
function getAllPermissions($db) {
    $stmt = $db->prepare('SELECT * FROM permission');
    $stmt->execute();
    $permissions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $permissions;
}


//Changegement des permissions
function permissionAllowed($db, $id) {
    $stmt = $db->prepare('UPDATE permission SET permission = :permission WHERE id = :id');
    $stmt->execute(['id' => $id, 'permission' => "allowed"]);
}

function deletePermission($db, $id) {
    $stmt = $db->prepare('UPDATE permission SET permission = :permission WHERE id = :id');
    $stmt->execute(['id' => $id, 'permission' => "none"]);
}
function checkpermission($db) {
    $stmt = $db->prepare('SELECT permission FROM permission WHERE email=:email');
    $stmt->execute(['email' => $_SESSION['USER_EMAIL']]);
    $user = $stmt->fetch();

    return $user;
}
?>