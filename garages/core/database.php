<?php

/**
 * 
 * Effectue la connexion avec la base de données
 * @return PDO 
 */

function getPdo():PDO{
    $pdo = new PDO("mysql:host=localhost;dbname=garages", 'garage', 'petitcoquin42',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

]);

return $pdo;
}

/**
 * 
 * Récupère tous les garages présents dans la table garage
 * @return array
 * 
 */

function findAllGarages():array{

$pdo = getPdo();

$requete = "SELECT * FROM garages";

$resultat = $pdo->query($requete);

$garages = $resultat->fetchAll();

return $garages;
}

/**
 * Retourne un tableau avec le garage correspondant à l'ID passé en paramètre
 * @param integer
 * @return array|bool 
 * 
 */
function findGarageById(int $id){


$pdo = getPdo();

$resultat = $pdo->prepare("SELECT * FROM garages WHERE id =:garageId");
$resultat->execute([':garageId' => $id]);

$garage = $resultat->fetch();

return $garage;
}

/**
 * 
 * Récupère toutes les annonces sous forme de tableau
 * @return array
 * 
 */



/**
 * 
 * Récupère toutes les annonces correspondant à l'ID d'un garage passé en paramètre
 * Renvoie un tableau d'annonces
 * @param integer $garage_id
 * @return array|bool
 */
function findAllAnnoncesByGarage(int $garage_id) {

    $pdo = getPdo();
    $resultatAnnonces = $pdo->prepare("SELECT * FROM annonces WHERE garage_id=:garageId");
    $resultatAnnonces->execute([':garageId' => $garage_id]);


    $annonces = $resultatAnnonces->fetchAll();

    return $annonces;
}



/**
 * Trouve une annonce
 * @param integer
 * @return array|bool 
 */

function findAnnonce(int $annonce_id){
$pdo = getPdo();
$resultat = $pdo->prepare("SELECT * FROM annonces WHERE id = :annonceId");
$resultat->execute([':annonceId' => $annonce_id]);
$annonce = $resultat->fetch();
return $annonce;

}

/**
 * Supprime l'annonce correspondant à l'ID passé en paramètre
 * @param integer $annonce_id
 * @return void
 */


function deleteAnnonce(int $annonce_id): void{

    $pdo = getPdo();
    $requeteDelete =$pdo->prepare("DELETE FROM annonces WHERE id = :annonceId");
    $requeteDelete->execute([':annonceId' => $annonce_id]);

}


/**
 * Ajoute une annonce dans la base de données 
 * @param string $annonceName
 * @param int $annoncePrice
 * @param int $garage_id
 * @return void
 */

function insertAnnonce(string $annonceName, int $annoncePrice, int $garage_id):void {
    $pdo = getPdo();
    $maRequete = $pdo->prepare('INSERT INTO annonces (name, price, garage_id) VALUES (:nom, :prix, :garage_id)');
$maRequete->execute([
    // Binding
    'nom' => $annonceName,
    'prix' => $annoncePrice,
    'garage_id' => $garage_id                
]);

}
/**
 * Supprime un garage de la BDD selon son ID
 * @param integer $garage_id
 * @return void 
 */

function deleteGarage(int $garage_id):void{
    
    $pdo = getPdo();
    $requeteDelete =$pdo->prepare("DELETE FROM garages WHERE id = :garageId");
    $requeteDelete->execute([':garageId' => $garage_id]);
}

?>