<!--DELETE VACANCY MODAL-->
<div id="deletevac<?= $idvacancies ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal to delete the vacancy <?= $vacancy_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Are you sure you want to delete the vacancy <?= $vacancy_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Once deleted, you cannot go back. Press "Delete" to confirm.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteVacancy_en.php?apaga=<?= $idvacancies ?>" title="Delete the vacancy <?= $vacancy_name ?>">Delete</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE PERSON COURSES MODAL-->
<div id="deleteCourse<?= $iddone_cu ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal to delete the course/course unit <?= $cu_name ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Are you sure you want to delete the course <?= $cu_name ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Once deleted, you cannot go back. Press "Delete" to confirm.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourse_en.php?apaga=<?= $iddone_cu ?>" title="Delete the course/course unit <?= $cu_name ?>">Delete</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE HEI COURSES MODAL-->
<div id="deleteCourseHei<?= $idcourses ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal to delete the course <?= $name_course ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Are you sure you want to delete the course <?= $name_course ?>?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Once deleted, you cannot go back. Press "Delete" to confirm.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteCourseHei_en.php?apaga=<?= $idcourses ?>" title="Delete the course <?= $name_course ?>">Delete</a>
            </div>
        </div>
    </div>
</div>

<!--DELETE STORIES MODAL-->
<div id="deleteStory<?= $idexperiences ?>" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="Modal to delete a story" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Are you sure you want to delete the story?</b></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Once deleted, you cannot go back. Press "Delete" to confirm.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn buttonDesign buttonCancel" data-bs-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger buttonDesign" href="../../scripts/deleteStory_en.php?apaga=<?= $idexperiences ?>&user=<?= $idUser ?>&type=<?= $xp_type ?>&content=<?= $content_idcontent ?>" title="Delete the story">Delete</a>
            </div>
        </div>
    </div>
</div>