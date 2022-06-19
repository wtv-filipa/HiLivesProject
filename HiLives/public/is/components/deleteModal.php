<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal að eyða lausu starfi <?= $vacancy_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Ertu viss um að þú viljir eyða lausu starfi <?= $vacancy_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Loka">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Þegar þú eyðir því geturðu ekki farið til baka. Ýttu á "Eyða" til að staðfesta.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Loka</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteVacancy_is.php?apaga=<?= $idvacancies ?>" title="Eyða lausu starfi <?= $vacancy_name ?>">Farðu út eins og ljós</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Mótun til að eyða námskeiðinu/námseiningunni <?= $cu_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Á örugglega að eyða námskeiðinu <?= $cu_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Loka">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                Þegar þú eyðir því geturðu ekki farið til baka. Ýttu á "Eyða" til að staðfesta.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Loka</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourse_is.php?apaga=<?= $iddone_cu ?>" title="Eyða námskeiðs-/námskráreiningunni <?= $cu_name ?>">Farðu út eins og ljós</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE HEI COURSES MODAL-->
<div id="deleteCourseHei<?= $idcourses ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal til að eyða námskeiðinu <?= $name_course ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Á örugglega að eyða námskeiðinu <?= $name_course ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Loka">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Þegar þú eyðir því geturðu ekki farið til baka. Ýttu á "Eyða" til að staðfesta.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Loka</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourseHei_is.php?apaga=<?= $idcourses ?>" title="Eyða námskeiðinu <?= $name_course ?>">Farðu út eins og ljós</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE STORIES MODAL-->
<div id="deleteStory<?= $idexperiences ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal að eyða sögu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Ertu viss um að þú viljir eyða sögunni?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Loka">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Þegar þú eyðir því geturðu ekki farið til baka. Ýttu á "Eyða" til að staðfesta.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Loka</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteStory_is.php?apaga=<?= $idexperiences ?>&user=<?= $idUser ?>&type=<?= $xp_type ?>&content=<?= $content_idcontent ?>" title="Eyða sögu">Farðu út eins og ljós</a>
            </div>
        </div>
    </div>
</div>