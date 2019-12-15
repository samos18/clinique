<!DOCTYPE html>
<html lang="fr">
 
    <head>
      <title>Se connecter</title>
      <meta charset="utf-8">
      <!-- <link rel="stylesheet"  href="vue/style/style.css" /> -->
	  	<link rel="stylesheet" href="style.css">

    </head>
	
	
	<body>
		<form id="gabaritconnexion" action="clinique.php" method="post">
			<fieldset>
				 <legend> Se connecter </legend>
				 <p><label>  Login  : </label><input type="text" name="user" /></p>
				 <p><label>  Mot de passe  : </label><input type="password" name="mdp" /></p>
				 <p> <input type="submit" value="connexion" name="connexion"  /> </p>
			</fieldset>
		</form>
	 <?php echo $contenu; ?>
	
	</body>
</html>
	
