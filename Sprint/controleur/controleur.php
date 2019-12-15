<?php

require_once('modele/modele.php');
require_once('vue/vue.php');

function CtlAcceuil(){
    afficherAcceuil();
} 

function CtlAgent(){
    afficherAgent();
}

function CtlMedecin ($nom,$spe){
    if(isset($_POST['verification']) and !empty($_POST['nommedecin']) and !empty($_POST['specialite'])){
        $nom=$_POST['nommedecin'];
        $spe=$_POST['specialite'];
        $medecin=getIdMedecin($nom, $spe);
        if ($medecin != null){
            echo '<script> alert("correspond") </script>';
        }
        else{
            echo '<script> alert("faux") </script>';
        }
    }
}

function CtlReserver($nom, $spe, $date, $heure){
    if(isset($_POST['reserver']) and !empty($_POST['numms']) and !empty($_POST['daterdv']) and !empty($_POST['heurerdv']) and !empty($_POST['nommedecin']) and !empty($_POST['specialite'])){
        $date=$_POST['daterdv'];
        $heure=$_POST['heurerdv'];
        $nom=$_POST['nommedecin'];
        $spe=$_POST['specialite'];
        if(getdateheure($date, $heure)==null){
            $idmed=getIdMedecin($nom, $spe);
            $nss=$_POST['numms'];
            $idcren=getdateheure($date, $heure);
            $motif=$_POST['motif'];
            $idInter=getIdIntervention($motif);
            ajoutRdvPatient($idmed, $nss, $idcren, $idInter);
            CtlAgent();

        }
    }
}

function CtlMotif(){
    if(isset($_POST['verification'])){
        $motif=getMotif();
        afficherMotif($motif);
        CtlAgent();
    }
}

function CtlConnect ($login, $mdp){
    if(isset($_POST['connexion']) and !empty($_POST['user']) and !empty($_POST['mdp'])){
        $login=$_POST['user'];
        $mdp=$_POST['mdp'];
        $cate=checkCategorie($login, $mdp);

        $pseudo=checkEmploye($login, $mdp);
        foreach($cate as $verif){
            if($verif[0]=="médecin" and $pseudo!=null){
                afficherMedecin();
            }
            else if ($verif[0] == "agent" and $pseudo!=null){
                afficherAgent();
            }
            else if($verif[0]=="directeur"and $pseudo!=null){
                afficherDirecteur();
            }
            else {
                throw new Exception ("login ou mdp incorrect !");
            }
        }
    }
    else {
        throw new Exception ("login ou mdp vide.");
    }


}
function CtlIdMedecin($nom, $spe){
    if(isset($_POST['getID']) and !empty($_POST['nommed']) and !empty($_POST['spemed'])){
        $nom=($_POST['nommed']);
        $spe=($_POST['spemed']);
        $id=getIdMedecin($nom, $spe);
        afficherIDMedecin($id);
    }
    else {
        throw new Exception('erreur');
    }
}

function CtlErreur($erreur){
    afficherErreur($erreur, "gabaritConnect.php");
}

function CtlRecupNss($nom, $date){
    if (isset($_POST['recuperer']) and !empty($_POST['name']) and !empty($_POST['Date'])){
        $nom=$_POST['name'];
        $date=$_POST['Date'];
        $nss=getNSS($nom, $date);
        afficherNSS($nss);
        CtlAgent();
    }
    else {
        throw new Exception('erreur');
    }
}

function CtlSynthesePatient($nss){
    if(isset($_POST['saisir']) and !empty($_POST['num'])){
        $nss=$_POST['num'];
        $synthese=getSynthese($nss);
        afficherSynthese($synthese);
        CtlAgent();
    }
    else {
        throw new Exception('erreur');
    }
}

function CtlListeRdv($nss, $synthese){
    if(isset($_POST['saisir']) and !empty($_POST['num'])){
        $statut=getStatutRdvNonPayer($nss);
        $liste=RdvNonPayer($nss, $statut);
        afficherListeRdv($liste);
        CtlAgent();
    }
    else {
        throw new Exception ('erreur');
    }
}

function CtlDepot($nss, $montant){
    if(isset($_POST['ajouter']) and !empty($_POST['num']) and !empty($_POST['montant'])){
        $nss=$_POST['num'];
        $montant=$_POST['montant'];
        depot($nss, $montant);
        CtlAgent();
    }
    else {
        throw new Exception('erreur');
    }
}

function CtlAfficherInformationsPatient($nss){
    if(isset($_POST['monter']) and !emty($_POST['information'])){
        $nss=$_POST['information'];
        $synthese=getSynthese($nss);
        CtlAgent();
    }
}


function CtlAjoutPatient($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$solde){
    if(!empty($prenom) and !empty($nom) and !empty($adresse) and !empty($numtel) and 
    !empty($datenaissance) and !empty($depnaissance) and !empty($solde) and
    isset($_POST['creerpatient']) ){
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $adresse=$_POST['adresse'];
        $numtel=$_POST['numero'];
        $datenaissance=$_POST['naissance'];
        $depnaissance=$_POST['departement'];
        $solde=$_POST['solde'];
        ajouterPatient($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$solde);
        CtlAgent();
    }
    else{
        throw new Exception("un champ est vide");
        }
    
}

function CtlAjoutPatientEtranger($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$pays,$solde){
    if(!empty($prenom) and !empty($nom) and !empty($adresse) and !empty($numtel) and 
    !empty($datenaissance) and !empty($depnaissance) and !empty($pays) and !empty($solde) and
    isset($_POST['creerpatient']) ){
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $adresse=$_POST['adresse'];
        $numtel=$_POST['numero'];
        $datenaissance=$_POST['naissance'];
        $depnaissance=$_POST['departement'];
        $pays=$_POST['Pays'];
        $solde=$_POST['solde'];
        ajouterPatientEtranger($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$pays,$solde);
        CtlAgent();
    }
    else{
        throw new Exception("un champ est vide");
        }
}


function CtlAjoutCompte($login, $idcate, $mdp){
    if(!empty($login) and !empty($idcate) and !empty($mdp) and
    isset($_POST['Creercompte'])){
        $login=$_POST['pseudo'];
        $mdp=$_POST['pass'];
        $idcate=$_POST['cat'];
        ajouterCompte ($login, $idcate, $mdp);
    }
    else{
        throw new Exception("compte non ajouté");
    }
}

function CtlAjoutMotif($motifrdv, $piece, $consigne, $prix){
    if(!empty($motifrdv) and !empty($piece) and !empty($consigne) and !empty($prix) and isset($_POST['creermotif'])){
        $motifrdv=$_POST['motif'];
        $prix=$_POST['prix'];
        $piece=$_POST['pieceafournir'];
        $consigne=$_POST['consigne'];
        ajouterIntervention($motifrdv, $piece, $consigne, $prix);
    }
    else{
        throw new Exception("motif non ajouté");
    }
}


function CtlSuppMotif($motif){
    if(!empty($motif) and isset($_POST['supprimermotif'])){        
        $motif=$_POST['nommotif'];
        supprimerMotif($motif);
    }

    else{
        throw new Exception("motif non supprimé");
    }

}

function CtlSuppMedecin($login,$mdp,$nom, $prenom, $specialite){
    if(!empty($nom) and !empty($prenom) and !empty($specialite) and isset($_POST['supprimermedecin'])){
        $nom=$_POST['nommedecin'];
        $prenom=$_POST['prenommedecin'];
        $specialite=$_POST['specialitemedecin'];
        $login=$_POST['pseudo'];
        $mdp=$_POST['pass'];
        supprimerMedecin($nom, $prenom, $specialite);
        supprimerEmploye($login, $mdp);
    }
    else{
        throw new Exception("médecin non supp");
    }
}

function CtlAjoutMedecin($categorie,$nommedecin,$prenommedecin,$specialitemedecin){
    if(!empty($nommedecin) and !empty($prenommedecin) and !empty($categorie) and !empty($specialitemedecin) and isset($_POST['Creercompte'])){
        $categorie=$_POST['cat'];
        $nommedecin=$_POST['nommedecin'];
        $prenommedecin=$_POST['prenommedecin'];
        $specialitemedecin=$_POST['specialitemedecin'];
        ajouterMedecin ($categorie, $nommedecin, $prenommedecin, $specialitemedecin);
    }
    else{
        throw new Exception ('médecin non ajouté');
    }
}

function CtlRdvNonPayer($nss){
    if(isset($_POST['afficherpayement']) and !empty($_POST['num2'])){
        $nss=$_POST['num2'];
        $statut=getStatutRdvNonPayer($nss);
        RdvNonPayer($nss, $statut);
        CtlAgent();
    }
    else {
        throw new Exception('erreur');
    }
}

function CtlDeconnect(){
    if (isset($_POST['deconnexion'])){
       CtlAcceuil();
    }
}
//a finir
function Ctlbloquer($id, $libelle, $date, $heure){
    if(isset($_POST['valider_creneaux']) and !empty($id) and !empty($libelle) and !empty($date) and !empty($heure)){
        bloquerCreneau($id, $libelle, $date, $heure);
    }
    else {
        throw new Exception ('pas disponible');
    }
}

function CtlModifierPatient($nom, $prenom, $adresse, $numtel, $datenaissance, $dep, $pays){
    if (isset($_POST['modifier']) and !empty($prenom) and !empty($nom) and !empty($adresse) and !empty($numtel) and 
    !empty($datenaissance) and !empty($depnaissance) and !empty($pays)){
        modifierPatient($nom, $prenom, $adresse, $numtel, $datenaissance, $dep, $pays);
    }
    else {
        throw new Exception('erreur');
    }
}



