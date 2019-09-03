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
    session_start();
    session_destroy();
    return view('accueil');
});

$app->get('sinscrire', function() use($app) {
    session_start();
    if (!isset($_SESSION['message'])) {
        $_SESSION['message'] = '';
    }
    return view('/sinscrire');
});

$app->post('validerinscription', function() use($app) {
    
    session_start();
    $courriel = $app->request->input('courriel');
    $mdp = $app->request->input('motdepasse');
    $mdpverif = $app->request->input('motdepasseverif');
    $nom = $app->request->input('nom');
    $prenom = $app->request->input('prenom');
    $nomutilisateur = $app->request->input('nomutilisateur');
    $telephone = $app->request->input('telephone');
    $nocivique = $app->request->input('nocivique');
    $rue = $app->request->input('rue');
    $ville = $app->request->input('ville');
    $province = $app->request->input('province');
    $codepostal = $app->request->input('codepostal');
    $rediriger = 'echecinsc';
    if(!(($courriel == null) || ($mdp == null) || ($mdpverif == null) || ($nom == null) || ($prenom == null) ||
     ($nomutilisateur == null) || ($telephone == null) || ($nocivique == null) || ($rue == null) || ($ville ==null) || 
     ($province == null) || ($codepostal == null) || ($mdp != $mdpverif))) {
        $connexion = obtenirConnexion();
        $requeteadresses = $connexion->prepare(
            'INSERT INTO adresses (nocvq,rue,ville,province,codepostal,telephone) VALUES (:nocvq,:rue,:ville,:province,:codepostal,:telephone)'
        );
        $requeteadresses->execute(['nocvq' => $nocivique, 'rue' => $rue, 'ville' => $ville, 'province' => $province, 'codepostal' => $codepostal, 'telephone' => $telephone]);
        $connexion = null;

        $connexion = obtenirConnexion();
        $requetenoadrs = $connexion->prepare(
            'SELECT idadrs FROM adresses WHERE telephone = :telephone');
        $requetenoadrs->execute(['telephone' => $telephone]);
        $noadrs = $requetenoadrs->fetch();
        $requetenoadrs->closeCursor();
        $connexion = null;

        $connexion = obtenirConnexion();
        $requetecomptes = $connexion->prepare(
            'INSERT INTO comptes (prenom,nom,telephone,courriel,nomutilisateur,motpasse,actif,noadrs,notpcmpt,commentaires) ' . 
            'VALUES (:prenom,:nom,:telephone,:courriel,:nomutilisateur,:motdepasse,1,:noadrs,1,:commentaire)');
        $requetecomptes->execute(['prenom' => $prenom, 'nom' => $nom, 'telephone' => $telephone, 'courriel' => $courriel, 
            'nomutilisateur' => $nomutilisateur, 'motdepasse' => $mdp, 'noadrs' => $noadrs['idadrs'], 'commentaire' => '']);
        $connexion = null;

        $connexion = obtenirConnexion();
        $requeteconnexion = $connexion->prepare(
            'SELECT courriel,motpasse,CONCAT(comptes.prenom, " ", comptes.nom) AS nom '.
            'FROM comptes ' .
            'WHERE courriel = :courriel');
        $requeteconnexion->execute(['courriel' => $courriel]);
        $resultat = $requeteconnexion->fetch();
        $requeteconnexion->closeCursor();
        $connexion = null;

        $rediriger = '/commande';
        $_SESSION['utilisateur'] = $resultat;
     }

     return redirect($rediriger);
});

$app->get('/connexion', function() use($app)
{
    session_start();
    if (!isset($_SESSION['message'])) {
        $_SESSION['message'] = '';
    }
    
    return view('/connexion');
});

$app->post('/authentifier', function() use($app)
{
    session_start();
    $_SESSION['message'] = null;
    $id = $app->request->input('courriel');
    $mdp = $app->request->input('motdepasse');
    $rediriger = 'echecauth';
    if (!(($id == null) || ($mdp == null))) {
        $connexion = obtenirConnexion();
        $requete = $connexion->prepare(
            'SELECT courriel,motpasse,CONCAT(comptes.prenom, " ", comptes.nom) AS nom '.
            'FROM comptes ' .
            'WHERE courriel = :id');
        $requete->execute(['id' => $id]);
        $resultat = $requete->fetch();
        $requete->closeCursor();
        $connexion = null;
        if (($resultat['courriel'] == $id) && ($resultat['motpasse'] == $mdp)) {
            $rediriger = '/commande';
            $_SESSION['utilisateur'] = $resultat;
        }
    }
    
    return redirect($rediriger);
});

$app->get('/echecauth', function() use($app) {
    session_start();
    session_destroy();
    session_start();
    $_SESSION['message'] = 'Votre authentification a échoué';
    return redirect('/connexion');
});

$app->get('echecinsc', function() use($app) {
    session_start();
    session_destroy();
    session_start();
    $_SESSION['message'] = 'Votre inscription a échoué';
    return redirect('/sinscrire');
});

$app->get('/deconnecter', function() use($app) {
    session_start();
    session_destroy();
    return redirect('/');
});

$app->get('/gestioncommandes', function () use ($app) {
	session_start();
	$etatEnAttente = 1;
	
	$_SESSION['commandeAAccepter'] = null;
	
	if(!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['notpCompte'] != 2){
		//return view('erreur');
	}
	
	$connexion = obtenirConnexion();
    $requete = $connexion->prepare(
        'SELECT commandes.idCommande AS idCommande, CONCAT(comptes.prenom, " ", comptes.nom) ' .
		'AS nom, comptes.telephone AS telephone ' .
        'FROM commandes INNER JOIN comptes ' .
		'ON commandes.noClient = comptes.noCompte ' .
        'WHERE idetat = :idEtat');
	$requete->execute(['idEtat' => $etatEnAttente]);
    $commandes = $requete->fetchAll();
    $requete->closeCursor();
    $connexion = null;
	return view('gestioncommandes', ['commandes' => $commandes]);
});

$app->get('/gestioncommandes/{idCommande}', function ($idCommande) use ($app) {
	session_start();
	$etatEnAttente = 1;
	$_SESSION['commandeAAccepter'] = $idCommande;
	
	$connexion = obtenirConnexion();
    $requete = $connexion->prepare(
        'SELECT commandes.idCommande AS idCommande, CONCAT(comptes.prenom, " ", comptes.nom) ' .
		'AS nom, comptes.telephone AS telephone ' .
        'FROM commandes INNER JOIN comptes ' .
		'ON commandes.noClient = comptes.noCompte ' .
        'WHERE idetat = :idEtat');
	$requete->execute(['idEtat' => $etatEnAttente]);
    $commandes = $requete->fetchAll();
    $requete->closeCursor();
	
	$requete2 = $connexion->prepare(
		'SELECT datecommande, commentaires ' .
		'FROM commandes ' .
		'WHERE noClient = (SELECT noClient FROM commandes WHERE idCommande = :idCommande)'
	);
	$requete2->execute(['idCommande' => $idCommande]);
	$historique = $requete2->fetchAll();
	$requete2->closeCursor();
	
	$requete3 = $connexion->query(
		'SELECT produits.nomProd AS noProduit, items_commande.qte AS qte ' .
		'FROM items_commande INNER JOIN produits ' .
		'ON items_commande.noProduit = produits.idProduit ' .
		'WHERE noCommande = '. $idCommande
	);

	$details = $requete3->fetchAll();
	$requete3->closeCursor();
    $connexion = null;
	return view('gestioncommandes', ['id' => $idCommande, 'commandes' => $commandes, 'details' => $details, 'historique' => $historique]);
});

$app->post('/accepterCommande', function() use($app){
	session_start();
	if(!isset($_SESSION['commandeAAccepter'])){
		return view('erreur');
	}
	$idCommande = $_SESSION['commandeAAccepter'];

    $connexion = obtenirConnexion();
    $requete = $connexion->prepare(
        'UPDATE commandes SET idetat = 1 '.
		'WHERE idCommande = :idCommande');
    $requete->execute(['idCommande' => $idCommande]);
    $connexion = null;
	
	return redirect('/gestioncommandes');
});

$app->get('/ajouterMenu', function() use($app)
{
    session_start();

    if(!isset($_SESSION['resto']))
    {
        return redirect('/restaurants/{selected}');
    }

    if(!isset($_SESSION['titreMenu']))
    {
        return redirect('/donneeMenu');
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

    return view('/ajouterMenu');
});

$app->get('/selectionnerItemListe/{selected}', function($selected) use($app)
{
    session_start();

    if ($selected != '%7Bselected%7D')
    {
        $_SESSION['itemAAjouter'] = $selected;
    }

    return redirect('/ajouterMenu');
});

$app->get('/selectionnerItemMenu/{selected}', function($selected) use($app)
{
    session_start();

    if ($selected != '%7Bselected%7D')
    {
        $_SESSION['itemAEnlever'] = $selected;
    }

    return redirect('/ajouterMenu');
});

$app->get('/ajouterItem', function() use($app)
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

    return redirect('/ajouterMenu');
});

$app->get('/enleverItem', function() use($app)
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

    return redirect('/ajouterMenu');
});

$app->get('/restaurants/{selected}', function($selected) use($app)
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
    

    return view('/restaurants',
                ['selected' => $selected]);
});

$app->post('/recherche', function() use($app){
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

    return redirect('/restaurants/' . $selected['idresto']);
});

$app->post('/rechercheItem', function() use($app){
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
    
    return redirect('/selectionnerItemListe/' . $selected['idproduit']);
});

$app->post('/donneeMenu', function() use($app)
{
    session_start();
    $titre = $app->request->input('titreMenu');
    if ($titre == '') 
    {
        $_SESSION['message'] = 'Vous devez entrer le titre du menu';
        return redirect('/donneeMenu');
    }
    unset($_SESSION['message']);

    $commentaire = $app->request->input('commentaire');
    $actif = $app->request->input('chkActif');
    if ($actif == 'on')
    {
        $_SESSION['actif'] = 'checked';
    }
    else
    {
        $_SESSION['actif'] = 'unchecked';
    }
    $_SESSION['titreMenu'] = $titre;
    $_SESSION['commentaire'] = $commentaire;


    return redirect('/ajouterMenu');
});

$app->get('/donneeMenu', function() use($app)
{
    session_start();

    if(!isset($_SESSION['titreMenu']))
    {
        $_SESSION['titreMenu'] = '';
        $_SESSION['commentaire'] = '';
        $_SESSION['actif'] = 'unchecked';
    }
    
    return view('donneeMenu');
});

$app->get('/sauvegarderMenu', function() use($app)
{
    session_start();

    $connexion = obtenirConnexion();
    
    if ($_SESSION['actif'] == 'checked')
    {
        $actif = '1';
    }
    else
    {
        $actif = '0';
    }
    $requete = $connexion->prepare(
        'INSERT INTO menus ' .
        '(idMenu, titreMenu, actif, commentaires, idResto) ' .
        'VALUES(5, :titre, :actif, :commentaires, :id) ');

    $requete->execute(['titre' => $_SESSION['titreMenu'], 'actif' => $actif, 'commentaires' => $_SESSION['commentaire'], 'id' => $_SESSION['resto']]);
    $requete->closeCursor();
    
    $requete = $connexion->prepare(
        'SELECT idMenu FROM menus ' .
        'WHERE titreMenu = :titre AND idResto = :id ');

    $requete->execute(['titre' => $_SESSION['titreMenu'], 'id' => $_SESSION['resto']]);
    $idMenu = $requete->fetch();
    $requete->closeCursor();

    $requete = $connexion->prepare(
        'INSERT INTO menu_produits ' .
        '(idMenu, idProduit) ' .
        'VALUES(:idMenu, :idProduit) ');

    foreach ($_SESSION['itemsMenu'] as $unItem) 
    {
        $requete->execute(['idMenu' => $idMenu['idMenu'], 'idProduit' => $unItem['idProduit']]);    
    }

    $requete->closeCursor();   
    $connexion = null;

    unset($_SESSION['titreMenu']);
    unset($_SESSION['actif']);
    unset($_SESSION['commentaire']);
    unset($_SESSION['resto']);
    unset($_SESSION['itemsMenu']);

    return redirect('/');
});

$app->get('/infoItem/{selected}', function($selected) use($app)
{
    session_start();

    foreach ($_SESSION['items'] as $produit) {
        if ($produit['idProduit'] == $selected)
        {
            $item = $produit;
        }
    }
    
    return view('/infoItem',
                ['item' => $item]);
});

/*
|--------------------------------------------------------------------------
| Commande Routes Debut
|--------------------------------------------------------------------------

<?php var_dump($_SESSION['restaurants']); ?>

@if (isset($_SESSION['selectedCat']))
                    <?php
                    var_dump($_SESSION['selectedCat']); 
                    ?>
@endif

*/

$app->get('/commande', function () use ($app) {
    session_start();

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
    
    if(!isset($_SESSION['categories']))
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->query(
        'SELECT * FROM categories');
        $categories = $requete->fetchAll();
        $requete->closeCursor();
        $connexion = null;

        $_SESSION['categories'] = $categories;
    }

    if(!isset($_SESSION['modespaiement']))
    {
        $connexion = obtenirConnexion();
        $requete = $connexion->query(
        'SELECT * FROM modespaiement');
        $modespaiement = $requete->fetchAll();
        $requete->closeCursor();
        $connexion = null;

        $_SESSION['modespaiement'] = $modespaiement;
    }

    return view('/commande');
});


$app->get('/commande/{selected}', function ($selected) use ($app) {
    session_start();

    $connexion = obtenirConnexion();
    $requete = $connexion->prepare(
    'SELECT * ' .
    'FROM produits ' .
    'WHERE idCategorie = :selected');
    $requete->execute(['selected' => $selected]);
    $produitsParCat = $requete->fetchAll();
    $requete->closeCursor();
    $connexion = null;

    $_SESSION['produitsParCat'] = $produitsParCat;
    
    return view('/commande');
});

/*
|--------------------------------------------------------------------------
*/

$app->get('/choisiRestaurant', function () use ($app) {
    session_start();

    return view('/choisiRestaurant');
});

$app->get('/choisiTypeCommande/{selected}', function ($selected) use ($app) {
    session_start();

    $_SESSION['nomRestoSel'] = $selected;

    return view('/choisiTypeCommande');
});

$app->get('/adresseLivraison', function () use ($app) {
    session_start();

    $_SESSION['typeCommande'] = 'Pour Livrer';

    return view('/adresseLivraison');
});

$app->get('/choisiModePaiement', function () use ($app) {
    session_start();

    if(!isset($_SESSION['typeCommande']))
    {
        $_SESSION['typeCommande'] = 'Pour Emporter';
    }

    return view('/choisiModePaiement');
});

$app->get('/choisiModePaiement/{selected}', function ($selected) use ($app) {
    session_start();

    $_SESSION['modePaiementSel'] = $selected;

    return view('/commande');
});

$app->post('/adresseLivraisonInfo', function () use ($app) {
    session_start();

    $_SESSION['inputAddress'] = $_POST['inputAddress'];
    $_SESSION['inputAddress2'] = $_POST['inputAddress2'];
    $_SESSION['postalCode'] = $_POST['postalCode'];
    $_SESSION['inputCity'] = $_POST['inputCity'];
    
    return view('/choisiModePaiement');
});
/*
|--------------------------------------------------------------------------
| Commande Routes Fin
|--------------------------------------------------------------------------

*/