<?php 


// Lorsque l'on passe un paramètre GET avec un numéro de garage, 

// si get existe, et qu'il est bien un integer, 

// alors on utilise PDO pour récupérer le garage en question 

// et l'afficher dans un var_dump


$garage_id = null;


if(!empty($_GET['id']) && ctype_digit($_GET['id'])){


$garage_id = $_GET['id'];

}

if(!$garage_id){

    die("J'ai besoin d'un paramètre dans l'URL");

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

$resultat = $pdo->prepare("SELECT * FROM garages WHERE id =:garageId");
$resultat->execute([':garageId' => $garage_id]);

$garage = $resultat->fetch();

$resultatAnnonces = $pdo->prepare("SELECT * FROM annonces WHERE garage_id=:garageId");
$resultatAnnonces->execute([':garageId' => $garage_id]);


$annonces = $resultatAnnonces->fetchAll();


$titreDeLaPage = $garage['name'];


ob_start();

require_once "templates/garages/garage.html.php";


$contenuDeLaPage = ob_get_clean();

require_once "templates/layout.html.php";
