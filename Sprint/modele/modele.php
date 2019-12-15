<?php

require_once('connect.php');

function getConnect(){
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD) ;
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->query('SET NAMES UTF8');
	return $connexion;
}

function ajouterPatient($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$solde){
    $connexion=getConnect();
    $requete = "insert into patient Values(0,'$nom','$prenom','$adresse','$numtel','$datenaissance','$depnaissance', 'France', '$solde')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function ajouterPatientEtranger($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$pays,$solde){
    $connexion=getConnect();
    $requete = "insert into patient values (0,'$nom','$prenom','$adresse','$numtel','$datenaissance','$depnaissance', '$pays', '$solde')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}


function getSynthese($numsss){
    $connexion=getConnect();
    $requete="select * from patient where NSS='$numsss'";
    $resultat=$connexion->query($requete); 
	$resultat->setFetchMode(PDO::FETCH_OBJ); 
	$synthese=$resultat->fetchall();
	$resultat->closeCursor();
	return $synthese;
}

function getlisterdv($numss){
    $connexion=getConnect();
    $requete="select nom, datecreneau, prix from rdv natural join medecin natural join creneau natural join intervention where NSS='$numss' and statut='effectué' ";
    $resultat=$connexion->query($requete); 
	$resultat->setFetchMode(PDO::FETCH_OBJ); 
	$listerdv=$resultat->fetchall();
    $resultat->closeCursor();
    return $listerdv;

}
function getSolde($numss){
    $connexion=getConnect();
    $requete="select solde from patient where NSS='$numsss'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $solde=$resultat->fetchall();
    $resultat->closeCursor();
    return $solde;

}

function checkCategorie($login, $mdp){
    $connexion=getConnect();
    $requete="select idCategorie from employe where login='$login' and mdp='$mdp'";
    $resultat=$connexion->query($requete);
    $check=$resultat->fetchall();
    $resultat->closeCursor();
    return $check;
}

function getNSS ($nom, $date){
    $connexion=getConnect();
    $requete="select NSS from patient where nom='$nom' and date_naissance='$date'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ); 
    $numeros=$resultat->fetchall();
    $resultat->closeCursor();
    return $numeros;
}

function depot ($nss, $montant){
    $connexion=getConnect();
    $requete="update patient set SOLDE = SOLDE + $montant where NSS='$nss'";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function payer($nss, $montant){
    $connexion=getConnect();
    $requete="update patient set SOLDE = SOLDE - $montant where NSS='$nss'";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function checkSpecialite ($nom) {
    $connexion=getConnect();
    $requete="select specialite from medecin where nom='$nom'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $spe=$resultat->fetchall();
    $resultat->closeCursor();
    return $spe; 
}

function getStatutRdvNonPayer ($nss){
    $connexion=getConnect();
    $requete="select statut from rdv where NSS='$nss' and statut='nonok'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $statutRdv=$resultat->fetchall();
    $resultat->closeCursor();
    return $statutRdv; 
}

function getCreneau ($id){
    $connexion=getConnect();
    $requete="select datecreneau, heurecreneau from creneau where idcreneau='$id'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $creneau=$resultat->fetchall();
    $resultat->closeCursor();
    return $creneau; 
}
function getdateheure ($date, $heure){
    $connexion=getConnect();
    $requete="select idcreneau from creneau where datecreneau='$date' and heurecreneau='$heure'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $dateheure=$resultat->fetchall();
    $resultat->closeCursor();
    return $dateheure; 
}

function getIdIntervention($motif){
    $connexion=getConnect();
    $requete="select idintervention from intervention where motif='$motif'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $idinter=$resultat->fetchall();
    $resultat->closeCursor();
    return $idinter; 
}

function checkEmploye($login, $mdp){
    $connexion=getConnect();
    $requete="select login from employe where login='$login' and mdp='$mdp' ";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $employe=$resultat->fetchall();
    $resultat->closeCursor();
    return $employe; 
}

function bloquerCreneau($id, $libelle, $date, $heure){
    $connexion=getConnect();
    $requete="insert into creneau values(0, '$id', '$libelle', '$date', '$heure')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function RdvNonPayer($nss, $statut){
    $connexion=getConnect();
    $requete="select nom, datecreneau, prix from rdv natural join medecin natural join creneau natural join intervention where NSS='$nss' and statut='$statut'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $rdvnonpayer=$resultat->fetchall();
    $resultat->closeCursor();
    return $rdvnonpayer; 
}

function ajouterCompte ($login, $idcate, $mdp){
    $connexion=getConnect();
    $requete="insert into employe values('$login', '$idcate', '$mdp')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function ajouterMedecin ($idcate, $nom, $prenom, $specialite){
    $connexion=getConnect();
    $requete="insert into medecin values(0, '$idcate', '$nom', '$prenom', '$specialite')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}


function ajouterIntervention($motif, $piece, $consigne, $prix){
    $connexion=getConnect();
    $requete="insert into intervention values(0, '1', '$motif', '$piece', '$consigne', '$prix')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function supprimerMotif($motif){
    $connexion=getConnect();
    $requete="delete from intervention where motif='$motif'";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function supprimerMedecin($nom, $prenom, $specialite){
    $connexion=getConnect();
    $requete="delete from medecin where nom='$nom' and prenom='$prenom' and specialite='$specialite'";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function supprimerEmploye($login, $mdp){
    $connexion=getConnect();
    $requete="delete from employe where login='$login' and mdp='$mdp' ";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function getIdMedecin($nom, $spe){
    $connexion=getConnect();
    $requete="select idmedecin from medecin where nom='$nom' and specialite='$spe'";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $idmed=$resultat->fetch();
    $resultat->closeCursor();
    return $idmed; 
}

function getMotif(){
    $connexion=getConnect();
    $requete="select MOTIF from intervention";
    $resultat=$connexion->query($requete);
    $resultat->setFetchMode(PDO::FETCH_OBJ);
    $motif=$resultat->fetchall();
    $resultat->closeCursor();
    return $motif;   
}

function ajoutRdvPatient($idmed, $nss, $idcren, $idInter){
    $connexion=getConnect();
    $requete="insert into rdv values(0, '$idmed', '$nss', '$idcren', '$idInter', 'non' )";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}

function modifierPatient($nom, $prenom, $adresse, $numtel, $datenaissance, $dep, $pays){
    $connexion=getConnect();
    $requete="update patient set(
        nom='$nom',
        prenom='$prenom',
        adresse='$adresse',
        num_tel='$numtel',
        date_naissance='$datenaissance',
        dep_naissance='$dep',
        pays='$pays')";
    $resultat=$connexion->query($requete);
    $resultat->closeCursor();
}