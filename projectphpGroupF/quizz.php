<?php include("./includes/landingpageheader.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    session_start();
    require("./includes/db.php");

function saveMade($db) {
    $stmt= $db->prepare('UPDATE account SET questionStatus= :questionStatus WHERE id =:id');
    $stmt->execute(["id" => $_SESSION['USER_ID'],
                    "questionStatus" => "true"]);
    $newStatus = checkStatus($db);
    return $newStatus;

}
function checkStatus($db) {
    $stmt= $db->prepare('SELECT questionStatus FROM account WHERE id = :id ');
    $stmt->execute(["id" => $_SESSION['USER_ID']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['questionStatus'];

}
function saveScore($db, $score) {
    $stmt= $db->prepare('UPDATE account SET quizzscore= :quizzscore WHERE id =:id');
    $stmt->execute(["id" => $_SESSION['USER_ID'],
                    "quizzscore" => $score]);
}

$stmt = $db->prepare('SELECT idQUEST, title, respons FROM question');
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
$score=0;
// vérification 1 
$resultcheck= checkStatus($db);

    if(isset($_SESSION['USER_ID'])) {
        echo "<h1>Vous êtes bien connecté</h1>";
    } else {
        echo "<h1>Vous devez vous connectez pour faire le quizz</h1>";
    }
    if ($_SESSION['USER_PERMISSION'][0]=="admin" || $_SESSION['USER_PERMISSION'][0]=="allowed"){
        ?><a href="moderation.php">Moderation</a><?php
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $resultcheck!="true" && isset($_SESSION['USER_ID'])) {
        foreach ($questions as $question) {
            $proposition = $_POST['reponse' . $question['idQUEST']];
            if ($proposition == $question['respons']) {
                $score=$score+1;
                $resultmade=saveMade($db);
                $_SESSION['QUIZZ_MADE'] = true;
                echo "<h1> Score ".$score." / 5</h1>";
                echo "Bravo! La réponse à la question " . $question['title'] . " est correcte : " . $proposition . "<br>";
                
            } else {
                echo "Dommage! La réponse à la question " . $question['title'] . " est incorrecte : " . $proposition . "<br>"; 
                
            }
        }
        saveScore($db, $score);
    }
    ?>
    <?php if ($resultcheck!="true" && !isset($_SESSION['QUIZZ_MADE']) && isset($_SESSION['USER_ID'])): ?>
        <form method="post">
            <?php foreach ($questions as $question): ?>
                <h3><?php echo $question['title']; ?></h3>
                <input type="text" name="reponse<?php echo $question['idQUEST']; ?>"/>
            <?php endforeach; ?>
            <button type="submit" class="réponse">Submit</button>
            </form>
        
    <?php endif; ?>
    <?php if ($resultcheck=="true") {
        require_once("./user.account.php");
        echo "<h2>Vous avez déjà fait le questionnaire votre score est de " . checkScore($db) . "/5</h2>";
    }
        
    ?>
</body>
</html>