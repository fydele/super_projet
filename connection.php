<?php

    session_start();
    $dbhost= "localhost";
    $dbuser= "root";
    $dbpass= "";
    $dbname= "gestionpointage";
    $errors= array();

    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(isset($_POST['creer'])){
        $username= $_POST['username'];
        $password= $_POST['password'];
        $password_2= $_POST['password_2'];
        $photo= $_POST['photo'];
    
        if(empty($username)){
            array_push($errors,"Veuillez entrez le nom");
        }
        if(empty($password)){
            array_push($errors,"Veuillez entrez le mot de passe");
        }
        if($password != $password_2){
            array_push($errors,"Ces mots de passe ne sont pas pareil, verifiez,SVP!!");
        }

        if(count($errors)==0){
            //$password = md5($password_2); //Encript password before storing in db (security)
            $query="INSERT INTO USER (username,userpass,photo) VALUES('$username','$password','$photo')";
            mysqli_query($con,$query);

            
        }
    }

    if(isset($_POST['login']))
    {
        $username= $_POST['name'];
        $password= $_POST['mdp'];
    
        if(empty($username)){
            array_push($errors,"Veuillez entrez le nom");
        }
        if(empty($password)){
            array_push($errors,"Veuillez entrez le mot de passe");
        }

        if(count($errors)==0){
             $password1 = md5($password);
            $sql="SELECT * FROM USER WHERE username='$username' AND userpass='$password'";
            $resultat= mysqli_query($con,$sql);
            if(mysqli_num_rows($resultat)==1){
                $_SESSION['username'] = $username;
                header('location: index.php');

            }else{
                array_push($errors,"Nom Invalide ou Mot de passe incorrecte");
            }
        }
    }

    // logout
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }


?>