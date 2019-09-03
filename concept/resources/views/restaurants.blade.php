@extends('layouts.app')

@section('contenu')
  <div class="container-fluid">
    
      <h1 class="text-center">Succursale</h1>

      <form method="POST" action="/recherche">Recherche(par nom, adresse)   
        <input type="text" id="recherche" name="recherche">
        <button type="submit" class="btn btn-outline-success">Recherche</button>
      </form>


      <h2>Liste des succursales</h2>
    @if (isset($_SESSION['message']))
      <div class="alert alert-danger" role="alert">
      <h4>{{ $_SESSION['message'] }}</h4>
      </div>
    @endif  

      <table class="table table-dark  table-bordered table-hover" >
        <thead>
          <tr >
            <th class="text-center">id</th>
            <th >Restaurant</th>
            <th >Adresse</th>
            <th >Téléphone</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($_SESSION['restaurants'] as $unRestaurant)

        @if($unRestaurant['idResto'] == $_SESSION['selected'])
          <tr bgcolor="dimgrey">
        @else
          <tr>
        @endif
            <td class="text-center">{{ $unRestaurant['idResto'] }}</td>
            <td><strong>{{ $unRestaurant['nomResto'] }}</strong></td>
            <td>{{ $unRestaurant['adresse'] }}</td>
            <td>{{ $unRestaurant['telephone'] }}</td>
            <td class="text-center"><a href="/restaurants/{{ $unRestaurant['idResto'] }}" class="btn btn-success">Sélectionner</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div>
        <a href="/restaurant/ajouter" class="btn btn-success">Ajouter</a>
        <a href="/restaurant/modifier" class="btn btn-success">Modifier</a>
        <a href="/restaurant/desactiver" class="btn btn-success">Désactiver</a>
        <a href="/restaurant/selectionner" class="btn btn-success">Sélectionner</a>
      </div>
      <br>
      <div class="text-right">
        <a href="/ajouterMenu" class="btn btn-success">Ajouter menu</a>
        <a href="/" class="btn btn-success">Déconnecter</a>
      </div>
    </div>
  </div>

    

@endsection