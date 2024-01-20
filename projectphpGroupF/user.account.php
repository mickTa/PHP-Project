<?php
function register($db) {
    $stmt = $db->prepare('SELECT * FROM account WHERE email = :email');
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch();

    if ($user) {
        return "Email already in use";
    }
    if (!isset($user["email"]) || !isset($user["password"])) {
        echo "Invalid you must to use an email adress and an email";
        return "Invald";
    }
    $stmt = $db->prepare('INSERT INTO account (email, password, questionStatus, quizzscore) VALUES (:email, :password, :questionStatus, :quizzscore)');
    $stmt->execute([
        "email" => $_POST['email'],
        "questionStatus" => "NULL",
        "quizzscore" => 0,
        "password" => password_hash($_POST['password'], PASSWORD_BCRYPT)
    ]);
    $stmt = $db->prepare('INSERT INTO permission (email) VALUES (:email)');
    $stmt->execute(['email' => $_POST['email']]);
    
}
function login($db) {
    $stmt = $db->prepare('SELECT * FROM account WHERE email = :email');
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (!password_verify($_POST['password'], $user['password'])) {
        return false;
    }

    return $user;
}

function editpassword($db) {
    $stmt = $db->prepare('SELECT * FROM account WHERE email = :email');
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }
    // Pas de compte pour l'adresse email donné
    $stmt = $db->prepare('UPDATE account SET password=:password WHERE email=:email');
    $stmt->execute([
        "email" => $_POST['email'],
        "password" => password_hash($_POST['password'], PASSWORD_BCRYPT)
    ]);
    

}
function getUser($db, $id)
{
    $stmt = $db->query('SELECT * FROM user_account WHERE id=' . $id);
    return $stmt->fetch();
}
function permission($db) {
    $stmt = $db->prepare('SELECT permission FROM permission WHERE email=:email');
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch();
    return $user;
}
function checkScore($db) {
    $stmt= $db->prepare('SELECT quizzscore FROM account WHERE id = :id ');
    $stmt->execute(["id" => $_SESSION['USER_ID']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['quizzscore'];
}

function accdeletion($db, $id) {
    $db->query('DELETE FROM permission WHERE id=' . $id);
    $db->query('DELETE FROM account WHERE id=' . $id);
}
?>