<?php
require_once('connection.php');

	global $con;
		$up_d = $_POST['E_date'];
		$up_num = $_POST['E_nauto'];
		$up_matin = $_POST['E_matin'];
		$up_time1 = $_POST['E_em'];
		$up_time2 = $_POST['E_sm'];
		$up_soir = $_POST['E_soir'];		
		$up_time3 = $_POST['E_es'];
		$up_time4 = $_POST['E_ss'];
		
// DIFFERENCE OF Morning TIME 
                            
	            $dif1=array();
	              $first = strtotime($up_time1);
	              $second = strtotime($up_time2);
	              $timediff = abs($first-$second);
	              $dif1['h'] = floor($timediff/(60*60));

	            

	      // DIFFERENCE OF Afternoon TIME 

                $dif2=array();
                  $first = strtotime($up_time3);
                  $second = strtotime($up_time4);
                  $timediff = abs($first-$second);
                  $dif2['h'] = floor($timediff/(60*60));

                
                
          // Total hour
                $totalH =  $dif1['h']+$dif2['h'];


		$query ="UPDATE POINTAGE SET date_pt='$up_d',present_matin='$up_matin',mat_heure_entre='$up_time1',mat_heure_sorti='$up_time2',present_soir='$up_soir',soir_heure_entre='$up_time3',soir_heure_sorti='$up_time4',total_heure='$totalH'  WHERE num_auto='$up_num'";

		$result = mysqli_query($con,$query);
		if($result)
		{
			echo 'Modification avec succès !!';
		}
		else
		{
			echo 'Ereur erreur     errue    erreur     erreur   erreeuu eeuer eerreur';
		}
?>