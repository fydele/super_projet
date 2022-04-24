<?php
    include('connection.php');
    // Si l'utilisateur n'a pas d compte il ne peut pas acces a cette page
    if(empty($_SESSION['username']))
    {
        header('location: login.php');
    }
    
    //Requette pour l'affichage au tableau
    $result = mysqli_query($GLOBALS['con'], "SELECT * FROM employe");


    if(isset($_POST['ajouter'])){
        createdataEmp();
    }

    if(isset($_POST['inserer'])){
       addFonction();
       
    }

    if(isset($_POST['addServ'])){
       addService();
       
    }

    

    function addFonction(){
        $nomFonct= $_POST['nomFonct'];
        if($nomFonct){
            $sql="INSERT INTO FONCTION (nom_fonct) VALUES('$nomFonct')";
            if(mysqli_query($GLOBALS['con'],$sql)){
                echo "Bien insere";
            }else
            {
                echo "echec";
            }
        }
        else{
            echo "Probleme de sql";
        }
    }

     function addService(){
        $code = $_POST['codeServ'];
        $nomServ= $_POST['nomServ'];

        if($nomServ){
            $sql="INSERT INTO SERVICE (code_srvc,nom_serv) VALUES('$code','$nomServ')";
            if(mysqli_query($GLOBALS['con'],$sql)){
                echo "Bien insere";
            }else
            {
                echo "echec";
            }
        }
        else{
            echo "Probleme de sql";
        }
    }

    function createdataEmp(){
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
        if(!empty($nom) && !empty($pren) && !empty($dateN) && !empty($sexe) && !empty($service) && !empty($cin) && !empty($fonction) && !empty($dateE))
 			{
            $query = "INSERT INTO employe (nom,prenom,date_naiss,sexe,tel,cin,nbEnf,nom_srvc,nom_fonct,date_engage,photo) values('$nom','$pren','$dateN','$sexe','$tel','$cin','$nbE','$service','$fonction','$dateE','$photo')";
            if(mysqli_query($GLOBALS['con'],$query)){
                echo "<script> alert('Ajout bien reuissie');</script>";
               // header('location: employes.php');
                echo 'Reussie!!';
            }else
            {
                echo "<script> alert('Erreur, Employe n'est pas enregistre);</script>";
                echo 'Echec!!';
            }
        }
        else{
            echo "Veuillez remplir le champ";
        }

    }
     
?>



<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Gestion de Pointage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="assets/css/style1.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/jpg" href="image/listpt.png">
	<link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <style type="text/css" media="screen">

        .card-header {
          background-color:#00A652;
        }

    	.navbar{
            display: block;
            margin-top: 20px;
            margin-left: 160px;
            height: 20px;
		   	padding: 2% 18px;
		   	}
        #delete-message{
            margin-left: 160px;
        }
		.sidenav .active3{
            color: #0B5ED7;
            background-color: white;
            font-size: 15px;
        }
       
       label {
        color: #04780C;
       }
        /*tr:nth-child(even){background-color: #2AC975;}
        tr:nth-child(odd){background-color: #10F605;}*/

        .image-preview{
            width: 200px;
            min-height: 50px;
            border: 2px solid #055713;
            margin-top: 15px;

            /*Default text*/
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: black;
        }
        .image-preview__image{
            display: none ;
            width: 100%;
        }
        #nouveauEmp{
            font-size: 14px;
        }

        .btn1{
            border-radius: 10px;
            background-color: #0080FF;
            color: white;
        }
	    	
    </style>

    <script src="assets/vendor/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="assets/js/myjs.js"> </script>
        
        
        

		
</head>
<body>
	<script type="text/javascript">
  $(document).ready(function()
  {
       
      $(document).on('click','#newEmp',function()
        {
        $('#nouveauEmp').modal('show');
        
      });

      $(document).on('click','#ajouter',function()
        {
            $.ajax(
              {
                url: "nouveau_employe.php",
                method: "POST",
                data : $('#newEmpl').serialize(),

                sucess : function(data)
                {
                  $('#newEmpl')[0].reset();
                  $('#nouveauEmp').modal('show');
                }
              });
        
      });


      $(document).on('click','#btnview',function()
        {
            var id_em = $(this).attr("data-ide");
            
            $.ajax(
                {
                    url: 'detail.php',
                    method: 'POST',
                    data: {id_emp:id_em},
                    success: function(data)
                    {  
                        $('#employe_detail').html(data);
                        $('#detailmodal').modal('show');
                    }
                });
        });

  });
</script>



    <!-- NAVBAR-->
    <?php
        require_once 'sidebar.php';
    ?> 

        <div class="logo position-fixed">
            <div class="logo"><img src="image/logos.png" alt="logoChuT" width="115px"></div>
        </div>

    <div class="main">



        <!--<!-- ############################### FORMULAIRE ADD EMPLOYE MODAL ##########################################-->
                    <div class="modal fade" id="nouveauEmp" tabindex="-5" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h5 class="modal-title" style="text-align: center; color: white;">Formulaire des employes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                     <p id="add_message" class="text-warning"></p>
                                    <form name="newEmpl" method="POST" action="employes.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nom :</label>
                                                    <input type="text" name="nom" id="nom" class="form-control" required onkeypress="isInputNumber(event)" /><br />
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom">Prenom :</label>
                                                    <input type="text" name="prenom" id="prenom" class="form-control" required onkeypress="isInputNumber(event)"/><br />
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateN">Date Naissance :</label>
                                                    <input type="date" name="dateN" id="dateN" class="form-control" required/><br />
                                                </div>

                                                <div class="form-group">
                                                    <label for="sexe">Sexe :</label><select name="sexe" id="sexe" class="form-control">
                                                        <option>Homme</option>
                                                        <option>Femme</option>
                                                    </select>
                                                </div>
                                                <br />

                                                
                                                <div class="form-group">
                                                    <label for="tel">Telephone :</label>
                                                    <input type="text" name="tel" id="tel" class="form-control" onkeypress="chiffre(event)"/>
                                                    
                                                </div>

                                                 <?php
                                                    $sql="SELECT nom_serv from service where num_serv in (SELECT num_serv from service_fonction)" ;
                                                    $res= mysqli_query($GLOBALS['con'],$sql);

                                                    if(mysqli_num_rows($res)>0){
                                                
                                                    echo "<label for=\"nomF\">Service :</label><select name=\"nomServ\" id=\"fonction\" class=\"form-control\">";
                                                    while($rows= mysqli_fetch_assoc($res)){
                                                        echo "<option>".$rows["nom_serv"]."</option>";
                                                    }
                                                    echo "</select>";
                                                    }
                                                ?>
                                                                                                <br />

                                            </div>

                                            <div class="col-md-4">
                                                <label for="cin">CIN :</label>
                                                <input type="text" name="cin" id="cin" class="form-control" required onkeypress="chiffre(event)"/><br />

                                                <?php
                                                    $sql="SELECT nom_fonct from fonction where id_fonct in (SELECT id_fonct from service_fonction)" ;
                                                    $res= mysqli_query($GLOBALS['con'],$sql);

                                                    if(mysqli_num_rows($res)>0){
                                                
                                                    echo "<label for=\"nomF\">Fonction :</label><select name=\"fonction\" id=\"fonction\" class=\"form-control\">";
                                                    while($rows= mysqli_fetch_assoc($res)){
                                                        echo "<option>".$rows["nom_fonct"]."</option>";
                                                    }
                                                    echo "</select>";
                                                    }
                                                ?>


                                                <label for="dateE">Date d'engagement :</label>
                                                <input type="date" name="dateE" id="dateE" class="form-control" required/><br />
                                                <label for="nbE">Nombre d'enfant :</label><input type="text" name="nbE" id="nbE" class="form-control" value="0" onkeypress="chiffre(event)"/><br />
                                                 <label for="photo">Photo </label><input type="file" name="photo" id="photo" class="form-control" /><br />
                                            </div>

                                            <div class="col-md-4">
                                                <div class="image-preview" id="imagePreview">
                                                    <img src="" alt="image Preview" class="image-preview__image">
                                                   <span class="image-preview__default-text">Image preview</span> 
                                                </div>
                                                    </br></br>
                                                <input type="submit" name='ajouter' id="ajouter" value="Ajouter" class="btn btn-success"/>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                    
                                            </div>

                                        </div>

                                </div>
                                <div class="modal-footer">
                                    
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


        <!--- ############################### FORMULAIRE EDIT MODAL ###################################################-->

        <div class="modal fade" id="editmodal" tabindex="-5" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-center">
                                    <h5 class="modal-title " id="exampleModalLabel" style="color: white;"> Modification des employes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p id="up_message" class="bg-success text-white text-center">
                                    <form method="POST" action="employes.php">
                                        <div class="row">
                                            <div class="col-md-4">

                                                <div class="form-group">
                                                     <input type="hidden" name="id" id="ed_id" />
                                                    <label>Nom :</label><input type="text" name="nom" id="ed_nom" class="form-control" onkeypress="isInputNumber(event)" /><br />
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom">Prenom :</label><input type="text"
                                                        name="prenom" id="ed_prenom" class="form-control" onkeypress="isInputNumber(event)"  /><br />
                                                </div>

                                                <div class="form-group">
                                                    <label for="dateN">Date Naissance :</label><input type="date"
                                                        name="dateN" id="ed_dateN" class="form-control" /><br />
                                                </div>

                                                <div class="form-group">
                                                    <label for="sexe">Sexe :</label><select name="sexe" id="ed_sexe" class="form-control">
                                                        <option>Homme</option>
                                                        <option>Femme</option>
                                                    </select>
                                                </div>
                                                <br />

                                                
                                                <div class="form-group">
                                                    <label for="tel">Telephone :</label><input type="text" name="tel" id="ed_tel" class="form-control" onkeypress="chiffre(event)" />
                                                    
                                                </div>
                                                <br />

                                               <?php
                                                    $sql="SELECT nom_serv from service where num_serv in (select num_serv from service_fonction)" ;
                                                    $res= mysqli_query($GLOBALS['con'],$sql);

                                                    if(mysqli_num_rows($res)>0){
                                                
                                                    echo "<label for=\"nomF\">Service :</label><select name=\"nomServ\" id=\"ed_serv\" class=\"form-control\">";
                                                    while($rows= mysqli_fetch_assoc($res)){
                                                        echo "<option>".$rows["nom_serv"]."</option>";
                                                    }
                                                    echo "</select> <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#addService\" title=\"Ajouter nouvelle service\">+</button> </br>";
                                                    }
                                                ?>
                                                                                                <br />

                                            </div>

                                            <div class="col-md-4">
                                                <label for="cin">CIN :</label>
                                                <input type="text" name="cin" id="ed_cin" class="form-control" required onkeypress="chiffre(event)"/><br />

                                                <?php
                                                    $sql="SELECT nom_fonct from fonction where id_fonct in (select id_fonct from service_fonction)" ;
                                                    $res= mysqli_query($GLOBALS['con'],$sql);

                                            if(mysqli_num_rows($res)>0){
                                            
                                                echo "<label for=\"nomF\">Fonction :</label><select name=\"fonction\" id=\"ed_fonction\" class=\"form-control\">";
                                                while($rows= mysqli_fetch_assoc($res)){
                                                    echo "<option>".$rows["nom_fonct"]."</option>";
                                                }
                                                echo "</select> <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#addFonction\">Inserer</button> </br>";
                                            }
                                        ?>


                                                <label for="dateE">Date d'engagement :</label>
                                                <input type="date"
                                                    name="dateE" id="ed_dateE" class="form-control" /><br />
                                                 <label for="nbE">Nombre d'enfant :</label>
                                                <input type="text" name="nbE" id="ed_nbE" class="form-control" onkeypress="chiffre(event)" /><br />

                                                <label for="photo">Photo </label><input type="file" name="photo" id="ed_photo" class="form-control" /><br />                         
                                            </div>

                                            <div class="col-md-4">
                                                <div class="image-preview" id="eimagePreview">
                                                    <img src="" alt="image Preview" class="image-preview__image">
                                                   <span class="image-preview__default-text">Image preview</span> 
                                                </div>
                                                    </br></br>
                                                <input type="button" name='modifier' id="modifier" value="ModifierEmp" class="btn btn-success" />
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-close">Retour</button>
                                            </div>
                                    
                                        </div>
                                    </form>

                                </div>
    
                            </div>
                        </div>
                    </div>


        <!--<!-- ############################### FORMULAIRE DELETE MODAL##########################################-->

            <div class="modal fade" id="deletemodal" tabindex="-5" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModal">Suppression des employes</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Voullez vouz vraiment supprimer cet employe???</p>
                                        <button type="button" class="btn btn-danger" id="delete_emp">Oui</button>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Non</button>
                                    
                                </div>
                            
                            </div>
                        </div>
                </div>


<!--<!-- ############################### FORMULAIRE Details MODAL##########################################-->

            <div class="modal fade" id="detailmodal" tabindex="-5" aria-labelledby="detailModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h5 class="modal-title " id="desc_emp" style="color: white;">Description d'un employe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="employe_detail">
                                   
                                </div>
                            
                            </div>
                        </div>
                    </div>


           


        





     <!-- NAVBAR DE BOUTTON-->

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4 text-light">
                        <h4>Liste des employees</h4>
                    </div>
                    <div class="col-md-4">
                        <form method="POST" action="">
                            
                            <input type="text" placeholder="Recherche des employes..." name="search" id="search" class="form-control">
                            
                        </form>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn1" id="newEmp"><img src="image/addempl.png" alt="search" width="30px">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        

            <div class="card-body">

                <!--Bouton de recherche -->

<!--<!-- ############################### MESSAGE APRES SUPPRESSION###############################################-->
            
                <p id="delete-message" class="text-dark"></p>

                 <p id="up_message" class="text-dark"> </p>
        		      	
        <!-- ############################### TABLEAU DES LISTES DES EMPLOYES ###################################################-->
                <div class="scrollable">
                    <table class="table table-bordered table-striped text-center" >
                        <thead style="background-color: #00A652; color: #FFFFFF;">
                        
                            <th>Id </th>
                            <th>Nom </th>
                            <th>Prenom</th>
                            <th>Sexe</th>
                            <th>CIN</th>
                            <th>Enfant</th>
                            <th>Fonction</th>
                            <th>Service</th>
                            <th>Date d'engage</th>
                            <th>Modifier</th>
                            <th>Suprimer</th>
                            <th>Details</th>

                        </thead>


                        <tbody id="myTable">
                            <?php
                                    
        			             while($row = mysqli_fetch_array($result)){
        			             	?>
        			                    <tr>
        			                        
        			                        <td> <?php echo $row ['id_emp'];?></td>
        			                        <td><?php echo $row ['nom'];?></td>
        			                        <td><?php echo $row ['prenom'];?></td>
        			                        <td><?php echo $row ['sexe'];?></td>
        			                        <td><?php echo $row ['cin'];?></td>
        			                        <td><?php echo $row ['nbEnf'];?></td>
        			                        <td><?php echo $row ['nom_fonct'];?></td>
                                            <td><?php echo $row ['nom_srvc'];?></td>
        			                        <td><?php echo $row ['date_engage'];?></td>
        			                        <!--<td>
                                                <img src="<?php echo "image/".$row ['photo']; ?>" width="100px" alt="image"></td>
        			                        
        			                          <button type="button" class="btn btn-success editdata">Modifier</button>-->
                                            <td>
        			                          <button type="submit" class="btn btn-success" id="butnedit" data_id="<?php echo $row ['id_emp'];?>" ><span class="fa fa-edit"></span></button>
        			                        </td>
                                            <td>
                                                <button type="submit" class="btn btn-danger" id="btndelete" data-id="<?php echo $row ['id_emp'];?>" ><span class="fa fa-trash"></span></button>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-info" name="btnview" id="btnview" data-ide="<?php echo $row ['id_emp'];?>"><img src="image/detail.png" alt="view" width="20px"></span></button>
                                            </td>



        			                    </tr>
                            <?php
                                }

                             ?>
                       
                       <?php
                            mysqli_close($con);
                        ?>

                    </table>
                </div>

                <div class="card-footer">
                    <form action="pdf_list.php" method="POST" accept-charset="utf-8">
                        <button type="submit" name="btn_print" class="btn1">Imprimer</button>
                    </form>

                </div>
            </div>

             <?php
           
      if(isset($_GET["from_dat"]) && isset($_GET["to_dat"]))
        {
         
            $from_date = $_GET["from_dat"];
            $to_date = $_GET["to_dat"];

            echo $to_date;
        }
     ?>
    </main>
	

    <script type="text/javascript">
        const photo = document.getElementById("photo");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
        photo.addEventListener("change",function(){
            const file = this.files[0];

            if(file){
                const reader = new FileReader();

                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";

                reader.addEventListener("load", function(){
                    console.log(this);
                    previewImage.setAttribute("src",this.result);
                });

                reader.readAsDataURL(file);
            }
            else
            {
                previewDefaultText.style.display = null;
                previewiMAGE.style.display = null;
                previewImage.setAtribute("src","");
            }
        });

// ############### EDIT PHOTO PREVIEW ####################

        const ephoto = document.getElementById("ed_photo");
        const epreviewContainer = document.getElementById("eimagePreview");
        const epreviewImage = epreviewContainer.querySelector(".image-preview__image");
        const epreviewDefaultText = epreviewContainer.querySelector(".image-preview__default-text");
        ephoto.addEventListener("change",function(){
            const efile = this.files[0];

            if(efile){
                const ereader = new FileReader();

                epreviewDefaultText.style.display = "none";
                epreviewImage.style.display = "block";

                ereader.addEventListener("load", function(){
                    console.log(this);
                    epreviewImage.setAttribute("src",this.result);
                });

                ereader.readAsDataURL(efile);
            }
            else
            {
                epreviewDefaultText.style.display = null;
                previewiMAGE.style.display = null;
                epreviewImage.setAtribute("src","");
            }
        });


// ###########################################################
        $(document).ready(function(){
            $('#search').keyup(function() {
                /* Act on the event */
                search_table($(this).val());
            });
            function search_table(value)
            {
                $('#myTable tr').each(function()
                {
                    var found = 'false';
                    $(this).each(function()
                    {
                        if($(this).text().toUpperCase().indexOf(value.toUpperCase())>=0)
                        {
                            found = 'true';
                        }
                    });
                    if (found == 'true')
                    {
                        $(this).show();
                    }
                    else{
                        $(this).hide();
                    }
                });
            }

        });
    </script>
    
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>

</body>
</html>