<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Tem a certeza que quer apagar a vaga <?= $vacancy_name ?>?</b></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar" aria-hidden=true></button>
            </div>
            <div class="modal-body">
                <div class="row mx-auto">
                    <div class="col-12 text-center">
                        <p>Quando apagar, não poderá voltar atrás. Carregue em "Apagar" para confirmar.
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4 me-3">
                        <a class="btn btn-danger buttonLoginSize buttonDesign" href="../../scripts/deleteVacancy.php?apaga=<?= $idvacancies ?>">Apagar</a>
                    </div>
                    <div class="col-md-4 ms-3">
                        <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Tens a certeza que queres apagar o curso <?= $cu_name ?>?</b></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar" aria-hidden=true></button>
            </div>
            <div class="modal-body">
                <div class="row mx-auto">
                    <div class="col-12 text-center">
                        <p>Quando apagares, não poderás voltar atrás. Carrega em "Apagar" para confirmar.
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4 me-3">
                        <a class="btn btn-danger buttonLoginSize buttonDesign" href="../../scripts/deleteCourse.php?apaga=<?= $iddone_cu ?>">Apagar</a>
                    </div>
                    <div class="col-md-4 ms-3">
                        <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--DELETE HEI COURSES MODAL-->
<div id="deleteCourseHei<?= $idcourses ?>" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Tem a certeza que quer apagar o curso <?= $name_course ?>?</b></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar" aria-hidden=true></button>
            </div>
            <div class="modal-body">
                <div class="row mx-auto">
                    <div class="col-12 text-center">
                        <p>Quando apagar, não poderá voltar atrás. Carregue em "Apagar" para confirmar.
                        </p>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4 me-3">
                        <a class="btn btn-danger buttonLoginSize buttonDesign" href="../../scripts/deleteCourseHei.php?apaga=<?= $idcourses ?>">Apagar</a>
                    </div>
                    <div class="col-md-4 ms-3">
                        <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>