<div class="page-content">
<?php
    
include "functions.php";    

?>
<br>
<br>
 
<?php include "includes/edit_cd.php" ?>

 <div class="portlet box blue">
                                                                 
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
                                                                                 
                                                deleteCD();
                                                                                                                                                
                                            ?>
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>ID</th>
														  <th>Názov CD</th>
														  <th>Číslo CD</th>
														  <th>Dátum</th>
														  <th>Codierung</th>
														  <th>Počet záznamov</th>
                                                          <th>Funkcie</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php						
				
												$query_zaznamy="SELECT * FROM cd ";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
														<td> <?php echo $result_zaznamy['cd_id']; ?></td>
														<td> <?php echo $result_zaznamy['cd_name'];?></td>
														<td> <?php echo $result_zaznamy['cd_number'];?></td>
														<td> <?php echo $result_zaznamy['cd_date'];?></td>
														<td> <?php echo ($result_zaznamy['codierung']==1?"Áno":"Nie");?></td>
														
														<?php
                                                        
                                                            $query = "SELECT COUNT(*) AS count_of_cars FROM cd_cars WHERE cd_id = ".$result_zaznamy['cd_id'];
                                                            $count_of_cars = mysqli_query($connect,$query);
                                                            $car_count = mysqli_fetch_array($count_of_cars);
                                                    
                                                        ?>
														
														<td><?php echo $car_count['count_of_cars'];?></td>
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="cd_id" value="<?php echo $result_zaznamy['cd_id'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-cd&cd_idFD=<?php echo $result_zaznamy['cd_id'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" title="Upraviť záznam" formaction="index.php?modul=spravovat-cd&edit_cd_id=<?php echo $result_zaznamy['cd_id'] ?>"><i class="fa fa-edit"></i></button>
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
 
 <?php if(isset($_GET['cd_idFD'])){ ?>
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete odstrániť toto CD zo systému?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="cd_id" value="<?php echo $_GET['cd_idFD'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=spravovat-cd">Zrušiť</button>
                    <button type="submit" name="delete" class="btn btn-primary" formaction="index.php?modul=spravovat-cd">Vymazať</button>
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


<?php if(isset($_POST['update_cd'])){ ?>
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
                    <input type="hidden" name="cd_id" value="<?php echo $_POST['cd_id'] ?>">
                    <input type="hidden" name="cd_name" value="<?php echo $_POST['cd_name'] ?>">
                    <input type="hidden" name="cd_number" value="<?php echo $_POST['cd_number'] ?>">
                    <input type="hidden" name="cd_date" value="<?php echo $_POST['cd_date'] ?>">
                    <input type="hidden" name="codierung" value="<?php echo $_POST['codierung'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='index.php?modul=spravovat-cd'">Zrušiť</button>
                    <button type="submit" name="editCD" class="btn btn-primary">Prepísať</button>
                </form>
          </div>
    </div>
  </div>
 
</div>
<?php } ?>