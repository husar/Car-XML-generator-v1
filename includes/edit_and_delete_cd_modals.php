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