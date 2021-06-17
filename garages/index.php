<?php 
// On récupère les librairies nécessaires
require_once "core/database.php";
require_once "core/utils.php";

// On récupère tous les garages
$garages = findAllGarages();

// On nomme notre page
$titreDeLaPage = "Garages";

// On affiche le contenu 

render('garages/garages', compact('garages', 'titreDeLaPage')
);








