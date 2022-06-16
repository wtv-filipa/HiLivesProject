<!--Modal para eliminar o user nas tabelas-->
<div class="modal fade" id="deleteModal<?= $row_users['idusers'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Once deleted the user cannot be reset. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_user.php?apaga=<?= $row_users['idusers'] ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para apagar o user na página das informções-->
<div class="modal fade" id="deleteModal<?= $idUser ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Once deleted the user cannot be reset. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_user.php?apaga=<?= $idUser ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para apagar a vaga na página das informções-->
<div class="modal fade" id="deletevac<?= $idVacancies ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this vacancy?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Once deleted the vacancy cannot be restored. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?= $idVacancies ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar a vaga nas tabelas-->
<div class="modal fade" id="deletevac<?= $row_vac['idvacancies'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this vacancy?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"> Once deleted the vacancy cannot be restored. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_vac.php?apaga=<?= $row_vac['idvacancies'] ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para apagar a experiência na página das informções-->
<div class="modal fade" id="deletexp<?= $idexperiences ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this history?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Once deleted the history cannot be restored. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_xp.php?apaga=<?= $idexperiences ?>&type=<?= $xp_type ?>&content=<?= $idContent ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar a experiência nas tabelas-->
<div class="modal fade" id="deletexp<?= $row_vid['idexperiences'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this history?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Once deleted the history cannot be restored. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_xp.php?apaga=<?= $row_vid['idexperiences'] ?>&type=<?= $row_vid['xp_type'] ?>&content=<?= $row_vid['idContent'] ?>">Delete</a>
      </div>
    </div>
  </div>
</div>

<!--Modal para eliminar a UC nas tabelas-->
<div class="modal fade" id="deleteUC<?= $row_uc['iddone_cu'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this curricular unit?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Once deleted the course cannot be reset. Press "Delete" to confirm.</div>
      <div class="modal-footer">
        <button class="btn btn_cancel" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn_apagar" href="scripts/delete_uc.php?apaga=<?= $row_uc['iddone_cu'] ?>">Delete</a>
      </div>
    </div>
  </div>
</div>