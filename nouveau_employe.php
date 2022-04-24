<?php
	
	 $nom = $_POST['nom'];
        $nom = $_POST['nom'];
        $pren = $_POST['prenom'];
        $dateN = $_POST['dateN'];
        $sexe = $_POST['sexe'];
        $tel = $_POST['tel'];
        $service = $_POST['nomServ'];
        $cin = $_POST['cin'];
        $nbE= $_POST['nbE'];
        $fonction = $_POST['fonction'];
        $dateE = $_POST['dateE'];
        $photo = $_POST['photo'];

        $dateEng = date('d/m/Y', strtotime($dateE));
       /* $nom = textboxValue('nom');
        $pren = textboxValue('prenom');
        $dateN = textboxValue('dateN');
        $sexe = textboxValue('sexe');
        $tel = textboxValue('tel');
        $cin = textboxValue('cin');
        $fonction = textboxValue('fonction');
        $dateE = textboxValue('dateE');
        $photo = textboxValue('photo');*/
        if(!empty($nom) && !empty($pren) && !empty($dateN) && !empty($sexe) && $tel && !empty($service) && !empty($cin) && !empty($fonction) && !empty($dateE))
 			{
            $query = "INSERT INTO employe (nom,prenom,date_naiss,sexe,tel,cin,nbEnf,nom_srvc,nom_fonct,date_engage,photo) values('$nom','$pren','$dateN','$sexe','$tel','$cin','$nbE','$service','$fonction','$dateEng','$photo')";
            if(mysqli_query($GLOBALS['con'],$query)){
                echo "<script> alert('Ajout bien reuissie');</script>";
                header('location: employes.php');
                echo 'Successfully Successfully Successfully Successfully Successfully Successfully';
            }else
            {
                echo "<script> alert('Erreur, Employe n'est pas enregistre);</script>";
                echo 'Echec Echec Echec Echec Echec Echec Echec Echec Echec Echec';
            }
        }
        else{
            echo "Veuillez remplir le champ";
        }
?>