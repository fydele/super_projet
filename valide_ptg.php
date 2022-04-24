<?php
	include ('connection.php');
  include('tableau_ptg.php');
  if (!empty($_POST)) 
  {

        $id_emp   = $_POST['id'];
       // $nom      = $_POST['nom'];
        //$pren     = $_POST['prenom'];
        $time1    = $_POST['h_entr_mat'];
        $time2    = $_POST['h_sort_mat'];
        //$presM      = $_POST['pres_mat'];
        $absM      = $_POST['abs_mat'];
        $time3     = $_POST['h_entr_soir'];
        $time4 = $_POST['h_sort_soir'];
        //$presS    = $_POST['pres_soir'];
        $absS    = $_POST['abs_soir'];
        $date    = $_POST['date_pt'];
        

        if ($absM=="") 
        {
        	echo 'Cocher la presence matin';	
        }
        $query = "SELECT id_emp,date_pt FROM POINTAGE";
        $select = mysqli_query($GLOBALS['con'],$query);
        while($row=mysqli_fetch_array($select))
        {
        	$id = $row['id_emp'];
        	$datept = $row['date_pt'];
        }
        if($id == $id_emp && $datept == $date)
        	{
        		 echo "<span class='form-error'> Cet employe est deja pointe a cette date ou Verifiez la date!!</span> ";
        	}
      	else
       	{

         // DIFFERENCE OF Morning TIME 
                            
	            $dif1=array();
	              $first = strtotime($time1);
	              $second = strtotime($time2);
	              $timediff = abs($first-$second);
	              $dif1['h'] = floor($timediff/(60*60));

	              echo $dif1['h']; 

	      // DIFFERENCE OF Afternoon TIME 

                $dif2=array();
                  $first = strtotime($time3);
                  $second = strtotime($time4);
                  $timediff = abs($first-$second);
                  $dif2['h'] = floor($timediff/(60*60));

                  echo $dif2['h']; 
                
          // Total hour
                $totalH =  $dif1['h']+$dif2['h'];

                             
        $query = "SELECT nom,prenom FROM employe WHERE id_emp='$id_emp '";
        $res = mysqli_query($GLOBALS['con'],$query);
         	if(mysqli_num_rows($res))
            {

                foreach ($res as $row) 
                {
                   	$nom = $row['nom'];
                   	$pren = $row['prenom'];
                }
        	}

        $sql="INSERT INTO `pointage` (`num_auto`, `date_pt`, `id_emp`, `nom`, `prenom`, `mat_heure_entre`, `mat_heure_sorti`, `present_matin`, `soir_heure_entre`, `soir_heure_sorti`, `present_soir`, `total_heure`) VALUES (NULL,'$date', '$id_emp', '$nom', '$pren', '$time1', '$time2','$absM', '$time3', '$time4','$absS', '$totalH')";
    

       
        	if(mysqli_query($GLOBALS['con'],$sql))
        	{
            
        		 echo "Insertion reuissiereuissiereuissiereuissiereuissiereuissiereuissiereuissiereuissie";
        	}
        	 else 
        	{
            echo 'ErrorErrorErrorErrorErrorErrorErrorErrorErrorErrorErrorErrorErrorErrorError';
        	}
        
    }
}

?>