<?php 

$annonceName = null;
$annoncePrice = null;
$garage_id = null;


// Surveiller $_POST 

if(!empty($_POST['garageId']) && ctype_digit($_POST['garageId']) ){
    $garage_id = $_POST['garageId'];
}

if(!empty($_POST['name']) ){
    $annonceName = htmlspecialchars($_POST['name']);
}

if(!empty($_POST['price']) ){
    $annoncePrice = htmlspecialchars($_POST['price']);
}

if( !$garage_id || !$annonceName || !$annoncePrice ){
    die("formulaire mal rempli $annonceName, $annoncePrice, $garage_id");
}
    

    // Connexion DB
$user = "garage";
$pass = "petitcoquin42";
$db = "garages";
$host = "localhost";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

]);

$maRequete = $pdo->prepare('SELECT * FROM garages WHERE id = :garage_id');
$maRequete -> execute([':garage_id' => $garage_id]);
$garage = $maRequete->fetch();

// Existence garage ? 

if(!$garage){
    die("Ce garage n'existe pas");
}

$maRequete = $pdo->prepare('INSERT INTO annonces (name, price, garage_id) VALUES (:nom, :prix, :garage_id)');
$maRequete->execute([
    // Binding
    'nom' => $annonceName,
    'prix' => $annoncePrice,
    'garage_id' => $garage_id                
]);

header("Location: garage.php?id=$garage_id");




// Vérifier les trois données transmises par POST

//  Vérifier l'existence du garage
// Si le garage est inexistant, die("garage inexistant")

// Sinon, insérer nouvelle annonce

// Redirection vers garage