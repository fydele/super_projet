<?php
require_once('connection.php');
	global $con;
		 $Del_Id = $_POST['num'];
		  $query = "DELETE from service_fonction where auto = '$Del_Id'";

		//$query =  "DELETE FROM `employe` WHERE `employe`.`id_emp` = 111";

		 if($result= mysqli_query($GLOBALS['con'],$query))
		 {
		 	echo "Service est bien supprimé!!";
		 }
		 else
		 {
		 	echo "Echec!!";
		 }
?>