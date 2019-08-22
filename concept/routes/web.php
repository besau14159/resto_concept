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
        'SELECT commandes.idCommande AS idCommande, CONCAT(comptes.prenom, " ", comptes.nom) ' .
		'AS nom, comptes.telephone AS telephone ' .
        'FROM commandes INNER JOIN comptes ' .
		'ON commandes.noClient = comptes.noCompte ' .
        'WHERE idetat = 3');
    $commandes = $requete->fetchAll();
    $requete->closeCursor();
    $connexion = null;
	return view('gestioncommandes', ['commandes' => $commandes]);
});

$app->get('/gestioncommandes/{idCommande}', function ($idCommande) use ($app) {
	session_start();
	$connexion = obtenirConnexion();
    $requete = $connexion->query(
        'SELECT commandes.idCommande AS idCommande, CONCAT(comptes.prenom, " ", comptes.nom) ' .
		'AS nom, comptes.telephone AS telephone ' .
        'FROM commandes INNER JOIN comptes ' .
		'ON commandes.noClient = comptes.noCompte ' .
        'WHERE idetat = 3');
    $commandes = $requete->fetchAll();
    $requete->closeCursor();
	
	$connexion = obtenirConnexion();
	$requete2 = $connexion->query(
		'SELECT datecommande, commentaires ' .
		'FROM commandes ' .
		'WHERE noClient = (SELECT noClient FROM commandes WHERE idCommande = '. $idCommande.')'
	);
	$historique = $requete2->fetchAll();
	$requete2->closeCursor();
	
	$connexion = obtenirConnexion();
	$requete3 = $connexion->query(
		'SELECT noProduit, qte ' .
		'FROM items_commande ' .
		'WHERE noCommande = '. $idCommande
	);
	$details = $requete3->fetchAll();
	$requete3->closeCursor();
    $connexion = null;
	return view('gestioncommandes', ['id' => $idCommande, 'commandes' => $commandes, 'details' => $details, 'historique' => $historique]);
});

$app->get('ajouterMenu', function() use($app)
{
    session_start();

    if(!isset($_SESSION['resto']))
    {
        return redirect('restaurants/{selected}');
    }

    if(!isset($_SESSION['items']))
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->query(
        'SELECT * FROM produits');
        $items = $requete->fetchAll();
        $requete->closeCursor();
        $connexion = null;

        $_SESSION['items'] = $items;
    }

    if (!isset($_SESSION['itemAAjouter']))
    {
        $_SESSION['itemsMenu'] = array();
        
        $_SESSION['itemAAjouter'] = 0;

        $_SESSION['itemAEnlever'] = 0;
    }

    

    return view('ajouterMenu');
});

$app->get('selectionnerItemListe/{selected}', function($selected) use($app)
{
    session_start();

    if ($selected != '%7Bselected%7D')
    {
        $_SESSION['itemAAjouter'] = $selected;
    }

    return redirect('ajouterMenu');
});

$app->get('selectionnerItemMenu/{selected}', function($selected) use($app)
{
    session_start();

    if ($selected != '%7Bselected%7D')
    {
        $_SESSION['itemAEnlever'] = $selected;
    }

    return redirect('ajouterMenu');
});

$app->get('ajouterItem', function() use($app)
{
    session_start();

    if ($_SESSION['itemAAjouter'] != 0)
    {
        $trouver = 0;

        foreach ($_SESSION['itemsMenu'] as $item) 
        {
            if ($item['idProduit'] == $_SESSION['itemAAjouter'])
            {   
                $trouver = 1;
            }
        }

        if ($trouver == 0)
        {
           foreach ($_SESSION['items'] as $item) 
           {
                if ($item['idProduit'] == $_SESSION['itemAAjouter']) 
                {
                    $itemAAjouter = $item;
                }
            } 

            array_push($_SESSION['itemsMenu'], $itemAAjouter);
        }
        
        $_SESSION['itemAAjouter'] = 0;
    }

    return redirect('ajouterMenu');
});

$app->get('enleverItem', function() use($app)
{
    session_start();

    if ($_SESSION['itemAEnlever'] != 0)
    {
        $imenu = array();

        foreach ($_SESSION['itemsMenu'] as $item) 
        {
            if ($item['idProduit'] != $_SESSION['itemAEnlever']) 
            {
                array_push($imenu, $item);            
            }
        } 

        $_SESSION['itemsMenu'] = $imenu;
        $_SESSION['itemAEnlever'] = 0;
    }

    return redirect('ajouterMenu');
});

$app->get('restaurants/{selected}', function($selected) use($app)
{
    session_start();

    if ($selected != '%7Bselected%7D')
    {
        $_SESSION['resto'] = $selected;
    }

    if(!isset($_SESSION['restaurants']))
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->query(
        'SELECT * FROM restaurants');
        $restaurants = $requete->fetchAll();
        $requete->closeCursor();
        $connexion = null;

        $_SESSION['restaurants'] = $restaurants;
    }
    

    return view('restaurants',
                ['selected' => $selected]);
});

$app->post('recherche', function() use($app){
    $chaine = $app->request->input('recherche');    

    if ($chaine != '')
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->prepare(
            'SELECT idresto FROM restaurants
            WHERE LOCATE(:chaine,nomresto) > 0 ');
        $requete->execute(['chaine' => $chaine]);
        $selected = $requete->fetch();
        $requete->closeCursor();
        $connexion = null;
    }
    else
    {
        $selected['idresto'] = 0;
    }

    return redirect('restaurants/' . $selected['idresto']);
});

$app->post('rechercheItem', function() use($app){
    $chaine = $app->request->input('recherche');    
    $selected = null;

    if ($chaine != '')
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->prepare(
            'SELECT idproduit FROM produits
            WHERE LOCATE(:chaine,nomProd) > 0 ');
        $requete->execute(['chaine' => $chaine]);
        $selected = $requete->fetch();
        $requete->closeCursor();
        $connexion = null;
    }
    
    if ($selected == null)
        $selected['idproduit'] = 0;
    
    return redirect('ajouterMenu/' . $selected['idproduit']);
});