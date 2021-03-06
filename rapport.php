<?php
    include ('connection.php');
     if(empty($_SESSION['username']))
    {
        header('location: login.php');
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
      input
      {
        width : 90%;
        height : 10%;
        border: 1px;
        border-radius: 5px;
        padding : 5px 15px 5px 15px;
        margin : 5px 10px 10px 0px;
        box-shadow : 1px 1px 2px 1px green;
      }
      .row {
        text-align: center;
        margin-left : 16%;
      }
      .sidenav .active6{
            color: #0B5ED7;
            background-color: white;
            font-size: 14px;
        }
         .card-header {
          background-color:#00A652;
        }
    </style>
</head>
<body>

<!--<!-- ############################### SIDE NAVBAR ###################################################-->
      
      <?php
        require_once 'sidebar.php';
      ?> 



        <div class="logo position-fixed">
            <div class="logo"><img src="image/logos.png" alt="logoChuT" width="115px"></div>
        </div>


<!--<!-- ############################### TITRE ###################################################-->
    <main class="main">

      <div class="card">
        <div class="card-header">
          <h4 align="center"><b style="color: white;">RAPPORT DE POINTAGE</b></h4>
        </div>

        <div class="card-body">
        
          <form action="" method="get" accept-charset="utf-8">
            <div class="row">
              <div class="col-md-3">
                <div class="form-goup">
                  <label for="dateDeb"><b style="color: #04780C"> Date de debut</b> </label>
                  <input type="date" name="from_dat" value="<?php if(isset($_GET["from_dat"])){echo $_GET["from_dat"];}else{} ?>"  class="form-control" placeholder="Date de debut">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="dateFin"><b style="color: #04780C"> Date fin </b> </label>
                  <input type="date" name="to_dat" value="<?php if(isset($_GET["to_dat"])){echo $_GET["to_dat"];}else{} ?>" class="form-control" placeholder="Jusqu'a ...">
                </div>
              </div>

              <div class="col-md-2">
              </br>
                <div>
                  <button type="submit" name="recherche" class="btn btn-success"><i class="fa fa-search"></i> Rechercher</button>
                </div>
              </div>
              <div class="col-md-2">
                </br>
                
              </div>
            </div>
                
          </form>

        </div>
      </div>
                    

 <!-- ############################### TABLEAU DE CONSULTATION DE POINTAGE ###################################################-->


      <?php
          if(isset($_GET["from_dat"]) && isset($_GET["to_dat"]))
          {
      ?>
      <div class="card md-3">
        <div class="card-body">
          <h6>Liste de tous les Pointages</h6>
          <br>
          <div class="scrollable2">
          <table class="table table-bordered table-striped tblPtgfx">
            <thead class="text-center">
              <tr style="background: #00A652; color: white;">
                  <th>Num Employe</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Nombre du Jour</th>
                  <th>Volume Horaire (H)</th>
                  
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
                  if(strtotime($_GET["from_dat"])<=strtotime($_GET["to_dat"]))
                  {
                    
                      $from_date = $_GET["from_dat"];
                      $to_date = $_GET["to_dat"];
                      $query = "SELECT id_emp,nom,prenom,sum(total_heure) as totalH,sum(present_matin) as pres_mat,sum(present_soir) as pres_soir FROM POINTAGE WHERE date_pt BETWEEN '$from_date' AND '$to_date' group by id_emp ";
                      $query_run = mysqli_query($con,$query);

                      if(mysqli_num_rows($query_run)>0)
                       {


                      foreach ($query_run as $row) 
                        {
                          $nb_jour = ($row['pres_mat']+$row['pres_soir'])/2;
                          ?>
                          <tr>
                              
                              <td><?php echo $row['id_emp']; ?></td>
                              <td><?php echo $row['nom']; ?></td>
                              <td><?php echo $row['prenom']; ?></td>
                              <td><?php echo $nb_jour; ?></td>
                              <td><?php echo $row['totalH']; ?></td>
                              
                          </tr>
                          <?php

                        }
                  }
                  else
                  {
                         ?>

                    <tr>
                      <td colspan="8"><b style="color=red;">Il n'y a pas d'employe !!</b></td>
                    </tr>
                    <?php

                  }

                }
                  else 
                  {
                ?>

                    <tr>
                      <td colspan="8"><b style="color=red;">La date de debut est plus grand que la date fin, SVP veuillez changer!!</b></td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
          </div>
        </div>
<!-- ############################### FORMULAIRE Nb de ###################################################-->
          <div class="card-footer">
             <form action="pdf_rapport.php" method="GET" accept-charset="utf-8">
               <?php
                  if(isset($_GET["from_dat"]) && isset($_GET["to_dat"]))
                  {
                    $dateD = $_GET["from_dat"];
                    $dateF = $_GET["to_dat"];
                ?>
             
              <input type="hidden" name="d_date" value="<?php echo $dateD; ?>">
              <input type="hidden" name="f_date" value="<?php echo $dateF; ?>">
              <div style="text-align: right;">
                <button type="submit" name="imprimer"  class="btn btn-primary" title="Imprimer le tableau"><img src="image/print.png" alt="search" width="30px"> Imprimer</button>
              </div>    
              <?php
            } 
            ?>
            </form>
          </div>

      </div>




    </main>



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
<br>
<footer>
    <div>
         
    </div>    
</footer>

</html>

