<?php 
require_once "core/database.php";
require_once "core/utils.php";
// effacer le garage

// on est basé sur GET => monsite/deleteGarage.php?id=3

// On va vérifier ce qu'on trouve dans get 
    // On veut qu'il ne soit pas vide 
    // On veut que ca soit un nombre


$garage_id = null;

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

    $garage_id = $_GET['id'];

}

// Connexion DB
$pdo = getPdo();


$garage = findGarageById($garage_id);

if(!$garage){
    die("Je suis pas d'accord, ce garage n'existe pas");
} 
deleteGarage($garage_id);
redirect("index.php");




// On génère notre PDO => notre connexion à la base de données 
        // avec les bons paramètres (erreurs, tableaux associatifs)



// on veut vérifier que cet article existe bien dans la base de données si l'article existe bien 


// Faire la requête de suppression (avec préparation)



