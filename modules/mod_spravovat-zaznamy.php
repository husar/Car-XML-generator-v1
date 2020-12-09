<div class="page-content">
<?php
    
include "functions.php";    

?>
<br>
<br>
 
<?php
     
                                        if(isset($_GET['edit_car_id'])){
                                            
                                            echo "<div class=\"portlet box blue\">";
                                            
                                            $query = "SELECT * FROM cars WHERE car_id = ".$_GET['edit_car_id'];
                                            $selected_car_edit = mysqli_query($connect,$query);
                                            
                                            while($row = mysqli_fetch_assoc($selected_car_edit)){
                                                
                                                $car_id = $row['car_id'];
                                                $car_brand = $row['car_brand'];
                                                $car_model = $row['car_model'];
                                                $seven_pin = $row['7_pin'];
                                                $thirteen_pin = $row['13_pin'];
                                                $car_order = $row['car_order'];
                                                    
                                            }
                                            
                                    ?>
                                                    
                                              <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-calendar"></i> <?php echo $car_brand." ".$car_model ?></div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            </div>
                                        </div>     
                                    <div class="portlet-body">
                                        <div class="portlet-body">
									          <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                                    	
													<input class="form-control" size="16" type="hidden" name="car_id" value="<?php echo $car_id?>">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Značka auta</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Značka auta" name="car_brand" value="<?php echo $car_brand?>" required>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Model</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Model" name="car_model" value="<?php echo $car_model?>"  required>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">7pin</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="7pin" name="7_pin" value="<?php echo $seven_pin ?>">
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">13pin</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="13pin" name="13_pin" value="<?php echo $thirteen_pin ?>"  >
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Poradie</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="number" placeholder="Poradie" name="car_order" value="<?php echo $car_order?>">
                                                        
													</div>
														
                                                </div>
                                                                                                                                   
                                            </div>
                                            
                                            <?php 
                                    
                                                if(isset($_POST['update_record'])){

                                                    $update_car_id = $_POST['car_id'];
                                                    $update_brand = $_POST['car_brand'];
                                                    $update_model = $_POST['car_model'];
                                                    $seven_pin = $_POST['7_pin'];
                                                    $thirteen_pin = $_POST['13_pin'];
                                                    $update_order = $_POST['car_order'];
                                                    $query = "UPDATE cars SET car_brand = '".$update_brand."', car_model = '".$update_model."', 7_pin = '".$seven_pin."', 13_pin = '".$thirteen_pin."', car_order = ".$update_order." WHERE car_id = ".$update_car_id;
                                                    $update_query = mysqli_query($connect, $query);
                                                    
                                                    if($update_query){
                                                        echo "<script> location.href='index.php?modul=spravovat-zaznamy'; </script>";
                                                        echo '<div class="alert alert-success">Údaje boli zmenené.</div>';  
                                                       // header("Refresh:0");
                                                    }else{
                                                        echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';
                                                    }


                                                }

                                            ?>
                                            
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="update_record">Upraviť</button>
                                            </div>
                                            <div class="form-actions right1">
                                                
                                            </div>
                                        </form>                               
                                        </div>                                       
									
                                    </div>          
                                                    
                                     <?php  
                                            
                                        echo "</div>";
                                        
                                        }  
    
                                    ?>

 <div class="portlet box blue">
                                                                 
                               <!-- //****************//
                                    //*Bez*parametrov*//
                                    //****************//   -->
                                    <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-calendar"></i> Záznamy</div>
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
                                                          <th>Funkcie</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php						
				
												$query_zaznamy="SELECT * FROM cars ";
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
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-zaznamy&car_idFD=<?php echo $result_zaznamy['car_id'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" title="Upraviť záznam" formaction="index.php?modul=spravovat-zaznamy&edit_car_id=<?php echo $result_zaznamy['car_id'] ?>"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            
                                                        </td>
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											
                                        </div>                                       
									
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