<?php include "functions.php"; ?>
<br>
<br>



<div class="page-content">

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-dot-circle-o"></i>Vytvoriť CD</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                     
                                    <?php

                                        insertCD();

                                    ?>
                                      
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Názov CD</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Názov CD" name="cd_name" value="<?php echo $_POST['cd_name']?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Číslo CD</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Číslo CD" name="cd_number" value="<?php echo $_POST['cd_number']?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Dátum</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="date" name="cd_date" value="<?php echo $_POST['cd_date']?>" required>
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Zobrazovať text a tlačidlo "Codierung"</label>
                                                    <div class="col-md-9">
                                                    <input type="checkbox" id="codierung" name="codierung" value="1" <?php echo $_POST['codierung']==1?"checked":""?>>
													</div>	
														
                                                </div>
                                                                                                                                   
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="create_cd">Vytvoriť CD</button>
                                            </div>
                                            <div class="form-actions right1">
                                                
                                            </div>
                                        </form>
									<div class="form-group">
                                                        
                                    </div>
                                </div>
						
 </div>