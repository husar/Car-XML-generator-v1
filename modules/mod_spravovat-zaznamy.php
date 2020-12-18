<div class="page-content">
<?php
    
include "functions.php"; 
    
ob_start();

?>
<br>
<br>
<?php
                                                                                 
    if(isset($_POST['deleteCarFromCD']) && $_POST['on_cd_id'] != ""){

        $deleteCarFromCDQuery="DELETE FROM cd_cars WHERE cd_id = ".$_POST['on_cd_id']." AND car_id = ".$_POST['car_id']."";

        mysqli_query($connect,$deleteCarFromCDQuery);
        unset($_POST['deleteCarFromCD']);
                                                                    
    }     
                                                    
    if(isset($_POST['addCarToCD']) && $_POST['not_on_cd_id'] != ""){

        $insertCarToCDQuery="INSERT INTO cd_cars (cd_id, car_id) VALUES (".$_POST['not_on_cd_id'].", ".$_POST['car_id'].")";

        mysqli_query($connect,$insertCarToCDQuery);
        unset($_POST['addCarToCD']);
                                                                                                                                        
    }

?>
 
<?php include "includes/edit_car.php" ?>

 <div class="portlet box blue">
                                                                
    <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-search"></i> Vyhľadávanie
											</div>
                                      
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form" method="get" >
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
                                                        <option value="<?php echo $result_zaznamy['cd_id'] ?>" <?php echo ($result_zaznamy['cd_id']==$_GET['cd_id'])? 'selected':'' ?>><?php echo $result_zaznamy['cd_name'] ?></option>
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
                                                          <th>Vymazť z CD</th>
                                                          <th>Pridať na CD</th>
                                                          <th>Funkcie</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php						
				
                                                if(isset($_GET['cd_id']) && $_GET['cd_id']!=""){
                                                   
                                                    $query_zaznamy="SELECT * FROM cars INNER JOIN cd_cars ON cars.car_id = cd_cars.car_id WHERE cd_id =".$_GET['cd_id']." ORDER BY car_order";
                                                    
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
														<td> <?php echo $result_zaznamy[car_order] ?></td>
                                                        <td><form action="" style="display:flex" method="post">
                                                               <input type="hidden" name="modul" value="spravovat-zaznamy">	
                                                               <input type="hidden" name="car_id" value="<?php echo $result_zaznamy['car_id'] ?>">
                                                                <?php  
                                                                
                                                                    $query = "SELECT * from cd INNER JOIN cd_cars ON cd.cd_id = cd_cars.cd_id WHERE cd_cars.car_id = ".$result_zaznamy['car_id'];
                                                                    $on_cd = mysqli_query($connect, $query);
                                                                    $on_cd_ids = "";
                                                    
                                                                ?>
                                                                <select name="on_cd_id" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php while($cds=mysqli_fetch_array($on_cd)){?>
                                                                    <option value="<?php echo $cds['cd_id']; ?>"><?php echo $cds['cd_name']; ?></option>
                                                                    <?php 
                                                                            
                                                                            $on_cd_ids .= $cds['cd_id'].",";
                                                                                                                 
                                                                            } 
                                                    
                                                                            $on_cd_ids = substr($on_cd_ids, 0, -1);
                                                                    
                                                                    ?>
                                                                </select>
                                                                <button type="submit" class="btn"  title="Pridať záznam" data-toggle="modal" data-target="#deleteModal" name="deleteCarFromCD" formaction="index.php?modul=spravovat-zaznamy&cd_id=<?php echo $_GET['cd_id'] ?>"><i class="fa fa-times" aria-hidden="true"></i>
                                                                </button>
                                                            </form>
                                                            </td>
                                                        <td>
                                                            <form action="" style="display:flex" method="post">
                                                              <input type="hidden" name="modul" value="spravovat-zaznamy">	
                                                              <input type="hidden" name="car_id" value="<?php echo $result_zaznamy['car_id'] ?>">
                                                               <?php  
                                                                
                                                                    if($on_cd_ids != ""){    
                                                                        
                                                                        $query = "SELECT * FROM cd WHERE cd_id NOT IN(".$on_cd_ids.")";
                                                                        
                                                                    }else{
                                                                        
                                                                        $query = "SELECT * FROM cd";
                                                                        
                                                                    }
                                                                    $not_on_cd = mysqli_query($connect, $query);
                                                    
                                                                ?>
                                                                <select name="not_on_cd_id" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php while($cds=mysqli_fetch_array($not_on_cd)){?>
                                                                    <option value="<?php echo $cds['cd_id']; ?>"><?php echo $cds['cd_name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <button type="submit" class="btn"  title="Pridať záznam" data-toggle="modal" data-target="#deleteModal" name="addCarToCD" ><i class="fa fa-check" aria-hidden="true" formaction="index.php?modul=spravovat-zaznamy&cd_id=<?php echo $_GET['cd_id'] ?>"></i>
                                                                </button>
                                                            </form>
                                                            
                                                        </td>
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="car_id" value="<?php echo $result_zaznamy['car_id'] ?>">
                                                                <button type="button" class="btn"  title="Odstránť záznam" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-zaznamy&car_idFD=<?php echo $result_zaznamy['car_id'] ?>&cd_id=<?php echo $_GET['cd_id'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" title="Upraviť záznam" formaction="index.php?modul=spravovat-zaznamy&edit_car_id=<?php echo $result_zaznamy['car_id'] ?>&cd_id=<?php echo $_GET['cd_id'] ?>"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            
                                                        </td>
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                                
                                            </table>
                                                <?php
                                                                                 
                                                                
                                                            ?>           
                                        </div>                                       
									
                                      
                                        <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="generateXML" onclick="location.href='index.php?modul=spravovat-zaznamy&action=generateXML&cd_id=<?php echo $_GET['cd_id'] ?>'">Generovať XML</button>

                                       
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
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=spravovat-zaznamy&cd_id=<?php echo $_GET['cd_id'] ?>">Zrušiť</button>
                    <button type="submit" name="delete" class="btn btn-primary" formaction="index.php?modul=spravovat-zaznamy&cd_id=<?php echo $_GET['cd_id'] ?>">Vymazať</button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='index.php?modul=spravovat-zaznamy&cd_id=<?php echo $_GET['cd_id'] ?>'">Zrušiť</button>
                    <button type="submit" name="editCar" class="btn btn-primary">Prepísať</button>
                </form>
          </div>
    </div>
  </div>
 
</div>
<?php } ?>