<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agent</title>
</head>
<body>
    <form action="clinique.php" id="infopatient" method="post">
        <fieldset>
            <legend>Informations du patient</legend>
            <p>
                <label>Nom :</label>
                <input type="text" name="nom">
            </p>
            <p>
                <label>Prenom :</label>
                <input type="text" name="prenom">
            </p>
            <p>
                <label>Adresse :</label>
                <input type="text" name="adresse">
            </p>
            <p>
                <label>Numéro de téléphone :</label>
                <input type="text" name="numero"  maxlength="10">
            </p>
            <p>
                <label>Date de naissance :</label>
                <input type="text" name="naissance">
            </p>
            <p>
                <label>Département de naissance :</label>
                <input type="text" name="departement" onblur="pays()">
            </p>
            <div id="PAYS">

            </div>
            <p>
                <label>Solde :</label> <input type="text" name="solde">
            </p>
            <input type="submit" name="creerpatient" value="Créer">
        </fieldset>
    </form>
    
    <script>
       function pays () {
        var departement = document.forms["infopatient"].elements["departement"].value;
        var dep = "";
        if ( eval(departement) == 99){
            dep = dep + '<p><label for="pays"> Pays :</label> <input type="text" name="Pays" /> </p>';
        }
        document.getElementById('PAYS').innerHTML=dep;

       }
    </script>

    <form action="clinique.php" id="nss" method="post">
        <fieldset>
            <legend>Récupérer le NSS</legend>
            <p>
                <label>Nom :</label>
                <input type="text" name="name">
            </p>
            <p>
                <label>Date de naissance :</label>
                <input type="text" name="Date">
            </p>
            <input type="submit" name="recuperer" value="Recupérer">
        </fieldset>
    </form>

    <?php echo $numsecu;
     ?>

    <form action="clinique.php" id="info" method="post">
       <fieldset>
            <legend>Modifier informations du patient</legend>
            <p>
                <label>Entrer le NSS du patient :</label> <input type="text" name="information">
            </p>
            <input type="submit" name="montrer" value="afficher">
       </fieldset>
    </form>


    <form action="clinique.php" id="consulter" method="post">
        <fieldset>
            <legend>Consulter synthèse d'un patient</legend>
            <p>
                <label>Saisir le numéro de sécurité sociale :</label>
                <input type="text" name="num">
            </p>
            <input type="submit" name="saisir" value="synthèse patient">
        </fieldset>
    </form>

    <?php echo $contenu;
        echo $listerdv;         ?>

    
<form action="clinique.php" id="rdv" method="post">
        <fieldset>
            <legend>Gestion des rendez-vous</legend>
            <p>
                <label>Saisir NSS :</label><input type="text" name="numms">
            </p>
            <p>
                <label>Nom du médecin :</label>
                <input type="text" name="nommedecin">
            </p>
            <p>
                <label>Spécialité du médecin :</label>
                <input type="text" name="specialite">
            </p>

            <input type="submit" name="verification" value="vérifier">

            <p>
                <label>Date du rdv  (YYYY-MM-DD) :</label>
                <input type="text" name="daterdv">
            </p>
            <p>
                <label>Heure du rdv (HH:MM:SS):</label>
                <input type="text" name="heurerdv">
            </p>
            <?php
                echo $MOTIF;
            ?>
            <input type="submit" name="reserver" value="Réserver">
        </fieldset>
    </form>

    <?php echo $rdv; ?>

    <form action="clinique.php" id="depot" method="post">
        <fieldset>
            <legend>Gestion des dépôts</legend>
            <p>
                <label>Saisir le NSS :</label>
                <input type="text" name="num">
            </p>
            <p>
                <label>Saisir montant :</label>
                <input type="text" name="montant">
            </p>
            <input type="submit" name="ajouter" value="Ajouter">
        </fieldset>
    </form>

    <form action="clinique.php" id="payement" method="post">
        <fieldset>
        <legend>Gestion des payements</legend>
        <p>
                <label>Saisir le NSS :</label>
                <input type="text" name="nums">
            </p>
        <input type="submit" name="show" value="Voir">
        </fieldset>
    </form>

    <form action="clinique.php" id="listpayement" method="post">
            <fieldset>
                <legend>Rdv en attente de payement</legend>
                <p>
                    <label>Saisir le NSS du patient :</label>
                    <input type="text" name="num2">
                </p>
                <input type="submit" name="afficherpayement" value="Afficher">
            </fieldset>
        </form>

    <?php echo $rdvp; ?>

    <form action="clinique.php" methods="post">
        <fieldset>
            <legend>déconnexion</legend>
            <input type="submit" name="deconnexion" value="Déconnexion">
        </fieldset>
    </form>
</body>
</html>