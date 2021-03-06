<?php
    include ('connection.php');
     // Si l'utilisateur n'a pas d compte il ne peut pas acces a cette page
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
        margin-left : 60px;
      }
      .sidenav .active5{
            color: #0B5ED7;
            background-color: white;
            font-size: 15px;
        }

        label {
        color: #04780C;
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
          <h4 align="center"><b style="color: #FFFFFF;">CONSULTATION DE POINTAGE</b></h4>
        </div>

        <div class="card-body">
        
          <form action="" method="get" accept-charset="utf-8">
            <div class="row">
              <div class="col-md-3">
                <div class="form-goup">
                  <label for="dateDeb"><b> Date de debut</b> </label>
                  <input type="date" name="from_date" value="<?php if(isset($_GET["from_date"])){echo $_GET["from_date"];}else{} ?>"  class="form-control" placeholder="Date de debut">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="dateFin"><b> Date fin </b> </label>
                  <input type="date" name="to_date" value="<?php if(isset($_GET["to_date"])){echo $_GET["to_date"];}else{} ?>" class="form-control" placeholder="Jusqu'a ...">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <div class="form-group text-center">
                    <label for="id_emp"><b>N?? et nom d'Employ?? :  </b></label>
                        
                        <select name="id" value="<?php if(isset($_POST["id"])){echo $_POST["id"];} ?>" class="form-control" id='id'>
                        <?php
                            $sql="SELECT id_emp,nom from EMPLOYE";
                            $result = mysqli_query($GLOBALS['con'],$sql);

                            if(mysqli_num_rows($result)>0){
                                while($rows= mysqli_fetch_assoc($result)){
                        ?>
                                <option><?php echo $rows["id_emp"].' '.$rows["nom"];?></option>
                        <?php
                                }
                               
                            }
                        ?>
                        </select>
                </div>
              </div>

              <div class="col-md-1">
              
                    <button type="submit" name="recherche" class="btn btn-info" title="Recherche d'un employe"><i class="fa fa-1x fa-search"></i></button>
              </div>
            </div>
                
          </form>

        </div>
      </div>
                    

 <!-- ############################### TABLEAU DE CONSULTATION DE POINTAGE ###################################################-->
    <?php
        if(isset($_GET["from_date"]) && isset($_GET["to_date"]) && isset($_GET["id"]))
    {
    ?>
      <div class="card md-3">
        <div class="card-body">
          <h6>Liste de Pointage</h6>
          <br>
          <div class="scrollable1">
          <table class="table table-bordered table-striped tblPtgfx">
            <thead class="text-center">
              <tr style="color: #FFFFFF; background-color: #00A652;">
                  <th>Date</th>
                  <th>Num Employe</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Matin</th>
                  <th>Soir</th>
                  <th>Total Heure(H)</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
                  if(strtotime($_GET["from_date"])<=strtotime($_GET["to_date"]))
                  {
                    
                      $idEmp = $_GET["id"];
                      $from_date = $_GET["from_date"];
                      $to_date = $_GET["to_date"];
                      $query = "SELECT * FROM POINTAGE WHERE id_emp='$idEmp' and date_pt BETWEEN '$from_date' AND '$to_date'";
                      $query_run = mysqli_query($con,$query);

                      if(mysqli_num_rows($query_run)>0)
                       {

                      foreach ($query_run as $row) 
                        {
                          //echo $row["nom"].", ";
                          ?>
                          <tr>
                              <td><?php echo $row['date_pt']; ?></td>
                              <td><?php echo $row['id_emp']; ?></td>
                              <td><?php echo $row['nom']; ?></td>
                              <td><?php echo $row['prenom']; ?></td>
                              <td><?php echo $row['present_matin']; ?></td>
                              <td><?php echo $row['present_soir']; ?></td>
                              <td><?php echo $row['total_heure']; ?></td>
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
            <?php
              if(isset($_GET["from_date"]) && isset($_GET["to_date"]) && isset($_GET["id"]))
                {
                  $dateD = $_GET["from_date"];
                  $dateF = $_GET["to_date"];
                  $a=$_GET["id"];

                  $query = "SELECT nom,prenom from pointage where id_emp='$a' AND date_pt BETWEEN '$from_date' AND '$to_date'";
                  $res = mysqli_query($con,$query);
                  if(mysqli_num_rows($res)>0)
                  {
                    if($rows = mysqli_fetch_assoc($res))
                    {
                    
                    ?>
                      <h6>RESULTAT de Pointage de <?php echo $rows["nom"]." ".$rows["prenom"]." du ". $dateD ." jusqu'au ".$dateF; ?></h6>
                    <?php
                    }
                  }
                }
            ?>
            
            <div class="jour">
                <form action="" method="post" accept-charset="utf-8">
                  <div class="row">
                    <div class="col-md-3">
                            <?php
                              if(isset($_GET["from_date"]) && isset($_GET["to_date"]) && isset($_GET["id"]))
                              {
                                $dateD = $_GET["from_date"];
                                $dateF = $_GET["to_date"];
                                $a=$_GET["id"];

                                $query = "SELECT COUNT(id_emp) as nbpresM from pointage where id_emp='$a' AND date_pt BETWEEN '$from_date' AND '$to_date' AND present_matin=1";
                                $res = mysqli_query($con,$query);
                                if(mysqli_num_rows($res)>0)
                                {
                                  while($rows = mysqli_fetch_assoc($res))
                                  {
                                    $nbM= $rows["nbpresM"];
                                    ?>
                                      <div class="form-control">                  
                                          <label for="nbMatin">Presence matin : </label>
                                          <?php echo $nbM." Matins"; ?>
                                      </div>
                                    <?php
                                  }
                                }
                                ?>
                    </div>
                    <div class="col-md-3">
                            <?php
                                $query2 = "SELECT SUM(present_soir) as nbpresS from pointage where id_emp='$a' AND date_pt BETWEEN '$from_date' AND '$to_date'";
                                $res = mysqli_query($con,$query2);
                                if(mysqli_num_rows($res)>0)
                                {
                                  while($rows = mysqli_fetch_assoc($res))
                                  {
                                    $nbS= $rows["nbpresS"];
                                    ?>
                                      <div class="form-control">                  
                                          <label for="nbSoir">Presence Soir : </label>
                                          <?php echo $nbS." Soir"; ?>
                                      </div>
                                    <?php
                                  }
                                }
                                ?>
                    </div>
                    <div class="col-md-3">
                              <?php
                                $total_jour = ($nbM+$nbS)/2;
                              ?>
                                <div class="form-control">                  
                                    <label for="totaljour">Total jour : </label>
                                    <?php echo $total_jour." Jours"; ?>
                                </div>
                              <?php
                              }
                            ?>
                    </div>

                    <div class="col-md-3">
                        <?php
                              if(isset($_GET["from_date"]) && isset($_GET["to_date"]) && isset($_GET["id"]))
                              {
                                $dateD = $_GET["from_date"];
                                $dateF = $_GET["to_date"];
                                $a=$_GET["id"];
                                $sql="SELECT sum(total_heure) as sommeH from POINTAGE where id_emp='$a' AND date_pt BETWEEN '$from_date' AND '$to_date'";
                                $result = mysqli_query($GLOBALS['con'],$sql);

                                if(mysqli_num_rows($result)>0){
                                      while ($rows=mysqli_fetch_assoc($result)) {
                                        ?>
                                          <div class="form-control">                  
                                            <label for="nbHeure">Volume Horaire : </label>
                                            <?php echo $rows["sommeH"]." H"; ?>
                                          </div>
                                   
                                <?php 
                                    }
                                }
                              }
                            ?>
                    </div>
                  </div>
                </form>
                
            </div>
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
<!--  STYLE DE TABLEAU

.table-fixed thead,
.table-fixed thead>th{
  background: #5CD09E;
  color: #000000;
}
.table-fixed tbody tr td{
  background: #B2F4AD;
}
.table-fixed>thead>tr>th{
  border: 0 !important;
}
.table-fixed>tbody>tr>td:last-child{
  border-right: 0;
}

.table-fixed tbody td,
.table-fixed thead>tr>th{
  float: left;
  font-size: 14px;

}

.table-fixed tbody{
  display: block;
  height: 300px;
  overflow-y: auto;
}

.table-fixed .col{
  width: 25%;
}
-->
</html>

