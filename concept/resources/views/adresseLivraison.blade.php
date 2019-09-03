@extends('layouts.app')

@section('contenu')
    <div class="container-fluid">
		<div class="row">

			<div class="col-md-12" >
				<h1 class="text-center">Commande en ligne</h1>
			</div>

			<div class="col-12" style = "border:1px solid white">
				<h4 class="text-center">Fournissez votre adresse de livraison</h4>
			</div>

			<form action="/adresseLivraisonInfo" method="post">
				  <div class="form-row">
					  <div class="form-group col-12">
					    <label for="inputAddress">*Adresse de livraison (1234 Main St)</label>
					    <input type="text" class="form-control" name="inputAddress" required>
					  </div>
				  </div>
                  <div class="form-row">
					  <div class="form-group  col-md-12">
					    <label for="inputAddress2">*Adresse de livraison 2 (Apartment, studio, or floor)</label>
					    <input type="text" class="form-control" name="inputAddress2">
					  </div>
                  </div>
                  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputCity">*Code postal (G1X 3Z2)</label>
				      <input type="text" class="form-control" name="postalCode" required>
				    </div>
				  </div>
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputCity">*Ville (Quebec)</label>
				      <input type="text" class="form-control" name="inputCity" required>
				    </div>
				  </div>
				  <button type="submit" name="submit" class="btn btn-primary">OK</button>
			</form>
		</div>
	</div> 
@endsection

