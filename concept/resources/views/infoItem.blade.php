@extends('layouts.app')

@section('contenu')
	<div class="container-fluid">
		<h1>{{ $item['nomProd'] }}</h1></br>
		<img src="../{{ $item['imgProd'] }} " width="1000" >
  		<h3>{{ $item['descProd'] }}</h3>
 		<h4>Prix : {{ $item['prixProd'] }} $</h4>
  		<a href="/ajouterMenu" class="btn btn-success">Retour</a>
	</div>
@endsection