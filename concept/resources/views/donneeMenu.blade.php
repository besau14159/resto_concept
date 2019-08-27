@extends('layouts.app')

@section('contenu')
</br></br>
  <h1>Données du menu </h1>
@if (isset($_SESSION['message']))
  <div class="alert alert-danger" role="alert">
  <h4>{{ $_SESSION['message'] }}</h4>
  </div>
@endif	
  <form method="POST" action="/donneeMenu">
      <div>
        <label for="titreMenu">Entrer le titre </label>
        <input type="text" name="titreMenu" id="titreMenu" value="{{ $_SESSION['titreMenu'] }}">
      </div>
    

      <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="chkActif" name="chkActif" {{ $_SESSION['actif'] }}>
        <label class="custom-control-label" for="chkActif">Actif</label>
      </div>

      <div>
        <label for="commentaire">Commentaire</label> 
        <textarea name="commentaire" id="commentaire" rows="4"  cols="50">{{ $_SESSION['commentaire'] }}</textarea> 
      </div>
      
      
      </br></br>
      <button type="submit" class="btn btn-success">Sauvegarder</button>
  </form>
@endsection