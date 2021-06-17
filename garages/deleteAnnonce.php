<?php 

require_once "core/database.php";
require_once "core/utils.php";

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

    $annonce_id = $_GET['id'];

}
$annonce = findAnnonce($annonce_id);


if(!$annonce){
    die("Je suis pas d'accord, cette annonce n'existe pas");
    // Sinon, on prépare et exécute la requête de suppression
} 
    deleteAnnonce($annonce_id);
    // Et on redirige vers le garage
    redirect("garage.php?id=".$annonce['garage_id']);
?>

