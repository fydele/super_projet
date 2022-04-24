
	<div class="card-body">
        <div class="scrollablePtg">
          
              
            <table class="table table-bordered table-striped ">
              <h6 align="center" >TABLEAU DE POINTAGE</h6>
              <thead class="text-center" style="background-color: #00A652; color: #FFFFFF;">
                <tr>
                  <th class="col" >No</th>
                  <th class="col" >Date</th>
                  <th class="col" >No Emp</th>
                  <th class="col" >Nom</th>
                  <th class="col" >Prenom</th>
                  <th class="col" >Matin</th>
                  <th class="col" >M.Entree</th>
                  <th class="col" >M.Sortie</th>
                  <th class="col" >Soir</th>
                  <th class="col" >S.Entree</th>
                  <th class="col" >S.Sortie</th>
                  <th class="col" >T. Heure</th>
                  <th class="col" >Action</th>
                </tr>
              </thead>
              <tbody class="text-center" id="my_table">
                <?php
                            
                    while($row = mysqli_fetch_array($res)){
                ?>

                <tr>
                  <td class="colD" ><?php echo $row['num_auto']; ?></td>
                  <td class="colD" ><?php echo $row['date_pt']; ?></td>
                  <td class="colD" ><?php echo $row['id_emp']; ?></td>
                  <td class="colD" ><?php echo $row['nom']; ?></td>
                  <td class="colD" ><?php echo $row['prenom']; ?></td>
                  <td class="colD" ><?php echo $row['present_matin']; ?></td>
                  <td class="colD" ><?php echo $row['mat_heure_entre']; ?></td>
                  <td class="colD" ><?php echo $row['mat_heure_sorti']; ?></td>
                  <td class="colD" ><?php echo $row['present_soir']; ?></td>
                  <td class="colD" ><?php echo $row['soir_heure_entre']; ?></td>
                  <td class="colD" ><?php echo $row['soir_heure_sorti']; ?></td>
                  <td class="colD" ><?php echo $row['total_heure']; ?></td>
                  <td class="colD" >
                      <button type="submit" class="btn btn-success" id="btn_edit" data-num="<?php echo $row ['num_auto'];?>" ><span class="fa fa-edit"></span></button>
                      <button class="btn btn-danger" id="btn_delete" data-num="<?php echo $row ['num_auto'];?>" ><span class="fa fa-trash"></span></button>
                    </td>
                  
                </tr>
            <?php
                }
            ?>
              </tbody>
            </table>
        </div>
        </div>