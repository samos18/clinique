<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Directeur </title>
      <meta charset="utf-8">
	  
	  
	</head>
  <body>
	<form action="clinique.php" method="post" id="pageDirecteur">
	<fieldset>
	   <legend>Création de compte</legend>
		<p><label>Votre pseudo</label>
		<input type="text" name="pseudo"/></p>
		
		<p><label>Votre mot de passe:<label>
		<input type="password" name="pass" /></p>

		<p><label>Catégorie:<label>
		<input type="text" name="cat" onblur="medecin()"/></p>

		<div id="Medecin"></div>
		
		<p><input type="submit" value="Créer" name="Creercompte" /></p>
		<p><input type="submit" value="Supprimer le médecin" name="supprimermedecin" /></p>

		
	</fieldset>
	</form>	

	<script>
	 function medecin () {
        var categorie = document.forms["pageDirecteur"].elements["cat"].value;
        var contenu = "";
        if ( categorie == "médecin" ){
            contenu = contenu+'<p><label>Nom: </label><input type="text" name="nommedecin" /></p><p><label>Prenom: </label><input type="text" name="prenommedecin" /></p><p><label>Specialite: </label><input type="text" name="specialitemedecin" /></p>';
        }
        document.getElementById('Medecin').innerHTML=contenu;

       }
	</script>
	
	
	<form action="clinique.php" method="post" id="pagedirecteur">
	<fieldset>
	  <legend> Motif</legend>
		<p><label> motif rdv : </label>
		<input type="text" name="motif" /></p>
		
		<p><label> prix : </label>
		<input type="text" name="prix" /></p>
		
		<p><label> piece a fournir</label>
		<input type="text" name="pieceafournir" /></p>
		
		<p><label> consigne</label>
		<input type="text" name="consigne" /></p>
		
		<p><input type="submit" value="Créer" name="creermotif" /></p>
		<p><input type="submit" value="modifier" name="modifier" /></p>
	</fieldset>	
	</form>
	
	<form action="clinique.php" method="post" id="pagedirecteur">
   <fieldset>
     <legend> Supprimer un motif </legend>
     <p><label>  motif  : </label>
	 <input type="text" name="nommotif" /></p>
     <p> <input type="submit" value="Supprimer le motif" name="supprimermotif"  /> </p>
   </fieldset>
   </form>

   <form action="clinique.php" methods="post">
        <fieldset>
            <legend>déconnexion</legend>
            <input type="submit" name="deconnexion" value="Déconnexion">
        </fieldset>
    </form>

  </body>
</html>