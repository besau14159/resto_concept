<?php

function obtenirConnexion()
{
    $PARAM_hote='localhost'; 
    $PARAM_port='3306';
    $PARAM_utilisateur='root'; 
    $PARAM_nom_bd= 'resto_concept'; 
    $PARAM_mot_passe=''; 

    try
    {
       $connexion = new PDO(
           'mysql:host=' . $PARAM_hote . ';port=' . $PARAM_port .
           ';dbname=' . $PARAM_nom_bd, 
           $PARAM_utilisateur, $PARAM_mot_passe);
       $connexion->exec("SET CHARACTER SET utf8");
       $mode = PDO::FETCH_ASSOC; // Collection d'association
       //$mode = PDO::FETCH_OBJ;   // Objet PHP
       $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $mode); 

       return $connexion;
    } catch(Exception $e) 
      {
        echo 'Erreur : '.$e->getMessage().'<br>';
        echo 'N° : '.$e->getCode();
        die();
    }    
}

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('accueil');
});

$app->get('/connexion', function () use ($app) {
	return view('accueil');
});

$app->get('/gestioncommandes', function () use ($app) {
	$connexion = obtenirConnexion();
    $requete = $connexion->query(
        'SELECT * ' .
        'FROM commandes ' .
        'WHERE idetat = 1');
    $commandes = $requete->fetchAll();
    $requete->closeCursor();
    $connexion = null;
	return view('gestioncommandes', ['commandes' => $commandes]);
});