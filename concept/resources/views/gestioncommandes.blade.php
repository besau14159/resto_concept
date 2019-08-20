@extends('layouts.app')

@section('contenu')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Commandes en attente</h1>
			</col>
		</div>
	</div>
    
    <table class="table table-dark table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th scope="col">Numéro</th>
        <th scope="col">Nom client</th>
		<th scope="col">Téléphone</th>
      </tr>
    </thead>
    <tbody>
    @foreach($commandes as $commande)
      <tr>
        <td>{{ $commande['idCommande'] }}</td>
        <td>{{ $commande['nom'] }}</td>
		<td>{{ $commande['telephone']}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection