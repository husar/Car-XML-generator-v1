<div class="page-content">
<?php
    
include "functions.php"; 
    
ob_start();

?>
<br>
<br>
<?php
    
    deleteCarFromCD();
    addCarToCD();

?>
 
<?php include "includes/edit_car.php" ?>

 <div class="portlet box blue">
                                                                
    <?php include "includes/search_car_by_cd.php" ?>
                                                                 
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
														<td> <?php echo $result_zaznamy['car_order'] ?></td>
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
 
<?php include "includes/edit_and_delete_car_modals.php" ?>