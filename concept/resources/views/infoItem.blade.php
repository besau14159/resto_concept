@extends('layouts.app')

@section('contenu')
</br></br>
  <h1>{{ $item['nomProd'] }}</h1></br>
	<img src="../{{ $item['imgProd'] }} " width="1000" >
  <p>{{ $item['descProd'] }}</p>
  <h4>Prix : {{ $item['prixProd'] }} $</h4>
  <a href="/ajouterMenu" class="btn btn-success">Retour</a>
@endsection