<?php

include('connection.php');

    if (isset($_POST['id_emp']))
    {
		$query = "SELECT * FROM employe where id_emp='".$_POST["id_emp"]."'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);

	}
?>