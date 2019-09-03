@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">

			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<h4 class="text-center">Choisissez un mode de paiement</h4>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<div class="list-group">
					@foreach($_SESSION['modespaiement'] as $unModePaiement)
  				  	<a href="/choisiModePaiement/{{ $unModePaiement['idMode'] }}" class="list-group-item list-group-item-action">{{ $unModePaiement['description'] }}</a>
  				  	@endforeach
				</div>
			</div>

		</div>
	</div> 
@endsection

