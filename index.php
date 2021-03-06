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

    <link rel="shortcut icon" type="image/jpg" href="image/listpt.png" width ="60px">
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
        .logout{
            float: right;
            margin-top: 80px;
        }
        .logout a{
            text-decoration: none;
        }
         

        .sidenav .active1{
            color: #0B5ED7;
            background-color: white;
            font-size: 15px;
        }
        
        .main{
            height: 500px;
            margin-left: 180px;
            background-image: url('image/Hopital1.JPG');
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .overlay
        {
            background: #000;
        }

        .main h5{
            padding-top: 150px;
        }
        /*   
        .home a{

            width: 40%;
            display: inline-block;
            margin: 0% 30%;
            padding: 20px 0px;
            text-align: center;
            font-family: arial;
            font-size: 16px;
            font-weight: bold;
            color: #060606;
            position: relative;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .home a:nth-child(1){
            background: red;
            border-radius: 15px;
        }
        .home a:nth-child(2){
            background: green;
            border-radius: 10px;
        }
        .home a:nth-child(3){
            background: blue;
            border-radius: 20px;
        }
        .home a:nth-child(4){
            background: yellow;
            border-radius: 10px;
        }

        .home a:hover {
            background-color: #ddd;
            color: black;
        }
        */
        .chu{
            color: #0ADD19;
            text-align: center;
        }
        #title{
            margin-left: 180px;
        }
        footer{
            background-color: #06EB2C;
            margin-left: 160px;
            height: 45px;
            text-align: center;
        }
        .fy{
            padding-top: 5px;
            color: #000000;
            text-align: right;
        }
    </style>

</head>
<body>  
   <?php
        require_once 'sidebar.php';
   ?> 
   


        <div class="logo">
            <div class="logo position-fixed"><img src="image/logos.png" alt="logoChuT" width="115px"></div>
        </div>
        <div class="card" id="title">
           <div class="card-header">
              <div class="row">
                
                <div class="col-md-2">
                    <!--
                    <br>
                     <?php               
                        date_default_timezone_set('Asia/Kolkata');
                        $currentTime = date( 'd/m/Y');
                        $currentTime1 = date( 'h:i:s A');
                        echo $currentTime;
                        echo '<br>';
                        echo $currentTime1;
                    ?>
                    -->
                </div>
            
                <div class="col-md-7">
                    <div class="chu">
                        <h6><b>MINISTERE DE LA SANTE PUBLIQUE
SECRETARIAT GENERAL <br>DIRECTION GENERALE DE FOURNITURE DES SOINS  <br>CENTRE HOSPITALIER UNIVERSITAIRE TAMBOHOBE FIANARANTSOA</b></h6>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="content">
                        <br>
                        <?php if(isset($_SESSION['success'])): ?>
                            <div class="error sucess">
                                <h3>
                                    <?php 
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        <?php if (isset($_SESSION["username"])); ?>
                            <p align="center" style="color: #04780C">Administrateur<br> <strong><?php echo $_SESSION["username"]; ?></strong></p>
                            
                    </div>

                    
                </div>
              </div>

   
            </div>
        </div>
        <br>

    <div class="main">
        <h5 style="text-align: center; color: white; font-size: 30px;"><b>Gestion de Pointage des Employes Main d'Oeuvre(EMO)</b></h5>    
        
    </div>
    <div class="overlay"></div>




</body>
<div class="fy"> Copyright (c) in 2021 by Fid??le RAZAFIMBAMALAZA</div>

</html>