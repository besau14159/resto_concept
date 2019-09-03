@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">

			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<h4 class="text-center">Choisissez un type de commande</h4>
			</div>

			<div class="col-6" style = "border:1px solid white">
				<a href="/choisiTypeCommande/{PourEmporter}" ><h4 class="text-center">Pour Emporter</h4></a>
			</div>

			<div class="col-6" style = "border:1px solid white">
				<a href="/adresseLivraison" ><h4 class="text-center">Pour Livrer</h4></a>
			</div>

		</div>
	</div> 
@endsection

