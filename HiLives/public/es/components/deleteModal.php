<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para la supresión de la vacante <?= $vacancy_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Estás seguro de que quieres eliminar la vacante <?= $vacancy_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Una vez borrado, no se puede volver atrás. Pulsa "Borrar" para confirmar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Cerrar</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteVacancy_es.php?apaga=<?= $idvacancies ?>" title="Eliminar la vacante <?= $vacancy_name ?>">Borrar</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para borrar el curso/unidad de curso <?= $cu_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Estás seguro de que quieres borrar el curso <?= $cu_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Una vez que se borra, no se puede volver atrás. Pulsa "Borrar" para confirmar.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Cerrar</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourse_es.php?apaga=<?= $iddone_cu ?>" title="Suprimir el curso/unidad curricular <?= $cu_name ?>">Borrar</a>
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
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourseHei_es.php?apaga=<?= $idcourses ?>" title="Apagar o curso <?= $name_course ?>">Apagar</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE STORIES MODAL-->
<div id="deleteStory<?= $idexperiences ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal para apagar uma história" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Tem a certeza que quer apagar a história?</b></h5>
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
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteStory_es.php?apaga=<?= $idexperiences ?>&user=<?= $idUser ?>&type=<?= $xp_type ?>&content=<?= $content_idcontent ?>" title="Apagar a história">Apagar</a>
            </div>
        </div>
    </div>
</div>