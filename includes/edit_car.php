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
                                    
                                                updateRecord();

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