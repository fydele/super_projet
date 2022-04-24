<?php
require_once 'FPDF/fpdf.php';
require 'connection.php';


 if(isset($_GET['imprimer']))
  {
    $from_date = $_GET["d_date"];
    $to_date = $_GET["f_date"]; 
    
    
     $query = "SELECT pointage.id_emp,pointage.nom,pointage.prenom,employe.nom_fonct,employe.nbEnf,employe.nom_srvc,sum(total_heure) as totalH,sum(present_matin) as pres_mat,sum(present_soir) as pres_soir FROM EMPLOYE,POINTAGE WHERE EMPLOYE.id_emp=POINTAGE.id_emp AND date_pt BETWEEN '$from_date' AND '$to_date' group by id_emp";
    $data = mysqli_query($con,$query);


class PDF extends FPDF
  {
    /* Page header */
    function Header()
    {
        
        
        /* Move to the right */
        // Logo
        $this->Image('image/logos.png',40,10,18);
        $this->setTextColor(100,20, 100);
        $this->SetFont('helvetica','',5);
        // Width,Height,Content, border, Line, Align
        $this->Cell(189,3,'MINISTERE DE LA SANTE PUBLIQUE',0,1,'C');
        $this->Cell(189,3,'SECRETARIAT GENERAL',0,1,'C');
        $this->Cell(189,3,'***********',0,1,'C');
        $this->Cell(189,3,'DIRECTION GENERALE DE FOURNITURE DES SOINS',0,1,'C');
        $this->Cell(189,3,'***********',0,1,'C');
        $this->Cell(189,3,'CENTRE HOSPITALIER UNIVERSITAIRE',0,1,'C');
        $this->Cell(189,3,'TAMBOHOBE FIANARANTSOA',0,1,'C');
        $this->Ln(5);
        

    
}
    /* Page footer */
    function Footer()
    {
        /* Position at 1.5 cm from bottom */
        $this->SetY(-15);
        /* Arial italic 8 */
        $this->SetFont('Arial','I',8);
        /* Page number */
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}
    /*Page Body */
    /* Instanciation of inherited class */
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

         
            $pdf->SetFont('arial','',6);
            $pdf->setTextColor(50,100, 150);
            $pdf->Cell(189,3,"RAPPORT D'ATTACHEMENT DES AGENTS CONTRACTUELS (EMO) DU CENTRE HOSPITALIER UNIVERSITAIRE DE TAMBOHOBE FIANARANTSOA  ",0,1,'C');
            $pdf->Cell(189,3,'PENDANT LE '.$from_date."  jusqu'au ".$to_date,0,1,'C');
            $pdf->Ln(2);
            $pdf->SetFont('Times','',8);
            $pdf->setTextColor(100,100, 100);
            $pdf->cell('10','6','Numero','1','0','C');
            $pdf->cell('40','6','Nom','1','0','C');
            $pdf->cell('30','6','Prenom','1','0','C');
            $pdf->cell('20','6','CIN','1','0','C');
            $pdf->cell('20','6','Date Naiss','1','0','C');
            $pdf->cell('20','6','Fonction','1','0','C');
            $pdf->cell('20','6','Service','1','0','C');
            $pdf->cell('20','6','Nombre du Jour','1','0','C');
            $pdf->cell('25','6','Volume Horaire (H)','1','1','C');

            $pdf->SetFont('arial','', '7');

            while($row = mysqli_fetch_assoc($data))
            {
                $nb_jour = ($row['pres_mat']+$row['pres_soir'])/2;
                          
                $pdf->cell('10','5',$row['id_emp'],'1','0','C');
                $pdf->cell('40','5',$row['nom'],'1','0','C');
                $pdf->cell('30','5',$row['prenom'],'1','0','C');
                $pdf->cell('20','5',$row['cin'],'1','0','C');
                $pdf->cell('20','5',$row['date_naiss'],'1','0','C');
                $pdf->cell('20','5',$row['nom_fonct'],'1','0','C');
                $pdf->cell('20','5',$row['nom_srvc'],'1','0','C');
                $pdf->cell('20','5',$nb_jour,'1','0','C');
                $pdf->cell('25','5',$row['totalH'],'1','1','C');
                
            }
        }
        




$pdf->Output();
?>
        