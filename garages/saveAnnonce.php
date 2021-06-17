<?php 

require_once "core/database.php";
require_once "core/utils.php";

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

$garage = findGarageById($garage_id);

// Existence garage ? 

if(!$garage){
    die("Ce garage n'existe pas");
}

insertAnnonce($annonceName, $annoncePrice, $garage_id);

redirect("garage.php?id=$garage_id");



