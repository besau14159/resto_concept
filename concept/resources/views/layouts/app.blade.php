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
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
			<div class="row justify-content-between">
				<div class="col-4">
					<div>
						<a href="/"><h1>Les restaurants Concept!</h1></a>
					</div>
				</div>
				<div class="col-4">
					<div>
						<h2>Bonjour</h2>
					</div>
				</div>
			</div>
        </div>
      </div>
    </nav>
    <div class="container">
       @yield('contenu')
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script>
	</script>
  </body>
</html>