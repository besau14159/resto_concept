@extends('layouts.app')

@section('contenu')
    <h1 class="text-center"><strong>Ajouter Menu {{ $_SESSION['resto'] }}</strong></h1>
  
    <div>Succursale choisie :  
  @foreach($_SESSION['restaurants'] as $unRestaurant)
    @if($unRestaurant['idResto'] == $_SESSION['resto'])
      <strong>{{ $unRestaurant['nomResto'] }}</strong>
    @endif  
  @endforeach
      <a href="/restaurants/{{ $_SESSION['resto'] }}" class="btn btn-success">Autre succursale</a>
    </div>

    <div>
      <form method="POST" action="/rechercheItem">Recherche d'item (par nom)   
        <input type="text" id="recherche" name="recherche">
        <button type="submit" class="btn btn-success">Recherche</button>
      </form>
    </div>

  <div class="row">
    <div class="col-6 col-md-5">
      <h3>Items disponibles</h3>
      <table class="table table-bordered">
      <thead>
        <tr bgcolor="grey">
          <th>Nom d'item</th>
          <th>Prix</th>
        </tr>
      </thead>
      <tbody>       
  @foreach ($_SESSION['items'] as $item)
    @if($item['idProduit'] == $_SESSION['itemAAjouter'])
        <tr bgcolor="grey">
    @else
        <tr>
    @endif
          <td><a href="/selectionnerItemListe/{{ $item['idProduit'] }}" >{{ $item['nomProd'] }}</a> </td>
          <td>{{ $item['prixProd'] }}</td>
        </tr>
  @endforeach       
      </tbody>
    </table>
    </div>
    <div class="col-6 col-md-2 text-center">
      </br></br></br>
      <a href="/ajouterItem" class="btn btn-success col">Ajouter</a>
    </br>
    </br>
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
    @if (isset($_SESSION['itemsMenu']))

    @foreach ($_SESSION['itemsMenu'] as $item)
      @if($item['idProduit'] == $_SESSION['itemAEnlever'])
        <tr bgcolor="grey">
      @else
        <tr>
      @endif
          <td><a href="/selectionnerItemMenu/{{ $item['idProduit'] }}">{{ $item['nomProd'] }} </a> </td>
          <td>{{ $item['prixProd'] }}</td>
        </tr>
  @endforeach

  @endif   
      </tbody>
    </table>
    </div>
  </div>
  <div class="text-right">
    <a href="/retourner" class="btn btn-success">Retourner</button>
    <a href="/deconnecter" class="btn btn-success">Déconnecter</button>
  </div>
  
@endsection