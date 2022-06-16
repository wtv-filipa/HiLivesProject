<!--Modal para desativar o user nas tabelas-->
<div class="modal fade" id="activeModal<?= $row_users['idusers'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to block this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> You can unlock the user at any time from the same place where you locked him. Press "Block" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $row_users['idusers'] ?>&a=<?= $row_users['active'] ?>">Block</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para ativar o user nas tabelas-->
<div class="modal fade" id="inactiveModal<?= $row_users['idusers'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to unblock this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> You can lock the user at any time from the same place where you unlocked him. Press "Unlock" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $row_users['idusers'] ?>&a=<?= $row_users['active'] ?>">Unlock</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para desativar o user na página de informações-->
<div class="modal fade" id="activeModal<?=$idUser?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to block this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> You can unlock the user at any time from the same place where you locked him. Press "Block" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?= $idUser?>&a=<?=$active?>">Block</a>
      </div>
    </div>
  </div>
</div>
<!--Modal para ativar o user na página de informações-->
<div class="modal fade" id="inactiveModal<?=$idUser?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to unblock this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> You can lock the user at any time from the same place where you unlocked him. Press "Unlock" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="scripts/update_active.php?block=<?=$idUser?>&a=<?=$active?>">Unlock</a>
      </div>
    </div>
  </div>
</div>
<!---------------------->