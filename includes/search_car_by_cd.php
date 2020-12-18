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