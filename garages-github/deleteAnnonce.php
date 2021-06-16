<?php 

// Je vérifie que GET n'est pas vide, et que sa valeur est bien un integer
$annonce_id = null;

if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

    $annonce_id = $_GET['id'];

}

// Etablissement de la connexion avec la base de données

$user = "garage";
$pass = "petitcoquin42";
$db = "garages";
$host = "localhost";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

]);
// On sélectionne l'annonce pour vérifier qu'elle existe bien
$resultat = $pdo->prepare("SELECT * FROM annonces WHERE id = :annonceId");
$resultat->execute([':annonceId' => $annonce_id]);
$annonce = $resultat->fetch();
// On prend au passage le garage id, qui sera utile pour la redirection
$garageId = $annonce['garage_id'];
$annonceVerify = $resultat->rowCount();


// Si le rowCount vaut 0, l'annonce n'existe pas
if($annonceVerify == 0){
    die("Je suis pas d'accord, cette annonce n'existe pas");
    // Sinon, on prépare et exécute la requête de suppression
} 
    $requeteDelete =$pdo->prepare("DELETE FROM annonces WHERE id = :annonceId");
    $requeteDelete->execute([':annonceId' => $annonce_id]);
    // Et on redirige vers le garage
    header("Location: garage.php?id=$garageId");

?>

