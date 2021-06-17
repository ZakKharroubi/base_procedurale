<?php 

require_once "core/database.php";
require_once "core/utils.php";

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

$pdo = getPdo();

$garage = findGarageById($garage_id);


$annonces = findAllAnnoncesByGarage($garage_id);

$titreDeLaPage = $garage['name'];


render("garages/garage", compact('garage', 'annonces', 'titreDeLaPage'));
