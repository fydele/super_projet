<?php
	
	
	if(isset($_POST["id_emp"]))
		{
			
			require_once('connection.php');
			$query = "SELECT * FROM employe where id_emp='".$_POST["id_emp"]."' ";
			$resul= mysqli_query($con,$query);
			echo '
				<div class = "table-responsive">
					<table class="table">';
			while($row = mysqli_fetch_assoc($resul))
			{
				
				echo "
					<div align='center'><img src='image/".$row ['photo']."' width='100px' height='100px' alt='image'></div>

					<tr>
						<td width='40%''><label>Nom: </label></td>
						<td width='30%'>".$row['nom']."</td>
					</tr>
					<tr>
						<td width='40%' ><label>Prenom: </label></td>
						<td width='30%'>".$row['prenom']."</td>
					</tr>
					<tr>
						<td width='400%' ><label>Date de Naissance: </label></td>
						<td width='30%'>".$row['date_naiss']."</td>
					</tr>

					<tr>
						<td width='400%' ><label>Sexe : </label></td>
						<td width='30%'>".$row['sexe']."</td>
					</tr>
					<tr>
						<td width='400%' ><label>Telephone : </label></td>
						<td width='30%'>".$row['tel']."</td>
					</tr>
					<tr>
						<td width='400%' ><label>CIN : </label></td>
						<td width='30%'>".$row['cin']."</td>
					</tr>
					<tr>
						<td width='400%' ><label>Nombre d'enfant : </label></td>
						<td width='30%'>".$row['nbEnf']."</td>
					</tr>
					<tr>
						<td width='40%' ><label>Fonction : </label></td>
						<td width='30%'>".$row['nom_fonct']."</td>
					</tr>
					<tr>
						<td width='40%' ><label>Service : </label></td>
						<td width='30%'>".$row['nom_srvc']."</td>
					</tr>
					<tr>
						<td width='400%' ><label>Date d'engagement: </label></td>
						<td width='30%'>".$row['date_engage']."</td>
					</tr>



				";
			}
			echo '</table></div>';
			
		}
?>