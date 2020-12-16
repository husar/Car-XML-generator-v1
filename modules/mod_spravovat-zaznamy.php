<div class="page-content">
<?php
    
include "functions.php";    

?>
<br>
<br>
 
<?php include "includes/edit_car.php" ?>

 <div class="portlet box blue">
                                                                
    <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-search"></i> Vyhľadávanie
											</div>
                                      
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form" method="post" >
                                            <div class="form-body">
                                                <div class="form-group">
                                                    
                                                    <input type="hidden" name="modul" value="spravovat-zaznamy">	
													
                                                    <div class="col-md-2">
                                                    <?php
                                                    $query_zaznamy="SELECT * FROM cd";
												    $apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												    ?>
                                                    Vybrať CD:
                                                    <select name="cd_id" class="form-control">
                                                        <option value=""></option>
                                                        <?php while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){?>
                                                        <option value="<?php echo $result_zaznamy['cd_id'] ?>" <?php echo ($skupina ==$result_zaznamy['cd_name'])? 'selected':'' ?>><?php echo $result_zaznamy['cd_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="search">Vyhľadať</button>
                                            </div>
        
                                        </form>
                                    </div>
                                    
                                   
                                    
                                </div>
                                                                 
                               <!-- //****************//
                                    //*Bez*parametrov*//
                                    //****************//   -->
                                    <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-tasks"></i> Záznamy</div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            </div>
                                        </div>     
                                    <div class="portlet-body">
									                                         <div class="table-responsive">
									       <?php 
                                                                                 
                                                deleteCar();
                                                                                                                                                
                                            ?>
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>ID</th>
														  <th>Značka auta</th>
														  <th>Model auta</th>
                                                          <th>7pin</th>
                                                          <th>13pin</th>
                                                          <th>Poradie</th>
                                                          <th>Odobrať z CD</th>
                                                          <th>Pridať na CD</th>
                                                          <th>Funkcie</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php						
				
                                                if(isset($_POST['search']) && $_POST['cd_id']!=""){
                                                   
                                                    $query_zaznamy="SELECT * FROM cars INNER JOIN cd_cars ON cars.car_id = cd_cars.car_id WHERE cd_id =".$_POST['cd_id']." ORDER BY car_order";
                                                    
                                                }else{
                                                    
                                                    $query_zaznamy="SELECT * FROM cars ORDER BY car_order";
                                                    
                                                }  
                                                    
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
														<td> <?php echo $result_zaznamy['car_id']; ?></td>
														<td> <?php echo $result_zaznamy['car_brand'];?></td>
														<td> <?php echo $result_zaznamy['car_model']; ?></td>
														<td> <?php echo $result_zaznamy['7_pin']; ?></td>
														<td> <?php echo $result_zaznamy['13_pin']; ?></td>
														<td> <?php echo $result_zaznamy['car_order']; ?></td>
                                                       
                                                           <?php
                                                                
                                                                $cds = "";
                                                                $query = "SELECT * FROM cd INNER JOIN cd_cars ON cd.cd_id = cd_cars.cd_id WHERE car_id =".$result_zaznamy['car_id']." ";
                                                                $selected_cds = mysqli_query($connect, $query);
                                                                while($row = mysqli_fetch_array($selected_cds)){
                                                                    
                                                                    $cds .= $row['cd_name'].", ";
                                                                    
                                                                }
                                                    
                                                            ?>
                                                       
                                                        <td><?php echo $cds; ?></td>
                                                        <td></td>
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="car_id" value="<?php echo $result_zaznamy['car_id'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-zaznamy&car_idFD=<?php echo $result_zaznamy['car_id'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" title="Upraviť záznam" formaction="index.php?modul=spravovat-zaznamy&edit_car_id=<?php echo $result_zaznamy['car_id'] ?>"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            
                                                        </td>
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											
                                        </div>                                       
									
                                      
                                        <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="generateXML" onclick="location.href='index.php?modul=spravovat-zaznamy&action=generateXML&cd_id=<?php echo $_POST['cd_id'] ?>'">Generovať XML</button>

                                       
                                      <?php include "includes/generate_xml.php"; ?>
                                   
                                    </div>
                                </div>
						
 </div>
 
 <?php if(isset($_GET['car_idFD'])){ ?>
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete odstrániť záznam č. <?php echo $_GET['car_idFD'] ?> zo systému?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="car_id" value="<?php echo $_GET['car_idFD'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=spravovat-zaznamy">Zrušiť</button>
                    <button type="submit" name="delete" class="btn btn-primary" formaction="index.php?modul=spravovat-zaznamy">Vymazať</button>
                </form>
          </div>
    </div>
  </div>
</div>
<?php } ?>
 <script type="text/javascript">
$(document).ready(function(){
    $('.modal').modal('show');
});
</script>


<?php if(isset($_POST['update_record'])){ ?>
 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Chcete uložiť vykonané zmeny?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="car_id" value="<?php echo $_POST['car_id'] ?>">
                    <input type="hidden" name="car_brand" value="<?php echo $_POST['car_brand'] ?>">
                    <input type="hidden" name="car_model" value="<?php echo $_POST['car_model'] ?>">
                    <input type="hidden" name="7_pin" value="<?php echo $_POST['7_pin'] ?>">
                    <input type="hidden" name="13_pin" value="<?php echo $_POST['13_pin'] ?>">
                    <input type="hidden" name="car_order" value="<?php echo $_POST['car_order'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='index.php?modul=spravovat-zaznamy'">Zrušiť</button>
                    <button type="submit" name="editCar" class="btn btn-primary">Prepísať</button>
                </form>
          </div>
    </div>
  </div>
 
</div>
<?php } ?>