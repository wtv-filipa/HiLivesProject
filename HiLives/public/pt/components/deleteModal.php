<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para apagar a vaga <?= $vacancy_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tem a certeza que quer apagar a vaga <?= $vacancy_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Quando apagar, não poderá voltar atrás. Carregue em "Apagar" para confirmar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Fechar</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteVacancy.php?apaga=<?= $idvacancies ?>" title="Apagar a vaga <?= $vacancy_name ?>">Apagar</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para apagar o curso/unidade curricular <?= $cu_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tens a certeza que queres apagar o curso <?= $cu_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Quando apagares, não poderás voltar atrás. Carrega em "Apagar" para confirmar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Fechar</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourse.php?apaga=<?= $iddone_cu ?>" title="Apagar o curso/unidade curricular <?= $cu_name ?>">Apagar</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE HEI COURSES MODAL-->
<div id="deleteCourseHei<?= $idcourses ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para apagar o curso <?= $name_course ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tem a certeza que quer apagar o curso <?= $name_course ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Quando apagar, não poderá voltar atrás. Carregue em "Apagar" para confirmar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Fechar</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourseHei.php?apaga=<?= $idcourses ?>" title="Apagar o curso <?= $name_course ?>">Apagar</a>
            </div>
        </div>
    </div>
</div>