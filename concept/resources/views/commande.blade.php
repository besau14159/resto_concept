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
				    <option selected>Choisissez une succursale...</option>
				    <option value="1">One</option>
				    <option value="2">Two</option>
				    <option value="3">Three</option>
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
  				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				  <a href="#" class="list-group-item list-group-item-action">A simple</a>
				</div>
			</div>
			<div class="col-7" style = "border:1px solid white">
				
			</div>
			<div class="col-3" style = "border:1px solid white">
				
			</div>
		</div>
	</div> 
@endsection

