<?php
	require_once 'FPDF/fpdf.php';
	require_once 'connection.php';

		
	

	if(isset($_POST['btn_print']))
	{

			$sql = "SELECT * FROM EMPLOYE";
			$data = mysqli_query($con,$sql);

			class PDF extends FPDF
			  {
			    /* Page header */
			    function Header()
			    {
			        
			        
			        /* Move to the right */
			        // Logo
			        $this->Image('image/logos.png',40,10,18);
			        $this->setTextColor(25,200, 20);
			        $this->SetFont('helvetica','',6);
			        // Width,Height,Content, border, Line, Align
			        $this->Cell(189,3,'MINISTERE DE LA SANTE PUBLIQUE',0,1,'C');
			        $this->Cell(189,3,'SECRETARIAT GENERAL',0,1,'C');
			        $this->Cell(189,3,'***********',0,1,'C');
			        $this->Cell(189,3,'DIRECTION GENERALE DE FOURNITURE DE SOINS',0,1,'C');
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



			$pdf = new PDF();
    		$pdf->AliasNbPages();
    		$pdf->AddPage();
    		$pdf->SetFont('arial','', '7');

	        $pdf->Cell(200,3,"Liste des employes main d'oeuvre (EMO)",0,1,'C');
	        $pdf->Ln(1);
	        $pdf->setLeftMargin(10);
	        $pdf->setTextColor(0, 0, 0);

			$pdf->SetFont('arial','b', '7');
			$pdf->cell('10','5','Numero','1','0','C');
			$pdf->cell('45','5','Nom','1','0','C');
			$pdf->cell('40','5','Prenom','1','0','C');
			$pdf->cell('10','5','Enfant','1','0','C');
			$pdf->cell('20','5','Telephone','1','0','C');
			$pdf->cell('20','5','Fonction','1','0','C');
			$pdf->cell('20','5','Service','1','0','C');
			$pdf->cell('25','5','Date Engagement','1','1','C');

			$pdf->SetFont('arial','', '7');
			while($row = mysqli_fetch_assoc($data))
			{
				$pdf->cell('10','5',$row['id_emp'],'1','0','C');
				$pdf->cell('45','5',$row['nom'],'1','0','C');
				$pdf->cell('40','5',$row['prenom'],'1','0','C');
				$pdf->cell('10','5',$row['nbEnf'],'1','0','C');
				$pdf->cell('20','5',$row['tel'],'1','0','C');
				$pdf->cell('20','5',$row['nom_fonct'],'1','0','C');
				$pdf->cell('20','5',$row['nom_srvc'],'1','0','C');
				$pdf->cell('25','5',$row['date_engage'],'1','1','C');
				
			}
		}
		$pdf->Output();
	

?>