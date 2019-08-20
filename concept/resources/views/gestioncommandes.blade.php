@extends('layouts.app')

@section('contenu')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Commandes en attente</h1>
			</col>
		</div>
	</div>
    
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="col-md-4 text-center">Numéro</th>
        <th class="col-md-8">Date</th>
      </tr>
    </thead>
    <tbody>
    @foreach($commandes as $commande)
      <tr>
        <td class="text-center">{{ $commande['idCommande'] }}</td>
        <td>
          <strong>{{ $commande['datecommande'] }}</strong>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection