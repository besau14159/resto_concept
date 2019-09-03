@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">

			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<h4 class="text-center">Choisissez un restaurant</h4>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<div class="list-group">
					@foreach($_SESSION['listeRestaurants'] as $unRestaurant)
  				  	<a href="/choisiRestaurant/{{ $unRestaurant['nomResto'] }}" class="list-group-item list-group-item-action">{{ $unRestaurant['nomResto'] }}</a>
  				  	@endforeach
				</div>
			</div>

		</div>
	</div> 
@endsection

