<?php
    require_once('connection.php');
    
   
		global $con;
		$num_ptg = $_POST['num_ptg'];
		$query = "SELECT * FROM pointage where num_auto='$num_ptg'";
		$result= mysqli_query($con,$query);

		while($row = mysqli_fetch_assoc($result))
		{
			$ptg[] ="";
			
			$ptg[0] = $row['num_auto'];
			$ptg[1] = $row['date_pt'];
			$ptg[2] = $row['id_emp'];
			$ptg[3] = $row['present_matin'];
			$ptg[4] = $row['mat_heure_entre'];
			$ptg[5] = $row['mat_heure_sorti'];
			$ptg[6] = $row['present_soir'];
			$ptg[7] = $row['soir_heure_entre'];
			$ptg[8] = $row['soir_heure_sorti'];
			

		}
		echo json_encode($ptg);
	
?>