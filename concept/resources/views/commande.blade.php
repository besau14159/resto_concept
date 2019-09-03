@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-2 text-center" style = "border:1px solid white">Categories

			</div>

			<div class="col-7 text-center" style = "border:1px solid white">Restaurant choisi
				<div class="form-group">
				    <input type="restaurant" class="form-control" id="restaurant" aria-describedby="emailHelp" placeholder="{{ $_SESSION['nomRestoSel'] }}">
                </div>
			</div>

			<div class="col-3 text-center" style = "border:1px solid white">Type de commande
				 <div class="form-group">
				    <input type="typeCommande" class="form-control" id="typeCommande" aria-describedby="emailHelp" placeholder="{{ $_SESSION['typeCommande'] }}">
                 </div>
			</div>

			<div class="col-2 text text-center" style = "border:1px solid white">
				<div class="list-group">
					@if (isset($_SESSION['categories']))
						@foreach($_SESSION['categories'] as $unCategorie)
	  				  	<a href="/commande/{{ $unCategorie['idCategorie'] }}" class="list-group-item list-group-item-action">{{ $unCategorie['nomCategorie'] }}</a>
	  				  	@endforeach
	  				@endif
				</div>
			</div>

			<div class="col-7" style = "border:1px solid white">
				@if (isset($_SESSION['produitsParCat']))
                    @foreach($_SESSION['produitsParCat'] as $unProduit)
                    	<div class="row">
		                    <div class="col" style = "border:1px solid white">
								<a href="/ajouterItemCommande/{{ $unProduit['idProduit'] }}" >{{ $unProduit['nomProd'] }}</a>
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
      				<div class="col-12 text-center" style = "border:1px solid white">Adresse de livraisson
      					@if (isset($_SESSION['inputCity']))
      						@if ($_SESSION['typeCommande'] == 'Pour Livrer')
	      						<div class="form-group">
						    		<input type="modePaiement" class="form-control" id="modePaiement" aria-describedby="emailHelp" placeholder="{{ $_SESSION['inputAddress'] }}">
		                 		</div>
		                 		<div class="form-group">
						    		<input type="modePaiement" class="form-control" id="modePaiement" aria-describedby="emailHelp" placeholder="{{ $_SESSION['inputAddress2'] }}">
		                 		</div>
		                 		<div class="form-group">
						    		<input type="modePaiement" class="form-control" id="modePaiement" aria-describedby="emailHelp" placeholder="{{ $_SESSION['postalCode'] }}">
		                 		</div>
		                 		<div class="form-group">
						    		<input type="modePaiement" class="form-control" id="modePaiement" aria-describedby="emailHelp" placeholder="{{ $_SESSION['inputCity'] }}">
		                 		</div>
		                 	@endif	
	                 	@endif	
      				</div>
    			</div>

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Produits commande
      					<div class="row">
      						@php 
      							$stotal=0 
      						@endphp
      						@foreach ($_SESSION['itemsCommande'] as $item)
      							<div class="col-8" style = "border:1px solid white">{{ $item['nomProd'] }}
      					
      							</div>
      							<div class="col-4 text-right" style = "border:1px solid white">{{ $item['prixProd'] }}
      					
      							</div>
      							@php 
      								$stotal=$stotal + $item['prixProd'];
      							@endphp
      						@endforeach
      						@php 
      								$tps = $stotal * 0.05;
      								$tvq = $stotal * 0.09975;
      								$total = $stotal + $tps + $tvq;
      						@endphp
    					</div>
      				</div>
    			</div>

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Total
      					<div class="row">
      						<div class="col-4" style = "border:1px solid white">SOUS-TOTAL
      					
      						</div>
      						<div class="col-8 text-right" style = "border:1px solid white">{{ $stotal }}.00 $
      					
      						</div>
    					</div>

    					<div class="row">
      						<div class="col-4" style = "border:1px solid white">TPS
      					
      						</div>
      						<div class="col-8 text-right" style = "border:1px solid white">{{ $tps }} $
      					
      						</div>
    					</div>

    					<div class="row">
      						<div class="col-4" style = "border:1px solid white">TVQ
      					
      						</div>
      						<div class="col-8 text-right" style = "border:1px solid white">{{ $tvq }} $
      					
      						</div>
    					</div>

    					<div class="row">
      						<div class="col-4" style = "border:1px solid white">TOTAL
      					
      						</div>
      						<div class="col-8 text-right" style = "border:1px solid white">{{ $total }} $
      					
      						</div>
    					</div>

      				</div>
    			</div>

    			<div class="row">
	    			<div class="col-12 text-center" style = "border:1px solid white">Mode de paiement
						 <div class="form-group">
						    <input type="modePaiement" class="form-control" id="modePaiement" aria-describedby="emailHelp" placeholder="{{ $_SESSION['modePaiementSel'] }}">
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

