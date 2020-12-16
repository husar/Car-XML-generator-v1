<?php include "functions.php"; ?>
<br>
<br>



<div class="page-content">

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-car"></i> Pridať vozidlo</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								<?php

                                    insertRecord();

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
                                                    <label class="col-md-3 control-label">CD</label>
                                                    <div class="col-md-9">
													<select name="car_cd" id="car_cd" onchange="showDiv('hidden_div', this)">
                                                       <option value=""></option>;
                                                <?php
                                                        
                                                    $query = "SELECT * from cd ";
                                                    $selected_cds = mysqli_query($connect, $query);
                                                           
                                                    while($row = mysqli_fetch_array($selected_cds)){
                                                        
                                                        echo "<option value=\"".$row['cd_id']."\">".$row['cd_name']."</option>";
                                                        
                                                    }
                                                        
                                                ?>
                                                
												    </select>
                                                        
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
<!-- <script>
    function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value != "" ? 'block' : 'none';
}
</script>-->