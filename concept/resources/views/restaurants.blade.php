@extends('layouts.app')

@section('contenu')

  <h1 class="text-center"><strong>Succursale</strong></h1>
  
  <form method="POST" action="/recherche">Recherche(par nom, adresse)   
    <input type="text" id="recherche" name="recherche">
    <button type="submit" class="btn btn-outline-success">Recherche</button>
  </form>


  <h2>Liste des succursales</h2>
  <table class="table table-bordered">
    <thead>
      <tr bgcolor="grey">
        <th class="col-md text-center">id</th>
        <th class="col-md">Restaurant</th>
        <th class="col-md ">Adresse</th>
        <th class="col-md ">Téléphone</th>
        <th class="col-md ">Gérant</th>
        <th class="col-md text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($_SESSION['restaurants'] as $unRestaurant)

    @if($unRestaurant['idResto'] == $selected)
      <tr bgcolor="darkgrey">
    @else
      <tr>
    @endif
        <td class="text-center">{{ $unRestaurant['idResto'] }}</td>
        <td><strong>{{ $unRestaurant['nomResto'] }}</strong></td>
        <td>{{ $unRestaurant['idAdrs'] }}</td>
        <td>444-444-4444</td>
        <td>Nom, Prenom</td>
        <td class="text-center"><a href="/restaurants/{{ $unRestaurant['idResto'] }}" class="btn btn-success">Sélectionner</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <div>
    <button class="btn btn-success" type="button">Ajouter</button>
    <button class="btn btn-success" type="button">Modifier</button>
    <button class="btn btn-success" type="button">Désactiver</button>
    <a href="/ajouterMenu" class="btn btn-success">Sélectionner</a>
  </div>
  <br>
  <div class="text-right">
    <button class="btn btn-success" type="button">Retourner</button>
    <button class="btn btn-success" type="button">Déconnecter</button>
  </div>
    

@endsection