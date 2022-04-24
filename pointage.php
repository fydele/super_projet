<?php
    include('connection.php');
    
    $res = mysqli_query($GLOBALS['con'], "SELECT * FROM pointage");
    // Si l'utilisateur n'a pas d compte il ne peut pas acces a cette page
    if(empty($_SESSION['username']))
    {
        header('location: login.php');
    }
      // Requette pour l'affichage de data au tableau
  
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
       /* label{
            display: block;
            width: 100px;
            float: left;
        }*/
      .inp
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
      }

      .sidenav .active4{
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
  
    
    <?php
        require_once 'sidebar.php';
   ?> 


        <div class="logo">
            <div class="logo position-fixed"><img src="image/logos.png" alt="logoChuT" width="115px"></div>
        </div>
<!-- NAVBAR 
        <script type="text/javascript">
          function message(formpt)
          {
          var m_entre = $('#m_entre').val();
          var m_sortie = $('#m_sortie').val();
          
            if (formpt.abs_mat[0].checked && m_entre == "" && m_sortie == "") 
            {
              
              $('#alert').modal('show');

            }
            if (formpt.abs_soir[0].checked && s_entre == "" && s_sortie == "") 
            {
              confirm("Veuiller remplir l'heure entree et sortie soir");
            }
          
          }
        </script>
  -->
       

<div class="main">

 <div class="modal fade" id="alert" tabindex="-5" aria-labelledby="alertModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="deleteModal">Suppression des employes</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>Veuiller remplir l'heure entree et sortie matin</p>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  
              </div>
          
          </div>
      </div>
  </div>

    <div class="card">
        <div class="card-header">
            <h4 align="center" style="color: #FFFFFF;">FORMULAIRE DE POINTAGE</h4>
        </div>
        <div class="card-body">
          <form name = "formpt" action="pointage.php" method="POST" id="insert_form">  
            <p id="newpt-message" class="text-dark"></p>
            <div class="row">
            
                <div class="col-md-3">
                  
                    <div class="form-control">
                       <b style="color: #04780C">Nom : </b>
                          <select name="id" value="<?php if(isset($_POST["id"])){echo $_POST["id"];} ?>" class="inp" id='num_emp'>
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

                          <label for="date_pt"><b style="color: #04780C"> Date de pointage : </b></label>
                                <input type="date" name="date_pt" value="<?php if(isset($_POST['date_pt'])){ echo $_POST['date_pt'];} else{}?>" class="inp" id="date_ptg"><br>
                    </div>
                  
                </div>
                <div class="col-md-3"> 
                   
                        <div class="matin">
                            <div class="form-control">
                                <h5 style="color: #04780C">MATIN</h5>
                                <div class="rdbt">
                                  <label for="pres"><b style="color: #04780C">Presence : </b></label>
                                    <input type="radio" name="abs_mat" id="abs_m" value="1">  Present 
                                    <input type="radio" name="abs_mat" id="abs_m" value="0" checked>  Absent  
                                </div>

                                <input type="text" name="h_entr_mat" placeholder="Heure d'entrée" class="inp" id="m_entre" value="<?php if(isset($_POST['h_entr_mat'])){ echo $_POST['h_entr_mat'];} else{}?>">
                                <input type="text" name="h_sort_mat" placeholder="Heure de sortie" class="inp"  id="m_sortie" value="<?php if(isset($_POST['h_sort_mat'])){ echo $_POST['h_sort_mat'];} else{}?>">                                
                            </div>
                        </div>
                       
                </div>

                <div class="col-md-3"> 
              
                        <div class="soir">
                            <div class="form-control">
                                <h5 style="color: #04780C"> SOIR</h5>
                                
                                <div class="rdbt">
                                  <label for="pres"><b style="color: #04780C">Presence :</b></label>
                                    <input type="radio" name="abs_soir" id="abs_soir" value="1">  Present
                                    <input type="radio" name="abs_soir" id="abs_soir" value="0" checked>  Absent 
                                </div>
   
                                <input type="text" name="h_entr_soir" placeholder="Heure d'entrée" class="inp" id="s_entre" value="<?php if(isset($_POST['h_entr_soir'])){ echo $_POST['h_entr_soir'];} else{}?>">
                                <input type="text" name="h_sort_soir" placeholder="Heure de sortie" class="inp" id="s_sortie" value="<?php if(isset($_POST['h_sort_soir'])){ echo $_POST['h_sort_soir'];} else{}?>">                                
                                
                            </div>
                            
                        </div>
                               
                </div>
              
                <div class="col-md-3"> 

                      <input type="hidden" name="num" id="num">
                          
                      <input type="submit" id="valider" name="valider" class="btn-success" value="Valider"/>
                    </br></br>

                    <input type="text" placeholder="Recherche des pointages..." name="search" id="search" class="form-control">
                    </br>
                    <h6 style="color: #7AABCA">
                      1 = Present</br>
                      0 = Absent
                    </h6>
                    
                </div>
               
            </div>
            </form>
        </div>
    </div>


    <!--<!-- ############################### FORMULAIRE UPDATE MODAL##########################################-->

            <div class="modal fade" id="updateptg" tabindex="-5" aria-labelledby="updateModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModal">Modification des pointage</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form name = "formptg" action="pointage.php" method="POST" id="up_form">  
                                    <p id="up_message" class="bg-success text-white text-center""></p>
                                    <div class="row">
                                    
                                        <div class="col-md-4">
                                          <br>
                                            <div class="form-control">
                                               N et Nom :
                                                  <select name="id" value="<?php if(isset($_POST["id"])){echo $_POST["id"];} ?>" class="inp" id='num_emp1'>
                                                  <?php
                                                      $sql="SELECT id_emp,nom from EMPLOYE";
                                                      $result = mysqli_query($GLOBALS['con'],$sql);

                                                      if(mysqli_num_rows($result)>0){
                                                          while($rows= mysqli_fetch_assoc($result)){
                                                  ?>
                                                          <option><?php echo $rows["id_emp"].'  '.$rows["nom"];?></option>
                                                  <?php
                                                          }
                                                         
                                                      }
                                                  ?>
                                                  </select>

                                                  <label for="date_pt"> Date de pointage :</label>
                                                        <input type="date" name="date_pt" value="<?php if(isset($_POST['date_pt'])){ echo $_POST['date_pt'];} else{}?>" class="inp" id="date_ptg1"><br>
                                            </div>
                                          
                                        </div>
                                        <div class="col-md-4"> 
                                           
                                                <div class="matin">
                                                    <div class="form-control">
                                                        <h5 >MATIN</h5>
                                                        <div class="rdbt">
                                                          <label for="pres"><b>Presence : </b></label> <br>
                                                            <input type="radio" name="abs_mat" id="abs_m1" value="1">  Present 
                                                            <input type="radio" name="abs_mat" id="abs_m1" value="0" checked>  Absent  
                                                        </div>

                                                        <input type="text" name="h_entr_mat" placeholder="Heure d'entrée" class="inp" id="m_entre1" value="<?php if(isset($_POST['h_entr_mat'])){ echo $_POST['h_entr_mat'];} else{}?>">
                                                        <input type="text" name="h_sort_mat" placeholder="Heure de sortie" class="inp"  id="m_sortie1" value="<?php if(isset($_POST['h_sort_mat'])){ echo $_POST['h_sort_mat'];} else{}?>">                                
                                                    </div>
                                                </div>
                                               
                                        </div>

                                        <div class="col-md-4"> 
                                      
                                                <div class="soir">
                                                    <div class="form-control">
                                                        <h5 > SOIR</h5>
                                                        
                                                        <div class="rdbt">
                                                          <label for="pres"><b>Presence :</b></label><br>
                                                            <input type="radio" name="abs_soir" id="abs_soir1" value="1">  Present
                                                            <input type="radio" name="abs_soir" id="abs_soir" value="0" checked>  Absent 
                                                        </div>
                           
                                                        <input type="text" name="h_entr_soir" placeholder="Heure d'entrée" class="inp" id="s_entre1" value="<?php if(isset($_POST['h_entr_soir'])){ echo $_POST['h_entr_soir'];} else{}?>">
                                                        <input type="text" name="h_sort_soir" placeholder="Heure de sortie" class="inp" id="s_sortie1" value="<?php if(isset($_POST['h_sort_soir'])){ echo $_POST['h_sort_soir'];} else{}?>">                                
                                                        
                                                    </div>
                                                    
                                                </div>
                                                       
                                        </div>
                                      
                                        <div class="col-md-2"> 
                                      
                                              <br><br> <br>
                                              <input type="hidden" name="num" id="num1">
                                              <input type="button" id="edit" name="edit" class="btn-success" value="Modifier"/>
                                       
                                        </div>
                                       
                                    </div>
                                    </form>
                                    
                                </div>
                            
                            </div>
                        </div>
                </div>

 <!--ADD POINTAGE-->

<script type="text/javascript">
  $(document).ready(function()
  {
   
    $('#insert_form').on("submit", function(event)
    {
      event.preventDefault();
      if(formpt.abs_mat[0].checked && $('#m_entre').val()=="" )
      {
        alert("Vous etes present ce matin donc veuiller remplir l'heure entree SVP!!");
      }
      else if($('#date_ptg').val()=="")
      {
        alert("Entrez le date du pointage!");
      }
      else if(formpt.abs_mat[0].checked && $('#m_sortie').val()=="")
      {
        alert("Vous etes present ce matin donc veuiller entrez l'heure sortie  SVP!!");
      }
      else if(formpt.abs_mat[1].checked && $('#m_sortie').val()!=="")
      {
        alert("Apueyez le present matin!");
      }
      else if(formpt.abs_mat[1].checked && $('#m_entre').val()!=="" )
      {
        alert("Apueyez le present matin!");
      }

      else if(formpt.abs_soir[0].checked && $('#s_sortie').val()=="")
      {
        alert("Vous etes present ce soir donc veuiller entrez l'heure sortie  SVP!!");
      }
      else if(formpt.abs_soir[0].checked && $('#s_sortie').val()=="")
      {
        alert("Vous etes present ce soir donc veuiller entrez l'heure sortie  SVP!!");
      }
      else if(formpt.abs_soir[1].checked && $('#s_entre').val()!=="" )
      {
        alert("Apueyez le present soir!");
      }
      else if(formpt.abs_soir[1].checked && $('#s_sortie').val()!=="" )
      {
        alert("Apueyez le present soir!");
      }
      else
      {
        $.ajax(
        {
          url: "valide_ptg.php",
          method: "POST",
          data : $('#insert_form').serialize(),
          beforeSend: function()
          {
            $('#valider').val("Validation");
          },
          sucess : function(data)
          {
            $('#newpt-message').html(data).hide(20000);
            $('#insert_form')[0].reset();
            
          }
        });
        alert("Enregistre!");
      }
    });

    // Button get value ptg
    $(document).on('click','#btn_edit',function()
    {
      $('#updateptg').modal('show');
      var num = $(this).attr('data-num');
      $.ajax(
      {
        url: 'get_ptg.php',
        type: 'POST',
        data: {num_ptg:num},
        dataType: 'JSON',
        success: function(data)
      {  
        $('#num1').val(data[0]);
        $('#date_ptg1').val(data[1]);
        $('#num_emp1').val(data[2]);
        $('#abs_m1').val(data[3]);

        //$('#abs_m').is("checked");

        $('#m_entre1').val(data[4]);
        $('#m_sortie1').val(data[5]);
        $('#abs_soir1').val(data[6]);
        $('#s_entre1').val(data[7]);
        $('#s_sortie1').val(data[8]);

      }
    })
    })

    // Update pointage 

    $(document).on('click','#edit',function()
  {
    var upN = $('#num1').val();
    var upD = $('#date_ptg1').val();
    var upNum = $('#num_emp1').val();
    var upM = $('#abs_m1').val();
    var upEm = $('#m_entre1').val();
    var upSm = $('#m_sortie1').val();
    var upS = $('#abs_soir1').val();
    var upEs = $('#s_entre1').val();
    var upSs = $('#s_sortie1').val();
    

    if(upD=="" || upNum=="")
    {
      $('#up_message').html('SVP, Veuillez remplir le champ de date!!');
      $('#updateptg').modal('show');
    }

    else{
      $.ajax(
      {
        url:'update_ptg.php',
        method: 'post',
        data:{E_nauto:upN,E_date:upD,E_num:upNum,E_matin:upM,E_em:upEm,E_sm:upSm,E_soir:upS,E_es:upEs,E_ss:upSs},
        success: function(data)
        {
          $('#up_message').html(data);
          $('#updateptg').modal('show');
          $('form').trigger('reset');
      
        }
      })
    }
    
  })

  });

// ##################### RECHERCHE DE POINTAGE #######################

  $(document).ready(function(){
            $('#search').keyup(function() {
                /* Act on the event */
                search_table($(this).val());
            });
            function search_table(value)
            {
                $('#my_table tr').each(function()
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
<!--<!-- ############################### FORMULAIRE DELETE MODAL ###################################################-->

    <div class="modal fade" id="deletept" tabindex="-5" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModal">Suppression des pointages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voullez vouz vraiment supprimer cet pointage???</p>
                                <button type="button" class="btn btn-success" id="delete_pt">Supprimer</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Retour</button>
                            
                        </div>
                    
                    </div>
                </div>
            </div>

<p id="delete-message" class="text-dark"></p>

<!-- ############################### TABLEAU DE POINTAGE ###################################################-->
      <?php
      include('tableau_ptg.php');
      ?>

</div>


    
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