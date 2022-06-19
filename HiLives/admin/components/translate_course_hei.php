<?php
if (isset($_GET["translate"])) {
    $idcourses = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT name_course, name_course_en, name_course_es, name_course_be, name_course_is, description_course, description_course_en, description_course_es, description_course_be, description_course_is, duration_course, duration_course_en, duration_course_es, duration_course_be, duration_course_is, credits_ects, credits_ects_en, credits_ects_es, credits_ects_be, credits_ects_is, languages, languages_en, languages_es, languages_be, languages_is, course_fee, course_fee_en, course_fee_es, course_fee_be, course_fee_is, certification, certification_en, certification_es, certification_be, certification_is, target, target_en, target_es, target_be, target_is, stages, stages_en, stages_es, stages_be, stages_is, requirements, requirements_en, requirements_es, requirements_be, requirements_is, curriculum_plan, curriculum_plan_en, curriculum_plan_es, curriculum_plan_be, curriculum_plan_is, vocational_dimension, vocational_dimension_en, vocational_dimension_es, vocational_dimension_be, vocational_dimension_is, support, support_en, support_es, support_be, support_is, activities, activities_en, activities_es, activities_be, activities_is
    FROM courses 
    WHERE idcourses = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idcourses);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_course, $name_course_en, $name_course_es, $name_course_be, $name_course_is, $description_course, $description_course_en, $description_course_es, $description_course_be, $description_course_is, $duration_course, $duration_course_en, $duration_course_es, $duration_course_be, $duration_course_is, $credits_ects, $credits_ects_en, $credits_ects_es, $credits_ects_be, $credits_ects_is, $languages, $languages_en, $languages_es, $languages_be, $languages_is, $course_fee, $course_fee_en, $course_fee_es, $course_fee_be, $course_fee_is, $certification, $certification_en, $certification_es, $certification_be, $certification_is, $target, $target_en, $target_es, $target_be, $target_is, $stages, $stages_en, $stages_es, $stages_be, $stages_is, $requirements, $requirements_en, $requirements_es, $requirements_be, $requirements_is, $curriculum_plan, $curriculum_plan_en, $curriculum_plan_es, $curriculum_plan_be, $curriculum_plan_is, $vocational_dimension, $vocational_dimension_en, $vocational_dimension_es, $vocational_dimension_be, $vocational_dimension_is, $support, $support_en, $support_es, $support_be, $support_is, $activities, $activities_en, $activities_es, $activities_be, $activities_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Course translation</h1>
            <p class="mb-4">On this page it is possible to see and translate all the translations of the selected course.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_course_hei.php?course=<?= $idcourses ?>">
                    <!--VACANCIE NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nome">Course name in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Type the name of the course in portuguese here" value="<?= $name_course ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nome_en">Course name in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nome_en" name="nome_en" placeholder="Type the name of the course in english here" value="<?= $name_course_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nome_es">Course name in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nome_es" name="nome_es" placeholder="Type the name of the course in spanish here" value="<?= $name_course_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nome_be">Course name in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nome_be" name="nome_be" placeholder="Type the name of the course in flemish here" value="<?= $name_course_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nome_is">Course name in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nome_is" name="nome_is" placeholder="Type the name of the course in icelandic here" value="<?= $name_course_is ?>">
                        </div>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao">Description in portuguese </label>
                        <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Type the description of the course in portuguese here" maxlength="445" ><?= $description_course ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_en">Description in english </label>
                        <textarea class="form-control textareaCountable" id="descricao_en" rows="5" name="descricao_en" placeholder="Type the description of the course in english here" maxlength="445" ><?= $description_course_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_es">Description in spanish </label>
                        <textarea class="form-control textareaCountable" id="descricao_es" rows="5" name="descricao_es" placeholder="Type the description of the course in spanish here" maxlength="445" ><?= $description_course_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_be">Description in flemish </label>
                        <textarea class="form-control textareaCountable" id="descricao_be" rows="5" name="descricao_be" placeholder="Type the description of the course in flemish here" maxlength="445" ><?= $description_course_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_is">Description in icelandic </label>
                        <textarea class="form-control textareaCountable" id="descricao_is" rows="5" name="descricao_is" placeholder="Type the description of the course in icelandic here" maxlength="445" ><?= $description_course_is ?></textarea>
                    </div>

                    <!--secção-->
                    <h3 class="text-center" role="heading">General Course Characteristics</h3>
                    <!----------->

                    <!--DURATION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="duracao">Course duration in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Type the duration of the course in portuguese here" value="<?= $duration_course ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="duracao_en">Course duration in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="duracao_en" name="duracao_en" placeholder="Type the duration of the course in english here" value="<?= $duration_course_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="duracao_es">Course duration in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="duracao_es" name="duracao_es" placeholder="Type the duration of the course in spanish here" value="<?= $duration_course_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="duracao_be">Course duration in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="duracao_be" name="duracao_be" placeholder="Type the duration of the course in flemish here" value="<?= $duration_course_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="duracao_is">Course duration in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="duracao_is" name="duracao_is" placeholder="Type the duration of the course in icelandic here" value="<?= $duration_course_is ?>">
                        </div>
                    </div>

                    <!--ECTCS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="ects"> ECTS in portuguese  </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Type the ECTS of the course in portuguese here" value="<?= $credits_ects ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="ects_en"> ECTS in english  </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="ects_en" name="ects_en" placeholder="Type the ECTS of the course in english here" value="<?= $credits_ects_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="ects_es"> ECTS in spanish  </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="ects_es" name="ects_es" placeholder="Type the ECTS of the course in spanish here" value="<?= $credits_ects_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="ects_be"> ECTS in flemish  </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="ects_be" name="ects_be" placeholder="Type the ECTS of the course in flemish here" value="<?= $credits_ects_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="ects_is"> ECTS in icelandic  </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="ects_is" name="ects_is" placeholder="Type the ECTS of the course in icelandic here" value="<?= $credits_ects_is ?>">
                        </div>
                    </div>

                    <!--LANGUAGES-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="idioma">Language(s) of instruction in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Type the language(s) of instruction of the course in portuguese here" value="<?= $languages ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="idioma_en">Language(s) of instruction in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="idioma_en" name="idioma_en" placeholder="Type the language(s) of instruction of the course in english here" value="<?= $languages_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="idioma_es">Language(s) of instruction in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="idioma_es" name="idioma_es" placeholder="Type the language(s) of instruction of the course in spanish here" value="<?= $languages_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="idioma_be">Language(s) of instruction in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="idioma_be" name="idioma_be" placeholder="Type the language(s) of instruction of the course in flemish here" value="<?= $languages_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="idioma_is">Language(s) of instruction in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="idioma_is" name="idioma_is" placeholder="Type the language(s) of instruction of the course in icelandic here" value="<?= $languages_is ?>">
                        </div>
                    </div>

                    <!--FEE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="propina">Course fee in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Type the fee of the course in portuguese here" value="<?= $course_fee ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="propina_en">Course fee in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="propina_en" name="propina_en" placeholder="Type the fee of the course in english here" value="<?= $course_fee_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="propina_es">Course fee in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="propina_es" name="propina_es" placeholder="Type the fee of the course in spanish here" value="<?= $course_fee_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="propina_be">Course fee in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="propina_be" name="propina_be" placeholder="Type the fee of the course in flemish here" value="<?= $course_fee_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="propina_is">Course fee in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="propina_is" name="propina_is" placeholder="Type the fee of the course in icelandic here" value="<?= $course_fee_is ?>">
                        </div>
                    </div>

                    <!--CERTIFICATION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="certificacao">Course certification in portuguese </label>
                        <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Type the certification of the course in portuguese here" ><?= $certification ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="certificacao_en">Course certification in english </label>
                        <textarea class="form-control " id="certificacao_en" rows="5" name="certificacao_en" placeholder="Type the certification of the course in english here" ><?= $certification_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="certificacao_es">Course certification in spanish </label>
                        <textarea class="form-control " id="certificacao_es" rows="5" name="certificacao_es" placeholder="Type the certification of the course in spanish here" ><?= $certification_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="certificacao_be">Course certification in flemish </label>
                        <textarea class="form-control " id="certificacao_be" rows="5" name="certificacao_be" placeholder="Type the certification of the course in flemish here" ><?= $certification_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="certificacao_is">Course certification in icelandic </label>
                        <textarea class="form-control " id="certificacao_is" rows="5" name="certificacao_is" placeholder="Type the certification of the course in icelandic here" ><?= $certification_is ?></textarea>
                    </div>

                    <!--secção-->
                    <h3 class="text-center" role="heading">Target groups and conditions for admission</h3>
                    <!----------->

                    <!--TARGET-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="destinatarios">Target groups in portuguese </label>
                        <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Type the certification of the course in portuguese here" ><?= $target ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="destinatarios_en">Target groups in english </label>
                        <textarea class="form-control " id="destinatarios_en" rows="5" name="destinatarios_en" placeholder="Type the certification of the course in english here" ><?= $target_en ?></textarea>
                    </div>
                    
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="destinatarios_es">Target groups in spanish </label>
                        <textarea class="form-control " id="destinatarios_es" rows="5" name="destinatarios_es" placeholder="Type the certification of the course in spanish here" ><?= $target_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="destinatarios_be">Target groups in flemish </label>
                        <textarea class="form-control " id="destinatarios_be" rows="5" name="destinatarios_be" placeholder="Type the certification of the course in flemish here" ><?= $target_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="destinatarios_is">Target groups in icelandic </label>
                        <textarea class="form-control " id="destinatarios_is" rows="5" name="destinatarios_is" placeholder="Type the certification of the course in icelandic here" ><?= $target_is ?></textarea>
                    </div>

                    <!--STAGES-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="periodo">Application stage(s) in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Type the application stage(s) of the course in portuguese here" value="<?= $stages ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="periodo_en">Application stage(s) in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="periodo_en" name="periodo_en" placeholder="Type the application stage(s) of the course in english here" value="<?= $stages_en ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="periodo_es">Application stage(s) in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="periodo_es" name="periodo_es" placeholder="Type the application stage(s) of the course in spanish here" value="<?= $stages_es ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="periodo_be">Application stage(s) in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="periodo_be" name="periodo_be" placeholder="Type the application stage(s) of the course in flemish here" value="<?= $stages_be ?>">
                        </div>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="periodo_is">Application stage(s) in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="periodo_is" name="periodo_is" placeholder="Type the application stage(s) of the course in icelandic here" value="<?= $stages_is ?>">
                        </div>
                    </div>

                    <!--REQUIREMENTS-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos">Requirements in portuguese </label>
                        <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Type the requirements of the course in portuguese here" ><?= $requirements ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_en">Requirements in english </label>
                        <textarea class="form-control " id="requisitos_en" rows="5" name="requisitos_en" placeholder="Type the requirements of the course in english here" ><?= $requirements_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_es">Requirements in spanish </label>
                        <textarea class="form-control " id="requisitos_es" rows="5" name="requisitos_es" placeholder="Type the requirements of the course in spanish here" ><?= $requirements_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_be">Requirements in flemish </label>
                        <textarea class="form-control " id="requisitos_be" rows="5" name="requisitos_be" placeholder="Type the requirements of the course in flemish here" ><?= $requirements_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="requisitos_is">Requirements in icelandic </label>
                        <textarea class="form-control " id="requisitos_is" rows="5" name="requisitos_is" placeholder="Type the requirements of the course in icelandic here" ><?= $requirements_is ?></textarea>
                    </div>

                    <!--secção-->
                    <h3 class="text-center" role="heading">Course details</h3>
                    <!----------->

                    <!--CURRICULUM PLAN-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="curricular">Type of curriculum plan in portuguese </label>
                        <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Type the kind of curricular plan of the course in portuguese here" ><?= $curriculum_plan ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="curricular_en">Type of curriculum plan in english </label>
                        <textarea class="form-control " id="curricular_en" rows="5" name="curricular_en" placeholder="Type the kind of curricular plan of the course in english here" ><?= $curriculum_plan_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="curricular_es">Type of curriculum plan in spanish </label>
                        <textarea class="form-control " id="curricular_es" rows="5" name="curricular_es" placeholder="Type the kind of curricular plan of the course in spanish here" ><?= $curriculum_plan_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="curricular_be">Type of curriculum plan in flemish </label>
                        <textarea class="form-control " id="curricular_be" rows="5" name="curricular_be" placeholder="Type the kind of curricular plan of the course in flemish here" ><?= $curriculum_plan_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="curricular_is">Type of curriculum plan in icelandic </label>
                        <textarea class="form-control " id="curricular_is" rows="5" name="curricular_is" placeholder="Type the kind of curricular plan of the course in icelandic here" ><?= $curriculum_plan_is ?></textarea>
                    </div>

                    <!--VOCATIONAL DIMENSION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="vocacional">Professional dimension in portuguese </label>
                        <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Type the professional dimension of the course in portuguese here" ><?= $vocational_dimension ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="vocacional_en">Professional dimension in english </label>
                        <textarea class="form-control " id="vocacional_en" rows="5" name="vocacional_en" placeholder="Type the professional dimension of the course in english here" ><?= $vocational_dimension_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="vocacional_es">Professional dimension in spanish </label>
                        <textarea class="form-control " id="vocacional_es" rows="5" name="vocacional_es" placeholder="Type the professional dimension of the course in spanish here" ><?= $vocational_dimension_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="vocacional_be">Professional dimension in flemish </label>
                        <textarea class="form-control " id="vocacional_be" rows="5" name="vocacional_be" placeholder="Type the professional dimension of the course in flemish here" ><?= $vocational_dimension_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="vocacional_is">Professional dimension in icelandic </label>
                        <textarea class="form-control " id="vocacional_is" rows="5" name="vocacional_is" placeholder="Type the professional dimension of the course in icelandic here" ><?= $vocational_dimension_is ?></textarea>
                    </div>

                    <!--ACTIVITIES-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="atividades">Extracurricular activities in portuguese </label>
                        <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Type the extracurricular activities of the course in portuguese here" ><?= $activities ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="atividades_en">Extracurricular activities in english </label>
                        <textarea class="form-control " id="atividades_en" rows="5" name="atividades_en" placeholder="Type the extracurricular activities of the course in english here" ><?= $activities_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="atividades_es">Extracurricular activities in spanish </label>
                        <textarea class="form-control " id="atividades_es" rows="5" name="atividades_es" placeholder="Type the extracurricular activities of the course in spanish here" ><?= $activities_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="atividades_be">Extracurricular activities in flemish </label>
                        <textarea class="form-control " id="atividades_be" rows="5" name="atividades_be" placeholder="Type the extracurricular activities of the course in flemish here" ><?= $activities_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="atividades_is">Extracurricular activities in icelandic </label>
                        <textarea class="form-control " id="atividades_is" rows="5" name="atividades_is" placeholder="Type the extracurricular activities of the course in icelandic here" ><?= $activities_is ?></textarea>
                    </div>

                    <!--SUPPORT-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="apoios">Support in portuguese </label>
                        <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Type the support of the course in portuguese here" ><?= $support ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="apoios_en">Support in english </label>
                        <textarea class="form-control " id="apoios_en" rows="5" name="apoios_en" placeholder="Type the support of the course in english here" ><?= $support_en ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="apoios_es">Support in spanish </label>
                        <textarea class="form-control " id="apoios_es" rows="5" name="apoios_es" placeholder="Type the support of the course in spanish here" ><?= $support_es ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="apoios_be">Support in flemish </label>
                        <textarea class="form-control " id="apoios_be" rows="5" name="apoios_be" placeholder="Type the support of the course in flemish here" ><?= $support_be ?></textarea>
                    </div>

                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="apoios_is">Support in icelandic </label>
                        <textarea class="form-control " id="apoios_is" rows="5" name="apoios_is" placeholder="Type the support of the course in icelandic here" ><?= $support_is ?></textarea>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize mr-4">Save</button>
                            <a href="courses_heis_t.php" title="Leave translations edition">
                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

<?php
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>