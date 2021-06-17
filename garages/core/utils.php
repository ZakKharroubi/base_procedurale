<?php 

/**
 * redirige vers l'url passé en parametre
 * @param string
 */



function redirect(string $url): void{

    header("Location: $url");

}

/**
 * 
 * genere le rendu des données interpolées dans un template
 * @param string 
 * @param array
 * 
 */
function render(string $template, array $donnees) : void{

    extract($donnees);

    ob_start();

require_once "templates/".$template.".html.php";

$contenuDeLaPage = ob_get_clean();

require_once "templates/layout.html.php";
}






?>