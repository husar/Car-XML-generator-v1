<div class="page-content">
<?php
    
include "functions.php";    

?>
<br>
<br>
 
<?php include "includes/edit_car.php" ?>

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
				
												$query_zaznamy="SELECT * FROM cars ORDER BY car_order";
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
									
                                      
                                        <button type="button" class="btn"  title="Zmazať záznam" data-toggle="modal" data-target="#deleteModal" name="generateXML" onclick="location.href='index.php?modul=spravovat-zaznamy&action=generateXML'">Generovať XML</button>

                                       
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href='index.php?modul=spravovat-zaznamy'">Zrušiť</button>
                    <button type="submit" name="editCar" class="btn btn-primary">Prepísať</button>
                </form>
          </div>
    </div>
  </div>
 
</div>
<?php } ?>