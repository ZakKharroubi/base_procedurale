<?php 

// Documentation PDO 

// Etablir connexion avec la db

// Préparer la requête avec PDO

// Exécuter la requête avec des options : on veut obtenir un tableau associatif

// Stocker le résultat de la requête dans la variable $garages


$user = "garage";
$pass = "petitcoquin42";
$db = "garages";
$host = "localhost";


$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, [
 PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_ASSOC,
 PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

]);

$requete = "SELECT * FROM garages";




$resultat = $pdo->query($requete);

$garages = $resultat->fetchAll();


$titreDeLaPage = "Garages";

// buffer

ob_start();

require_once "templates/garages/garages.html.php";

$contenuDeLaPage = ob_get_clean();

require_once "templates/layout.html.php";









