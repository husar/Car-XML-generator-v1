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
                    <input type="hidden" name="cd_id" value="<?php echo $_GET['cd_id'] ?>">
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