<?php 


// effacer le garage

// on est basé sur GET => monsite/deleteGarage.php?id=3

// On va vérifier ce qu'on trouve dans get 
    // On veut qu'il ne soit pas vide 
    // On veut que ca soit un nombre


$garage_id = null;

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

    $garage_id = $_GET['id'];

}



$user = "garage";
$pass = "petitcoquin42";
$db = "garages";
$host = "localhost";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

]);

$resultat = $pdo->prepare("SELECT * FROM garages WHERE id = :garageId");
$resultat->execute([':garageId' => $garage_id]);
$garage = $resultat->rowCount();

if(!$garage){
    die("Je suis pas d'accord, ce garage n'existe pas");
} else {
    $requeteDelete =$pdo->prepare("DELETE FROM garages WHERE id = :garageId");
    $requeteDelete->execute([':garageId' => $garage_id]);
    header("Location: index.php");
}



// On génère notre PDO => notre connexion à la base de données 
        // avec les bons paramètres (erreurs, tableaux associatifs)



// on veut vérifier que cet article existe bien dans la base de données si l'article existe bien 


// Faire la requête de suppression (avec préparation)



// faire un header vers index.php