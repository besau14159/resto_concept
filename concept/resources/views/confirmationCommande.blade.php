@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>


      <div class="col-8" style = "border:1px solid white">
        <h4 class="text-center">Confirmation de la commande</h4>
      </div>

			<div class="col-2 text-center" style = "border:1px solid white">Numero commande
          <h3 class="text-center">{{ $_SESSION['idCommandeDerniere'] }}</h3>          
			</div>

			<div class="col-7 text-center" style = "border:1px solid white">Restaurant 
				<div class="form-group">
				    <input type="restaurant" class="form-control" id="restaurant" aria-describedby="emailHelp" placeholder="{{ $_SESSION['nomRestoSel'] }}">
                </div>
			</div>

			<div class="col-3 text-center" style = "border:1px solid white">Type de commande
				 <div class="form-group">
				    <input type="typeCommande" class="form-control" id="typeCommande" aria-describedby="emailHelp" placeholder="{{ $_SESSION['typeCommande'] }}">
                 </div>
			</div>

			<div class="col-7" style = "border:1px solid white">

			</div>

			<div class="col-3" style = "border:1px solid white">
        @if ($_SESSION['typeCommande'] == 'Pour Livrer')
				<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Adresse de livraisson
                    <div class="form-group">
                    <input type="adr" class="form-control" id="adr1" aria-describedby="emailHelp" placeholder="{{ $_SESSION['noCvq'] }}">
                        </div>
                        <div class="form-group">
                    <input type="adr" class="form-control" id="adr2" aria-describedby="emailHelp" placeholder="{{ $_SESSION['Rue'] }}">
                        </div>
                        <div class="form-group">
                    <input type="adr" class="form-control" id="adr3" aria-describedby="emailHelp" placeholder="{{ $_SESSION['ville'] }}">
                        </div>
                        <div class="form-group">
                    <input type="adr" class="form-control" id="adr4" aria-describedby="emailHelp" placeholder="{{ $_SESSION['province'] }}">
                        </div>
                        <div class="form-group">
                    <input type="adr" class="form-control" id="adr5" aria-describedby="emailHelp" placeholder="{{ $_SESSION['codePostal'] }}">
                        </div>
                        <div class="form-group">
                    <input type="adr" class="form-control" id="adr6" aria-describedby="emailHelp" placeholder="{{ $_SESSION['telephone'] }}">
                        </div>
      				</div>
    			</div>
          @endif

    			<div class="row">
      				<div class="col-12 text-center" style = "border:1px solid white">Résumé de votre commande
      					<div class="row">
      						@php 
      							$stotal=0 
      						@endphp
      						@foreach ($_SESSION['itemsCommande'] as $item)
      							<div class="col-8" style = "border:1px solid white">{{ $item['nomProd'] }}
      					
      							</div>
      							<div class="col-4 text-right" style = "border:1px solid white">{{ $item['prixProd'] }} $
      					
      							</div>
      							@php 
      								$stotal=$stotal + $item['prixProd'];
      							@endphp
      						@endforeach
      						@php 
      								$tps = number_format($stotal * 0.05, 2, '.', '');
                      $tvq = number_format($stotal * 0.09975, 2, '.', '');
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
          @php
            unset($_SESSION['nomRestoSel']);
            unset($_SESSION['typeCommande']);
            unset($_SESSION['modePaiementSel']);
            unset($_SESSION['itemsCommande']);
            unset($_SESSION['listeRestaurants']);  
            unset($_SESSION['produitsParCat']); 
            unset($_SESSION['noCvq']);
            unset($_SESSION['Rue']);
            unset($_SESSION['ville']);
            unset($_SESSION['province']);
            unset($_SESSION['codePostal']);
            unset($_SESSION['telephone']);
            unset($_SESSION['idCommandeDerniere']);
          @endphp
              <div class="col-12 text-center" style = "border:1px solid white">
                <a href="/commande"  class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">NOUVELLE COMMANDE</a>
              </div>
        </div>

			</div>
		</div>
	</div> 
@endsection

