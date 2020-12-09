<?php include "functions.php"; ?>
<br>
<br>



<div class="page-content">

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i> Pridať vozidlo</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								<?php

                                    if(isset($_POST['create_record'])){

                                        $car_brand = mysqli_real_escape_string($connect,$_POST['car_brand']);
                                        $car_model = mysqli_real_escape_string($connect,$_POST['car_model']);
                                        $seven_pin = mysqli_real_escape_string($connect,$_POST['7_pin']);
                                        $thirteen_pin = mysqli_real_escape_string($connect,$_POST['13_pin']);
                                        $car_order = $_POST['car_order'];

                                        $query = "INSERT INTO cars (car_brand, car_model, 7_pin, 13_pin, car_order) ";
                                        $query .= "VALUES ('".$car_brand."', '".$car_model."', '".$seven_pin."', '".$thirteen_pin."', ".$car_order.") ";
                                        $insert_car_query = mysqli_query($connect, $query);

                                        if($insert_car_query){

                                            echo '<div class="alert alert-success">Údaje boli zaznamenané.</div>';
                                            

                                        }else{

                                            die('QUERY FAILED '.mysqli_error($connect));
                                            echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';

                                        }

                                    }

                                ?>
                                      
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Značka auta</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Značka auta" name="car_brand" value="<?php echo $_POST['car_brand']?>" required>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Model</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Model" name="car_model" value="<?php echo $_POST['car_model']?>"  required>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">7pin</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="7pin" name="7_pin" value="<?php echo $_POST['7_pin']?>">
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">13pin</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="13pin" name="13_pin" value="<?php echo $_POST['13_pin']?>"  >
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Poradie</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="number" placeholder="Poradie" name="car_order" value="<?php echo $_POST['car_order']?>">
                                                        
													</div>
														
                                                </div>
                                                                                                                                   
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="create_record">Zaznamenať</button>
                                            </div>
                                            <div class="form-actions right1">
                                                
                                            </div>
                                        </form>
									<div class="form-group">
                                                        
                                    </div>
                                </div>
						
 </div>