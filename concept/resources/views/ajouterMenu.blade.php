@extends('layouts.app')

@section('contenu')
      <h1 class="text-center"><strong>Ajouter Menu</strong></h1>

      <div>Succursale choisie :  
  @foreach($_SESSION['restaurants'] as $unRestaurant)
    @if($unRestaurant['idResto'] == $_SESSION['resto'])
        <strong>{{ $unRestaurant['nomResto'] }}</strong>
    @endif  
  @endforeach
        <a href="/restaurants/{{ $_SESSION['resto'] }}" class="btn btn-success">Autre succursale</a>
      </div></br>
  @if (!isset($_SESSION['titreMenu']))  
      <div>
        <form method="POST" action="/titreMenu">Entrer le titre de menu   
          <input type="text" id="titreMenu" name="titreMenu">
          <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
      </div></br>
  @else
      <div>
        Titre choisie : <strong>{{ $_SESSION['titreMenu'] }}</strong>
        <a class="btn btn-success" href="/ChangerTitre">Autre titre</a>
      </div></br>


      <div>
        <form method="POST" action="/rechercheItem">Recherche d'item (par nom)   
          <input type="text" id="recherche" name="recherche">
          <button type="submit" class="btn btn-success">Recherche</button>
        </form>
      </div>

      <div class="row" >
        <div class="col-6 col-md-5">
          <h3>Items disponibles</h3>
          <table class="table table-bordered " >
            <thead>
              <tr bgcolor="grey">
                <th>Nom d'item</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tbody>       
  @foreach ($_SESSION['items'] as $item)
    @if($item['idProduit'] == $_SESSION['itemAAjouter'])
              <tr bgcolor="darkgrey">
    @else
              <tr>
    @endif
                <td>
                  <a href="/selectionnerItemListe/{{ $item['idProduit'] }}" >{{ $item['nomProd'] }}</a> 
                  <a href="/infoItem/{{ $item['idProduit'] }}" class="btn btn-info rounded-circle float-right" >i</a>
                </td>
                <td class="text-center">{{ $item['prixProd'] }}</td>
              </tr>
  @endforeach       
            </tbody>
          </table>
        </div>

        <div class="col-6 col-md-2 text-center"></br></br></br>
          <a href="/ajouterItem" class="btn btn-success col">Ajouter</a></br></br>
          <a href="/enleverItem" class="btn btn-success col">Enlever</a>
        </div>

        <div class="col-6 col-md-5">
          <h3>Items menu</h3>
          <table class="table table-bordered">
            <thead>
              <tr bgcolor="grey">
                <th>Nom d'item</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tbody>
  @foreach ($_SESSION['itemsMenu'] as $item)
    @if($item['idProduit'] == $_SESSION['itemAEnlever'])
              <tr bgcolor="darkgrey">
    @else
              <tr>
    @endif
                <td><a href="/selectionnerItemMenu/{{ $item['idProduit'] }}">{{ $item['nomProd'] }} </a> </td>
                <td class="text-center">{{ $item['prixProd'] }}</td>
              </tr>
  @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div>
        <a href="/" class="btn btn-success">Ajouter</a>
        <a href="/" class="btn btn-success">Modifier</a>
        <a href="/" class="btn btn-success">Désactiver</a>
        <a href="/" class="btn btn-success float-right">Sauvegarder</a>
      </div></br>
  @endif
      <div class="text-right">
        <a href="/retourner" class="btn btn-success">Retourner</a>
        <a href="/deconnecter" class="btn btn-success">Déconnecter</a>
      </div></br>

@endsection