@extends('layouts.app')

@section('contenu')
  <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col">
				<h1 class="text-center">Inscription</h1>
        <form action="/validerinscription" method="POST">
          <div class="row justify-content-center">
            <div class="col text-center">
              <h4 class="msgerreur">{{ $_SESSION['message'] }}<br></h4>
              <table class="table">
                <tbody>
                  <tr>
                    <td class="text-right"><label>Adresse courriel</label></td>
                    <td class="text-left"><input type="text" id="courriel" name="courriel" maxlength="100"></td>
                    <td class="text-right"><label>Nom d'utilisateur</label></td>
                    <td class="text-left"><input type="text" id="nomutilisateur" name="nomutilisateur" maxlength="20"></td>
                    <td class="text-right"><label>Prénom</label></td>
                    <td class="text-left"><input type="text" id="prenom" name="prenom" maxlength="50"></td>
                    <td class="text-right"><label>Nom</label></td>
                    <td class="text-left"><input type="text" id="nom" name="nom" maxlength="50"></td>
                  </tr>
                  <tr>
                    <td class="text-right"><label>Mot de passe</label></td>
                    <td class="text-left"><input type="text" id="motdepasse" name="motdepasse" maxlength="40"></td>
                    <td class="text-right"><label>Mot de passe vérification</label></td>
                    <td class="text-left"><input type="text" id="motdepasseverif" name="motdepasseverif" maxlength="40"></td>
                    <td class="text-right"><label>Numéro civique</label></td>
                    <td class="text-left"><input type="text" id="nocivique" name="nocivique" maxlength="10"></td>
                    <td class="text-right"><label>Rue</label></td>
                    <td class="text-left"><input type="text" id="rue" name="rue" maxlength="50"></td>
                  </tr>
                  <tr>
                    <td class="text-right"><label>Ville</label></td>
                    <td class="text-left"><input type="text" id="ville" name="ville" maxlength="50"></td>
                    <td class="text-right"><label>Province</label></td>
                    <td class="text-left"><input type="text" id="province" name="province" maxlength="2"></td>
                    <td class="text-right"><label>Code postal</label></td>
                    <td class="text-left"><input type="text" id="codepostal" name="codepostal" maxlength="7"></td>
                    <td class="text-right"><label>Téléphone</label></td>
                    <td class="text-left"><input type="text" id="telephone" name="telephone" maxlength="15"></td>
                  </tr>
                </tbody>
              </table>
              <button type="submit" class="btn btn-success">Valider</button>
            </div>
          </div>
        </form>
			</div>
		</div>
	</div>
  
@endsection