<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Les restaurants Concept!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
 
    <!-- Le styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/">Concept!</a>
      <div class="text-right">
        @IF(!ISSET($_SESSION['utilisateur']))
        
        <a class="btn btn-outline-success" href="sinscrire" type="button">Inscription</a>
        <a class="btn btn-outline-success" href="connexion" type="button">Se connecter</a>
        @ELSE
        <div><h4>Bonjour, {{ $_SESSION['utilisateur']['nom'] }}</h4>
        <a class="btn btn-outline-success" href="/deconnecter" type="button">Se déconnecter</a>
        </div>
          @ENDIF
      </div>
    </nav>
    <div class="container-fluid">
       @yield('contenu')
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>
		
	</script>
  </body>
</html>