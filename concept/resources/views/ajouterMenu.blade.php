@extends('layouts.app')

@section('contenu')

      <h1 class="text-center"><strong>Ajouter Menu</strong></h1>
      <table>
        <tr>
          <td>Succursale choisie :</td>
          <td>
  @foreach($_SESSION['restaurants'] as $unRestaurant)
    @if($unRestaurant['idResto'] == $_SESSION['resto'])
              <strong>{{ $unRestaurant['nomResto'] }}</strong>
    @endif  
  @endforeach
          </td>
          <td>
            <a href="/restaurants/{{ $_SESSION['resto'] }}" class="btn btn-outline-success">Autre succursale</a>
          </td>
        </tr>
        <tr>
          <td>Titre choisie :</td>
          <td><strong>{{ $_SESSION['titreMenu'] }}</strong></td>
          <td><a class="btn btn-outline-success" href="/donneeMenu">Changer données de base</a></td>
        </tr>
      </table>
    </br>

      <div>
        <form method="POST" action="/rechercheItem">Recherche d'item (par nom)   
          <input type="text" id="recherche" name="recherche">
          <button type="submit" class="btn btn-outline-success">Recherche</button>
        </form>
      </div>
@if (isset($_SESSION['message']))
      <div class="alert alert-danger" role="alert">
      <h4>{{ $_SESSION['message'] }}</h4>
      </div>
@endif  
      <div class="row" >
        <div class="col-6 col-md-5">
          <h3>Items disponibles</h3>
          <table class="table table-dark  table-bordered table-hover"  >
            <thead>
              <tr >
                <th>Nom d'item</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tbody>       
  @foreach ($_SESSION['items'] as $item)
    @if($item['idProduit'] == $_SESSION['itemAAjouter'])
              <tr bgcolor="dimgrey">
    @else
              <tr>
    @endif
                <td>
                  <a href="/selectionnerItemListe/{{ $item['idProduit'] }}" class="btn btn-success rounded-circle" >V</a> 
                  {{ $item['nomProd'] }}
                  <a href="/infoItem/{{ $item['idProduit'] }}" class="btn btn-info rounded-circle float-right" >i</a>
                </td>
                <td class="text-center">{{ $item['prixProd'] }},00$</td>
              </tr>
  @endforeach       
            </tbody>
          </table>
        </div>

        <div class="col-6 col-md-2 text-center"></br></br></br>
          <a href="/ajouterItem" class="btn btn-outline-success col">Ajouter</a></br></br>
          <a href="/enleverItem" class="btn btn-outline-success col">Enlever</a>
        </div>

        <div class="col-6 col-md-5">
          <h3>Items menu</h3>
          <table class="table table-dark  table-bordered table-hover">
            <thead>
              <tr>
                <th>Nom d'item</th>
                <th>Prix</th>
              </tr>
            </thead>
            <tbody>
  @foreach ($_SESSION['itemsMenu'] as $item)
    @if($item['idProduit'] == $_SESSION['itemAEnlever'])
              <tr bgcolor="dimgrey">
    @else
              <tr>
    @endif
                <td>
                  <a href="/selectionnerItemMenu/{{ $item['idProduit'] }}" class="btn btn-success rounded-circle" >V</a>
                  {{ $item['nomProd'] }}
                  <a href="/infoItem/{{ $item['idProduit'] }}" class="btn btn-info rounded-circle float-right" >i</a>
                </td>
                <td class="text-center">{{ $item['prixProd'] }},00$</td>
              </tr>
  @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div>
        <a href="/item/ajouter" class="btn btn-success">Ajouter</a>
        <a href="/item/modifier" class="btn btn-success">Modifier</a>
        <a href="/item/desactiver" class="btn btn-success">Désactiver</a>
        <a href="/sauvegarderMenu" class="btn btn-success float-right">Sauvegarder</a>
      </div></br>

      <div class="text-right">
        <a href="/retourner" class="btn btn-success">Retourner</a>
        <a href="/deconnecter" class="btn btn-success">Déconnecter</a>
      </div></br>

@endsection