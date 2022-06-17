<?php
if (isset($_GET["translate"])) {
    $idVac = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT vacancy_name, vacancy_name_en, vacancy_name_es, vacancy_name_be, vacancy_name_is, description_vac, description_vac_en, description_vac_es, description_vac_be, description_vac_is, requirements, requirements_en, requirements_es, requirements_be, requirements_is, company_id
    FROM vacancies
    WHERE idvacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idVac);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $vacancy_name, $vacancy_name_en, $vacancy_name_es, $vacancy_name_be, $vacancy_name_is, $description_vac, $description_vac_en, $description_vac_es, $description_vac_be, $description_vac_is, $requirements, $requirements_en, $requirements_es, $requirements_be, $requirements_is, $company_id);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Vacancy details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected vacancy.</p>
            <div class="card mb-5">
                <form method="post" role="form" id="register-form" action="scripts/translate_vac.php?vac=<?= $idVac ?>">
                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomevaga">Position in the company in portuguese</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomevaga" name="nomevaga" placeholder="Type the name of the position available in portuguese"  value="<?= $vacancy_name ?>">
                        </div>
                    </div>

                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomevaga_en">Position in the company in english</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomevaga_en" name="nomevaga_en" placeholder="Type the name of the position available in english" value="<?= $vacancy_name_en ?>">
                        </div>
                    </div>

                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomevaga_es">Position in the company in spanish</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomevaga_es" name="nomevaga_es" placeholder="Type the name of the position available in spanish" value="<?= $vacancy_name_es ?>">
                        </div>
                    </div>

                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomevaga_be">Position in the company in flemish</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomevaga_be" name="nomevaga_be" placeholder="Type the name of the position available in flemish" value="<?= $vacancy_name_be ?>">
                        </div>
                    </div>

                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomevaga_is">Position in the company in icelandic</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomevaga_is" name="nomevaga_is" placeholder="Type the name of the position available in icelandic" value="<?= $vacancy_name_is ?>">
                        </div>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao">Vacancy description in portuguese</label>
                        <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Insert a text that describes the vacancy you are advertising in portuguese" maxlength="445" ><?= $description_vac ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_en">Vacancy description in english</label>
                        <textarea class="form-control textareaCountable" id="descricao_en" rows="5" name="descricao_en" placeholder="Insert a text that describes the vacancy you are advertising in english" maxlength="445"><?= $description_vac_en ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_es">Vacancy description in spanish</label>
                        <textarea class="form-control textareaCountable" id="descricao_es" rows="5" name="descricao_es" placeholder="Insert a text that describes the vacancy you are advertising in spanish" maxlength="445"><?= $description_vac_es ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_be">Vacancy description in flemish</label>
                        <textarea class="form-control textareaCountable" id="descricao_be" rows="5" name="descricao_be" placeholder="Insert a text that describes the vacancy you are advertising in flemish" maxlength="445"><?= $description_vac_be ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_is">Vacancy description in icelandic</label>
                        <textarea class="form-control textareaCountable" id="descricao_is" rows="5" name="descricao_is" placeholder="Insert a text that describes the vacancy you are advertising in icelandic" maxlength="445"><?= $description_vac_is ?></textarea>
                    </div>

                    <!--REQUIRENMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos">Requirements in portuguese</label>
                        <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Type a text that describes the vacancy you are advertising in portuguese" ><?= $requirements ?></textarea>
                    </div>

                    <!--REQUIRENMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_en">Requirements in english</label>
                        <textarea class="form-control " id="requisitos_en" rows="5" name="requisitos_en" placeholder="Type a text that describes the vacancy you are advertising in english"><?= $requirements_en ?></textarea>
                    </div>

                    <!--REQUIRENMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_es">Requirements in spanish</label>
                        <textarea class="form-control " id="requisitos_es" rows="5" name="requisitos_es" placeholder="Type a text that describes the vacancy you are advertising in spanish"><?= $requirements_es ?></textarea>
                    </div>

                    <!--REQUIRENMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_be">Requirements in flemish</label>
                        <textarea class="form-control " id="requisitos_be" rows="5" name="requisitos_be" placeholder="Type a text that describes the vacancy you are advertising in flemish"><?= $requirements_be ?></textarea>
                    </div>

                    <!--REQUIRENMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_is">Requirements in icelandic</label>
                        <textarea class="form-control " id="requisitos_is" rows="5" name="requisitos_is" placeholder="Type a text that describes the vacancy you are advertising in icelandic"><?= $requirements_is ?></textarea>
                    </div>

                    <div class="form-group text-center mt-4">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize me-4">Save</button>

                            <a href="vac_t.php" title="Exit translation">
                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

<?php
            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>