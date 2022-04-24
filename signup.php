<?php
    include('connection.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion De Salaire</title>
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
    

        <div class="header">
                <h2>Nouveau Utilisateur</h2>
        </div>
            <form method="POST" action="signup.php">
               
            <?php include('errors.php');?>

                    <div class="input-box">
                        <i class="fa fa-envelope-o"></i>
                        <input type="text" name="username" placeholder="Nom d'utilisateur" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key"></i>
                        <input type="password" name="password" placeholder=" Mot de passe" value="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>" id="pass">
                        <span class="eye" onclick="myFunction()">
                          <i id ="hide1" class="fa fa-eye"></i>
                          <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key"></i>
                        <input type="password" name="password_2"  value="<?php if(isset($_POST['password_2'])) echo $_POST['password_2']; ?>" placeholder=" Confirm mot de passe " id="pass2">
                        <!--
                        <span class="eye" onclick="myFunctionSecond()">
                          <i id ="hide3" class="fa fa-eye"></i>
                          <i id="hide4" class="fa fa-eye-slash"></i>
                        </span>
                      -->
                    </div>
                    <div>
                        <label> Photo </label>
                        <input type="file" name="photo" id="photo" >
                    </div>
                    <div>
                        <button type="submit" name="creer" value="enregistrer" class="login-btn">Enregistrer</button>
                        
                    </div>
                    Vous avez deja un compte cliquez <a href="login.php">ici</a>
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

              function myFunctionSecond()
              {
                var a = document.getElementById("pass2");
                var b = document.getElementById("hide3");
                var c = document.getElementById("hide4");

                if(a.type === 'password_2')
                {
                  a.type = "text";
                  b.style.display = "block";
                  c.style.display = "none";
                }
                else
                {
                  a.type = "password_2";
                  b.style.display = "none";
                  c.style.display = "block";
                }
              }
            </script>
</body>
<footer>
</footer>