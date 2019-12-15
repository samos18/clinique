<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Médecin</title>
</head>
<body>
    <form id="gabaritmedecin" action="clinique.php" method="post">
        <fieldset>
            <legend> Créneaux pour : </legend>
            <label> <p> votre Nom : </label>
                <input type="text" name="nommed" value="" />
            </p>
            <label> <p> votre spécialite : </label>
                <input type="text" name="spemed" value=""/>
            </p>
            <p><input type="submit" name="getID" value="getID" /> </p>

            <label> <p> Votre ID : </label>
                <input type="text" name="id" value=""/>
            </p>

            <label> <p> Nombre de créneaux : </label>
                <input type="text" name="nbcreneaux" value="" onBlur="creneaux(this);"/>
            </p>
            <div id='nvxcreneaux'>

            </div>
            <p> <input type="submit" value="Envoyer" name="valider_creneaux"  /> </p>
        </fieldset>
    </form>
    <?php
                echo $id;
            ?>
    <script>
    function creneaux(nb){
        var nbcreneaux = nb.value;
        var chaine="";
        for(var i=1;i<=nbcreneaux;i++){
            chaine +='<p> <label> date à bloquer n°'+i+' (YYYY-MM-DD): </label> <input type="text" name="datecreaneaux" value="" > </p>'+
            '<p><label>horraire  n°'+i+'(HH:MM:SS): </label> <input type="text" name="horraire" value=""></p>'
            +'<p><label>raison  n°'+i+' de: </label> <input type="text" name="raison" value=""></p>';
        }
        document.getElementById('nvxcreneaux').innerHTML=chaine;
    }
    </script>

<form action="clinique.php" methods="post">
        <fieldset>
            <legend>déconnexion</legend>
            <input type="submit" name="deconnexion" value="Déconnexion">
        </fieldset>
    </form>




</body>
</html>