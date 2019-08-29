@extends('layouts.app')

@section('contenu')
  <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Veuillez vous authentifier</h1>
        <form action="/connexion" method="POST">
          <div class="row justify-content-center">
            <label>Adresse courriel</label>
            <input type="text" id="courriel" name="courriel">
            <label>Mot de passe</label>
            <input type="text" id="motdepasse" name="motdepasse">
            <button type="submit" class="btn btn-success">Valider</button>
          </div>
        </form>
			</div>
		</div>
	</div>
    
@endsection