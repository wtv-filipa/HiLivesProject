<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modaal om de vacature te wissen <?= $vacancy_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Weet je zeker dat je de vacature wilt wissen? <?= $vacancy_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Wanneer u het verwijdert, kunt u niet meer teruggaan. Druk op "Delete" om te bevestigen.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Sluiten</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteVacancy_be.php?apaga=<?= $idvacancies ?>" title="Verwijder de vacature <?= $vacancy_name ?>">Blussen</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modaal om de cursus/curriculaire eenheid te verwijderen <?= $cu_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>U weet zeker dat u wilt uitschakelen of koers <?= $cu_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Wanneer u het wist, kunt u niet meer teruggaan. Druk op "Delete" om te bevestigen.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Sluiten</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourse_be.php?apaga=<?= $iddone_cu ?>" title="De cursus/curriculumeenheid verwijderen <?= $cu_name ?>">Blussen</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE HEI COURSES MODAL-->
<div id="deleteCourseHei<?= $idcourses ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modaal om de cursus te verwijderen <?= $name_course ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Weet je zeker dat je de cursus wilt verwijderen <?= $name_course ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Wanneer u het verwijdert, kunt u niet meer teruggaan. Druk op "Delete" om te bevestigen.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Sluiten</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourseHei_be.php?apaga=<?= $idcourses ?>" title="De cursus verwijderen <?= $name_course ?>">Blussen</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE STORIES MODAL-->
<div id="deleteStory<?= $idexperiences ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modaal om een verhaal te wissen" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Weet je zeker dat je het verhaal wilt wissen?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Wanneer u het verwijdert, kunt u niet meer teruggaan. Druk op "Delete" om te bevestigen.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Sluiten</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteStory_be.php?apaga=<?= $idexperiences ?>&user=<?= $idUser ?>&type=<?= $xp_type ?>&content=<?= $content_idcontent ?>" title="Geschiedenis wissen">Blussen</a>
            </div>
        </div>
    </div>
</div>