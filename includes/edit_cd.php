<?php
     
                                        if(isset($_GET['edit_cd_id'])){
                                            
                                            echo "<div class=\"portlet box blue\">";
                                            
                                            $query = "SELECT * FROM cd WHERE cd_id = ".$_GET['edit_cd_id'];
                                            $selected_cd_edit = mysqli_query($connect,$query);
                                            
                                            while($row = mysqli_fetch_assoc($selected_cd_edit)){
                                                
                                                $cd_id = $row['cd_id'];
                                                $cd_name = $row['cd_name'];
                                                $cd_number = $row['cd_number'];
                                                $cd_date = $row['cd_date'];
                                                $codierung = $row['codierung'];                                                    
                                            }
                                            
                                    ?>
                                                    
                                              <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-dot-circle-o"></i> <?php echo $cd_name ?></div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            </div>
                                        </div>     
                                    <div class="portlet-body">
                                        <div class="portlet-body">
									          <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                                    	
													<input class="form-control" size="16" type="hidden" name="cd_id" value="<?php echo $cd_id?>">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Názov CD</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Názov CD" name="cd_name" value="<?php echo $cd_name?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Číslo CD</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Číslo CD" name="cd_number" value="<?php echo $cd_number?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Dátum</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="date" name="cd_date" value="<?php echo $cd_date?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Zobrazovať text a tlačidlo "Codierung"</label>
                                                    <div class="col-md-9">
                                                    <input type="checkbox" id="codierung" name="codierung" value="1" <?php echo $codierung==1?"checked":""?>>
													</div>
                                                </div>
                                                                                                                                   
                                            </div>
                                            
                                             <?php 
                                    
                                                updateCD();

                                            ?>
                                            
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="update_cd">Upraviť</button>
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