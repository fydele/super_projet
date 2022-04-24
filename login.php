<?php
    include("connection.php");
    include("function/function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion De Pointage</title>

    <style type="text/css" media="screen">
      .ch{
        width: 58%;
        margin: 0px auto;
        padding: 23px;
        border: 1px solid yellow;
        background: rgba(10, 0, 0, 0.8);
        border-radius: 0px 0px 10px 10px;
        color: rgb(29, 199, 100);

      
      }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authentification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/venobox/venobox.css" rel="stylesheet">
  <link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
  <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="styleLog.css" rel="stylesheet">
</head>
<body>
    
        <div><h3 class="ch"> CENTRE HOSPITALIER UNIVERSITAIRE TAMBOHOBE FIANARANTSOA </h3></div>
       
        <div class="header">
                <h2>AUTHENTIFICATION</h2>
        </div>
            <form method="POST" action="login.php" class="" enctype="">
                    <h6 align="center"> Administrateur <br><br> <b>Gestion de pointage des E.M.O </b></h6>
            <?php include('errors.php');?>
                    <div class="input-box">
                          <i class="fa fa-envelope-o"></i>
                        <input type="text" name="name" class="form-central" placeholder="Nom d'administrateur" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key"></i>
                        <input type=password name="mdp" placeholder=" Mot de passe" value="<?php if(isset($_POST['mdp'])) echo $_POST['mdp']; ?>" id="pass">
                        <span class="eye" onclick="myFunction()">
                          <i id ="hide1" class="fa fa-eye"></i>
                          <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <div >
                        <button type="submit" name="login" value="login" class="login-btn">Connecter</button>
                        
                    </div>
                    <p align="center"> Nouveau administrateur, <a href="signup.php">creer.</a></p>
            </form>

            <script type="text/javascript">
              function myFunction()
              {
                var x = document.getElementById("pass");
                var y = document.getElementById("hide1");
                var z = document.getElementById("hide2");

                if(x.type === 'password')
                {
                  x.type = "text";
                  y.style.display = "block";
                  z.style.display = "none";
                }
                else
                {
                  x.type = "password";
                  y.style.display = "none";
                  z.style.display = "block";
                }
              }
            </script>

</body>
<footer>
</footer>
        