@extends('layouts.app')

@section('contenu')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Commandes en attente</h1>
			</div>
		</div>
	</div>
    
    <table class="table table-dark table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Numéro</th>
        <th scope="col">Nom client</th>
		<th scope="col">Téléphone</th>
		<th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($commandes as $commande)
      <tr>
        <td>{{ $commande['idCommande'] }}</td>
        <td>{{ $commande['nom'] }}</td>
		<td>{{ $commande['telephone']}}</td>
		<td>
			<a href="/gestioncommandes/{{ $commande['idCommande']}}" class="btn btn-success">Sélectionner</a>
		</td>
      </tr>
    @endforeach
    </tbody>
	</table>
  
	@if(ISSET($details))
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Détails de la commande {{$id}}</h1>
			</div>
		</div>
	</div>
	<table class="table table-dark table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Numéro de produit</th>
        <th scope="col">Quantité</th>
      </tr>
    </thead>
    <tbody>
    @foreach($details as $commande)
      <tr>
        <td>{{ $commande['noProduit'] }}</td>
        <td>{{ $commande['qte'] }}</td>
      </tr>
    @endforeach
    </tbody>
	</table>
	@endif
  
	@if(ISSET($historique))
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Historique client</h1>
			</div>
		</div>
	</div>
	<table class="table table-dark table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Date commande</th>
        <th scope="col">Commentaire</th>
      </tr>
    </thead>
    <tbody>
    @foreach($historique as $commande)
      <tr>
        <td>{{ $commande['datecommande'] }}</td>
        <td>{{ $commande['commentaires'] }}</td>
      </tr>
    @endforeach
    </tbody>
	</table>
	@endif
@endsection