<?php
    include('connection.php');

    // Si l'utilisateur n'a pas d compte il ne peut pas acces a cette page
    if(empty($_SESSION['username']))
    {
        header('location: login.php');
    }
      // Requette pour l'affichage de data au tableau
  
     if(isset($_POST['inserer'])){
       addFonction();
       
    }

    if(isset($_POST['addServ'])){
       addService_fonct();
       
    }

    

    function addFonction(){
        $nomFonct= $_POST['nomFonct'];
        if($nomFonct){
            $sql="INSERT INTO FONCTION (nom_fonct) VALUES('$nomFonct')";
            if(mysqli_query($GLOBALS['con'],$sql)){
                echo "Success!!";
            }else
            {
                echo "echec";
            }
        }
        else{
            echo "Probleme de sql";
        }
    }



    function addService_fonct(){
        $fonct = $_POST['fonct'];
        $nomServ= $_POST['srvc'];

        if($nomServ && $fonct ){

            $query = "SELECT num_serv from service where nom_serv='$nomServ'";
            $res = mysqli_query($GLOBALS['con'],$query);

            $quer = "SELECT id_fonct from fonction where nom_fonct='$fonct'";
            $resul = mysqli_query($GLOBALS['con'],$quer);

            while($row = mysqli_fetch_array($res))
            {
              $numServ = $row['num_serv'];
            }
             while($data = mysqli_fetch_assoc($resul))
            {
              $idFonct = $data['id_fonct'];
            }


            $req = "SELECT * from service_fonction";
            $result = mysqli_query($GLOBALS['con'],$req);

            while($datarow = mysqli_fetch_array($result))
            {
              $a = $datarow['id_fonct'];
              $b = $datarow['num_serv'];
            }

            if($numServ == $b && $idFonct == $a)
            {
              echo 'Deja existe!!';
            }
            else
            {

              $sql="INSERT INTO service_fonction (id_fonct,num_serv) VALUES('$idFonct','$numServ')";
              if(mysqli_query($GLOBALS['con'],$sql)){
                  echo "Insertion reussie!!";
              }else
              {
                  echo "Erreur d'insertion!!";
              }
            }

            
        }
        else{
            echo "Probleme de sql";
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
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    

    <script src="assets/vendor/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="assets/js/myjs.js"> </script>

    <style type="text/css">
      .scrollTab{
        height: 400px;
        overflow: scroll;
      }
      .sidenav .active2{
            color: #0B5ED7;
            background-color: white;
            font-size: 15px;
        }
        .card-header {
          background-color:#00A652;
        }
    </style>

</head>
<body>
  
    <!-- NAVBAR-->
        <?php
            require_once 'sidebar.php';
        ?> 



        <div class="logo position-fixed">
            <div class="logo"><img src="image/logos.png" alt="logoChuT" width="115px"></div>
        </div>


    <div class="main">

        <div class="card">
            <div class="card-header">
                <h4 align="center" style="color: white;">LISTE DES SERVICES ET LES FONCTION EXISTANT</h4>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-7">
                    
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addService_fonct" title="Ajouter nouvelle service">Insertion de service</button> </br>
                    
                    </div>

                    <div class="col-md-4">
                        <form method="POST" action="">
                            <input type="text" placeholder="Saisissez votre recherche ici ..." name="search" id="search" class="form-control">
                        </form>
                          
                    </div>
              </div>
<br>
              
              <p id="delete-message"></p>
                    <h6 align="center"><b> Liste des services avec les fonctions existants</b></h6>
                      <div class="scrollTab">
                          <table class="table table-bordered table-striped tabServ">
                              <thead class="text-center" style="background-color: #00A652; color: #FFFFFF;">
                                  <tr>
                                      <th>Numero</th>
                                      <th>Code service</th>
                                      <th>Service</th>
                                      <th>Fonction</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody class="text-center" id="myTable">
                               <?php
                                    $sql = "SELECT auto,service.code_srvc,service.nom_serv,fonction.nom_fonct FROM service,fonction,service_fonction WHERE service.num_serv=service_fonction.num_serv and fonction.id_fonct=service_fonction.id_fonct order by service.nom_serv";
                                    $res = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <td><?php echo $row['auto'] ?></td>
                                    <td><?php echo $row['code_srvc'] ?></td>
                                    <td><?php echo $row['nom_serv'] ?></td>
                                    <td><?php echo $row['nom_fonct']?></td>
                                    <td>
                                        <button class="btn btn-danger" id="delete_serv" data-id="<?php echo $row ['auto'];?>" ><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                                <?php
                            }
                                ?>
                              </tbody>
                          </table>
                      </div>

            </div>

        </div>
    </div>

<!-- ############################### FORMULAIRE D'INSERTION FONCTION ##################################-->
         
                <div class="modal fade" id="addFonction" tabindex="-1" aria-labelledby="addFonction" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFonction">Nouvelle Fonction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="">
                                        <label> Nom fonction : </label><input type="text" name="nomFonct" required /><br />
                                </div>

                                <div class="footer">
                                    <button name="inserer" class="btn btn-primary">Inserer</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>



  <!-- ########################## FORMULAIRE D'INSERTION SERVICE ##########################-->
         
                <div class="modal fade" id="addService" tabindex="-1" aria-labelledby="addService" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFonction">Insertion de service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="employes.php">
                                        <label> Code service : </label><input type="text" name="codeServ" required /><br />
                                        <label> Nom service : </label><input type="text" name="nomServ" required /><br />
                                </div>

                                <div class="footer">
                                    <button name="addServ" class="btn btn-primary">Ajouter</button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>



  <!-- ########################## FORMULAIRE D'INSERTION SERVICE/fonction ##########################-->
         
                <div class="modal fade" id="addService_fonct" tabindex="-1" aria-labelledby="addFonction" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addFonction">Insertion de service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" action="services.php">
                                          <?php
                                            $sql = "SELECT nom_fonct from fonction";
                                            $res = mysqli_query($con,$sql);

                                            $query = "SELECT nom_serv from service";
                                            $result = mysqli_query($con,$query);
                                          ?>
                                        <label> Fonction : </label>
                                        <select name="fonct" class="form-control">
                                          <?php
                                            while($row = mysqli_fetch_assoc($res))
                                            {
                                          ?>
                                              <option><?php echo $row["nom_fonct"]; ?></option>
                                          <?php
                                           }
                                           ?>
                                       </select>
                                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFonction" title="Ajouter nouvelle fonction">+</button>
                                          <br/>

                                          <label> Service : </label>
                                        <select name="srvc" class="form-control">
                                          <?php
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                          ?>
                                              <option><?php echo $row["nom_serv"]; ?></option>
                                          <?php
                                           }
                                           ?>
                                       </select><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addService" title="Ajouter nouvelle service">+</button>
                                        
                                </div>

                                <div class="footer">
                                    <button name="addServ" class="btn btn-primary">Ajouter</button>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>



<!-- ############################### FORMULAIRE DELETE MODAL ###################################################-->

    <div class="modal fade" id="delete_srvc" tabindex="-5" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModal">Suppression des services</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voullez vouz vraiment supprimer cetle service??</p>
                                <button type="button" class="btn btn-danger" id="dlt_srvc">Oui</button>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Non</button>
                            
                        </div>
                    
                    </div>
                </div>
            </div>

<script type="text/javascript">
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


            //  SUPRESSION DE SERVICE/FONCTION 

      $(document).on('click','#delete_serv',function()
        {
          var num_srvc= $(this).attr('data-id');
          $('#delete_srvc').modal('show');

          $(document).on('click','#dlt_srvc',function()
          {

            $.ajax({
              url: 'delete_service.php',
              type: 'POST',
              data: {num: num_srvc},
              success: function(data)
              {
                $('#delete-message').html(data).hide(20000);
                $('#delete_srvc').modal('hide');
                $(document).load(function() {
                  /* Act on the event */
                });

              }
          
            })

        })
  })
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