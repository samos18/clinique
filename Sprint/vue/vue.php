<?php

function afficherErreur($erreur,$gabarit){
	$contenu='<form id="clinique" action="" methods="post">';
	$var="<fieldset> 
	<legend> Erreurs detectees </legend> 
	<p>'.$erreur.'</p>";
	$contenu=$contenu.$var.'<p> <a href="clinique.php"/> Revenir en arrière </a></p>';
	$contenu.='</fieldset> </form>';
	//la variable $contenu sera affichée depuis le gabaris du site 
	require_once($gabarit);
}

function afficherAcceuil(){
    $contenu="";
    require_once('gabaritConnect.php');
}

function afficherAgent(){
    $contenu="";
    require_once('gabaritAgent.php');
}

function afficherMedecin(){
    $contenu="";
    require_once('gabaritMedecin.php');

}

function afficherMotif($motif){
    $preambule='<p>Motif : <select name="motif">';
    $MOTIF="";
    foreach($motif as $ligne){
        $MOTIF=$MOTIF.'<option value="'.$ligne->MOTIF.'">'.$ligne->MOTIF.'</option>';
    }
    $fin='</select></p>';
    $MOTIF=$preambule.$MOTIF.$fin;

    require_once('gabaritAgent.php');
}

function afficherDirecteur(){
    $contenu="";
    require_once('gabaritDirecteur.php');
}

function afficherIDMedecin($idmed){
    $id='<form action="" id="recupnss" method="post"> <fieldset> <legend>information du médecin :</legend> 
    <p><label> ID :</label> <input type="text" name="idmedecin" value="'.$idmed->idmedecin.'"/></p></fieldset></form>';

    require_once('gabaritMedecin.php');
}

function afficherSynthese($synthese){
	$preambule = '<form id="formulaire" action="" methods="post" > <fieldset> <legend> Informations sur le patient </legend>';
	$contenu="";
	foreach ($synthese as $ligne){
		$nss = $ligne->NSS;
		$nom= $ligne->NOM;
        $prenom = $ligne->PRENOM;
        $adresse= $ligne->ADRESSE;
        $num= $ligne->NUM_TEL;
        $naissance= $ligne->DATE_NAISSANCE;
        $departement=$ligne->DEP_NAISSANCE;
        $pays=$ligne->PAYS;
        $solde=$ligne->SOLDE;
		
        $contenu= $contenu.'<p><label>NSS:</label> <input type="text" value="'.$nss.'" name="nss" /> </p>'
        .'<p><label>nom : </label> <input type="text" value="'.$nom.'" name="Nom"/></p>'
        .'<p><label>prenom : </label> <input type="text" value="'.$prenom.'" name="Prenom"/></p>'
        .'<p><label>adresse : </label> <input type="text" value="'.$adresse.'" name="Adresse"/></p>'
        .'<p><label>num : </label> <input type="text" value="'.$num.'" name="Num"/></p>'
        .'<p><label>naissance : </label> <input type="text" value="'.$naissance.'" name="Naissance"/></p>'
        .'<p><label>departement : </label> <input type="text" value="'.$departement.'" name="Dep"/></p>'
        .'<p><label>pays : </label> <input type="text" value="'.$pays.'" name="Pays"/></p>'
        .'<p><label>solde : </label> <input type="text" value="'.$solde.'"/></p>';
	}

    $fin="</fieldset> </form>";
    $button='<input type="submit" name="modifier" value="modifier"';
	
	$contenu=$preambule.$contenu.$button.$fin;
	//la variable $contenu sera affichée depuis le gabaris du site 
	require_once('gabaritAgent.php');
}

function afficherListeRdv($rdvnonpayer){
    $preambule = '<form id="rdv" action="" methods="post" > <fieldset> <legend> Liste rdv : </legend>';
    $listerdv="";
    foreach($rdvnonpayer as $ligne){
        $nom=$ligne->NOM;
        $datecreneau=$ligne->DATECRENEAU;
        $prix=$ligne->PRIX;
        $listerdv=$listerdv.'<p> rdv le'.$datecreneau.'avec'.$nom.' comme prix :'.$prix.'</p>';
    }
    $fin="</fieldset> </form>";
    $listerdv=$preambule.$listerdv.$fin;
    require_once('gabaritAgent.php');
}

function afficherNSS ($numeros) {
    $debut='<form action="" id="recupnss" method="post"> <fieldset> <legend>Récupération du NSS :</legend>';
    $numsecu="";
    foreach($numeros as $ligne){
        $numsecu=$numsecu.'<p><label> Son numéro de sécuriré sociale est :</label> <input type="text" name="NSSclient" value="'.$ligne->NSS.'"/></p>';
    }
    $fin='</fieldset></form>';
    $numsecu=$debut.$numsecu.$fin;
    
    require_once('gabaritAgent.php');
}

function afficherRdvNonPayer($rdvnonpayer){
    $preambule = '<form id="rdvpaspaye" action="" methods="post" > <fieldset> <legend>Rdv non payé :</legend>';
    $rdvp="";
    $res=1;
    foreach($rdvnonpayer as $ligne){
        $nom=$ligne->NOM;
        $datecreneau=$ligne->DATECRENEAU;
        $prix=$ligne->PRIX;
        $rdvp=$rdvp.'<p> <input type="checkbox" name="rdv'.$res.'"/> le '.$datecreneau.' avec '.$nom.', montant : '.$prix.' </p>';
        $res=$res+1;
    }
    $fin="</fieldset></form>";
    $rdvp=$preambule.$rdvp.$fin;

    require_once('gabaritAgent.php');
}
