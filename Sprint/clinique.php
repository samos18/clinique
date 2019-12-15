<?php

require_once('controleur/controleur.php');

try {
    if(isset($_POST['connexion'])){
        $login=$_POST['user'];
        $mdp=$_POST['mdp'];
        CtlConnect($login, $mdp);
    }
    elseif(isset($_POST['deconnexion'])){
        CtlDeconnect();
    }
    elseif(isset($_POST['modifier'])){
        $nom=$_POST['Nom'];
        $prenom=$_POST['Prenom'];
        $adresse=$_POST['Adresse'];
        $numtel=$_POST['Num'];
        $datenaissance=$_POST['Naissance'];
        $depnaissance=$_POST['Dep'];
        CtlModifierPatient($nom, $prenom, $adresse, $numtel, $datenaissance, $dep, $pays);
    }
    elseif(isset($_POST['getID'])){
        $nom=($_POST['nommed']);
        $spe=($_POST['spemed']);
        CtlIdMedecin($nom, $spe);
    }
    elseif(isset($_POST['valider_creneaux'])){
        $id=$_POST['id'];
        $nbcreneau=$_POST['nbcreneaux'];
        if($nbcreneau>=1 and ctype_digit($nbcreneau)){
            $datebloquer=$_POST['datecreaneaux'];
            $horairebloquer=$_POST['horraire'];
            $libelle=$_POST['raison'];
            Ctlbloquer($id, $libelle, $datebloquer, $horairebloquer);            
        }
    }
    else if (isset($_POST['recuperer'])){
        $nom=$_POST['name'];
        $date=$_POST['Date'];
        CtlRecupNss($nom, $date);
    }
    elseif(isset($_POST['saisir'])){
        $nss=$_POST['num'];
        CtlSynthesePatient($nss);

    }
    elseif(isset($_POST['ajouter'])){
        $nss=$_POST['num'];
        $montant=$_POST['montant'];
        CtlDepot($nss, $montant);
    }
    elseif( isset($_POST['creerpatient'])){
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $adresse=$_POST['adresse'];
        $numtel=$_POST['numero'];
        $datenaissance=$_POST['naissance'];
        $depnaissance=$_POST['departement'];
        $solde=$_POST['solde'];
            if($depnaissance != 99 and ctype_digit($numtel)){
                CtlAjoutPatient($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$solde);
            }
            else if($depnaissance==99 and ctype_digit($numtel)){
                $pays=$_POST['Pays'];
                CtlAjoutPatientEtranger($nom,$prenom,$adresse,$numtel,$datenaissance,$depnaissance,$pays,$solde);
            }
            else {
                throw new Exception('numéro invalide');
            }
    }

    else if(isset($_POST['Creercompte'])){
        $login=$_POST['pseudo'];
        $mdp=$_POST['pass'];
        $categorie=$_POST['cat'];
        if($categorie=='médecin'){
            $nommedecin=$_POST['nommedecin'];
            $prenommedecin=$_POST['prenommedecin'];
            $specialitemedecin=$_POST['specialitemedecin'];
            CtlAjoutMedecin($categorie,$nommedecin,$prenommedecin,$specialitemedecin);
        }
        CtlAjoutCompte($login, $categorie, $mdp);
        afficherDirecteur();     
        
    }
    else if(isset($_POST['creermotif'])){
        $motifrdv=$_POST['motif'];
        $prix=$_POST['prix'];
        $piece=$_POST['pieceafournir'];
        $consigne=$_POST['consigne'];
        CtlAjoutMotif($motifrdv, $piece, $consigne, $prix);
        afficherDirecteur();
    }

    else if(isset($_POST['supprimermotif'])){
        $motif=$_POST['nommotif'];
        CtlSuppMotif($motif);
        afficherDirecteur();
    }
    else if(isset($_POST['supprimermedecin'])){
        $login=$_POST['pseudo'];
        $mdp=$_POST['pass'];
        $categorie=$_POST['cat'];
        if($categorie=='médecin'){
            $nommedecin=$_POST['nommedecin'];
            $prenommedecin=$_POST['prenommedecin'];
            $specialitemedecin=$_POST['specialitemedecin'];
          
            CtlSuppMedecin($login,$mdp,$nommedecin, $prenommedecin, $specialitemedecin);
            afficherDirecteur();
        }


    }
    elseif(isset($_POST['afficherpayement'])){
        $nss=$_POST['num2'];
        CtlRdvNonPayer($nss);
    }
    elseif(isset($_POST['verification'])){
        CtlMotif();
        $nom=$_POST['nommedecin'];
        $spe=$_POST['specialite'];
        CtlMedecin ($nom,$spe);
    }
    elseif(isset($_POST['reserver'])){
        $date=$_POST['daterdv'];
        $heure=$_POST['heurerdv'];
        $nom=$_POST['nommedecin'];
        $spe=$_POST['specialite'];
        CtlReserver($nom, $spe, $date, $heure);
    }
    else {
        CtlAcceuil();
    }
}
catch(Exception $e) {
   $msg=$e->getMessage();
   CtlErreur($msg);
}