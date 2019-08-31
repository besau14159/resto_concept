@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-2" style = "border:1px solid white">
				<h4 class="text-center">Menu</h4>
			</div>
			<div class="col-7" style = "border:1px solid white">
				<div class="input-group mb-3">
				  <select class="custom-select" id="inputGroupSelect01">
				    <option selected>Choisissez un restaurant...</option>
				    @foreach($_SESSION['restaurants'] as $unRestaurant)
				    <option value="{{ $unRestaurant['idResto'] }}">{{ $unRestaurant['nomResto'] }}</option>
				    @endforeach
				  </select>
				</div>
			</div>
			<div class="col-3" style = "border:1px solid white">
				<div class="input-group mb-3">
				  <select class="custom-select" id="inputGroupSelect02">
				    <option selected>Choisissez un type de commande...</option>
				    <option value="1">Pour Emporter</option>
				    <option value="2">Pour Livrer</option>
				  </select>
				</div>
			</div>

			<div class="col-2" style = "border:1px solid white">
				<div class="list-group">
					@foreach($_SESSION['categories'] as $unCategorie)
  				  	<a href="/commande/{{ $unCategorie['idCategorie'] }}" class="list-group-item list-group-item-action">{{ $unCategorie['nomCategorie'] }}</a>
  				  	@endforeach
				</div>
			</div>

			<div class="col-7" style = "border:1px solid white">
				@if (isset($_SESSION['produitsParCat']))
                    @foreach($_SESSION['produitsParCat'] as $unProduit)
                    	<div class="row">
		                    <div class="col" style = "border:1px solid white">
								<a href="#" >{{ $unProduit['nomProd'] }}</a>
								<p>Prix:{{ $unProduit['prixProd'] }}$</p>
							</div>
							<div class="col" style = "border:1px solid white">
								<p>{{ $unProduit['descProd'] }}</p>
							</div>
							<div class="col" style = "border:1px solid white">
								<img src="../{{ $unProduit['imgProd'] }} " width="100" height="100"s>
							</div>
						</div>	
  				  	@endforeach
				@endif
			</div>

			<div class="col-3" style = "border:1px solid white">

				<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Adresse de livraisson</div>
    			</div>

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Produits commande</div>
    			</div>

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Total</div>
    			</div>

    			<div class="row">
    				<div class="col-12 text-center" style = "border:1px solid white">
	      				<div class="input-group mb-3">
						  <select class="custom-select" id="inputGroupSelect02">
						    <option selected>Choisissez un type de paiement...</option>
						    @foreach($_SESSION['modespaiement'] as $unPaiement)
						    <option value="{{ $unPaiement['idMode'] }}">{{ $unPaiement['description'] }}</option>
						    @endforeach
						  </select>
						</div>
					</div>	
    			</div>

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">
      					<a href="#"  class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">CONFIRMER></a>
      				</div>
    			</div>

			</div>
		</div>
	</div> 
@endsection

