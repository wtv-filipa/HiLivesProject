<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idcourses = $_GET["course"];

$query = "UPDATE courses
SET name_course = ?, name_course_en = ?, name_course_es = ?, name_course_be = ?, name_course_is = ?, description_course = ?, description_course_en = ?, description_course_es = ?, description_course_be = ?, description_course_is = ?, duration_course = ?, duration_course_en = ?, duration_course_es = ?, duration_course_be = ?, duration_course_is = ?, credits_ects = ?, credits_ects_en = ?, credits_ects_es = ?, credits_ects_be = ?, credits_ects_is = ?, languages = ?, languages_en = ?, languages_es = ?, languages_be = ?, languages_is = ?, course_fee = ?, course_fee_en = ?, course_fee_es = ?, course_fee_be = ?, course_fee_is = ?, certification = ?, certification_en = ?, certification_es = ?, certification_be = ?, certification_is = ?, target = ?, target_en = ?, target_es = ?, target_be = ?, target_is = ?, stages = ?, stages_en = ?, stages_es = ?, stages_be = ?, stages_is = ?, requirements = ?, requirements_en = ?, requirements_es = ?, requirements_be = ?, requirements_is = ?, curriculum_plan = ?, curriculum_plan_en = ?, curriculum_plan_es = ?, curriculum_plan_be = ?, curriculum_plan_is = ?, vocational_dimension = ?, vocational_dimension_en = ?, vocational_dimension_es = ?, vocational_dimension_be = ?, vocational_dimension_is = ?, support = ?, support_en = ?, support_es = ?, support_be = ?, support_is = ?, activities = ?, activities_en = ?, activities_es = ?, activities_be = ?, activities_is = ?
WHERE idcourses = ?";

if (isset($_GET["course"])) {

    $idcourses = $_GET["course"];

    $name_course = $_POST["nome"];
    $name_course_en = $_POST["nome_en"];
    $name_course_es = $_POST["nome_es"];
    $name_course_be = $_POST["nome_be"];
    $name_course_is = $_POST["nome_is"];

    $description_course = $_POST["descricao"];
    $description_course_en = $_POST["descricao_en"];
    $description_course_es = $_POST["descricao_es"];
    $description_course_be = $_POST["descricao_be"];
    $description_course_is = $_POST["descricao_is"];
    
    $duration_course = $_POST["duracao"];
    $duration_course_en = $_POST["duracao_en"];
    $duration_course_es = $_POST["duracao_es"];
    $duration_course_be = $_POST["duracao_be"];
    $duration_course_is = $_POST["duracao_is"];

    $credits_ects = $_POST["ects"];
    $credits_ects_en = $_POST["ects_en"];
    $credits_ects_es = $_POST["ects_es"];
    $credits_ects_be = $_POST["ects_be"];
    $credits_ects_is = $_POST["ects_is"];

    $languages = $_POST["idioma"];
    $languages_en = $_POST["idioma_en"];
    $languages_es = $_POST["idioma_es"];
    $languages_be = $_POST["idioma_be"];
    $languages_is = $_POST["idioma_is"];

    $course_fee = $_POST["propina"];
    $course_fee_en = $_POST["propina_en"];
    $course_fee_es = $_POST["propina_es"];
    $course_fee_be = $_POST["propina_be"];
    $course_fee_is = $_POST["propina_is"];

    $certification = $_POST["certificacao"];
    $certification_en = $_POST["certificacao_en"];
    $certification_es = $_POST["certificacao_es"];
    $certification_be = $_POST["certificacao_be"];
    $certification_is = $_POST["certificacao_is"];

    $target = $_POST["destinatarios"];
    $target_en = $_POST["destinatarios_en"];
    $target_es = $_POST["destinatarios_es"];
    $target_be = $_POST["destinatarios_be"];
    $target_is = $_POST["destinatarios_is"];

    $stages = $_POST["periodo"];
    $stages_en = $_POST["periodo_en"];
    $stages_es = $_POST["periodo_es"];
    $stages_be = $_POST["periodo_be"];
    $stages_is = $_POST["periodo_is"];

    $requirements = $_POST["requisitos"];
    $requirements_en = $_POST["requisitos_en"];
    $requirements_es = $_POST["requisitos_es"];
    $requirements_be = $_POST["requisitos_be"];
    $requirements_is = $_POST["requisitos_is"];

    $curriculum_plan = $_POST["curricular"];
    $curriculum_plan_en = $_POST["curricular_en"];
    $curriculum_plan_es = $_POST["curricular_es"];
    $curriculum_plan_be = $_POST["curricular_be"];
    $curriculum_plan_is = $_POST["curricular_is"];

    $vocational_dimension = $_POST["vocacional"];
    $vocational_dimension_en = $_POST["vocacional_en"];
    $vocational_dimension_es = $_POST["vocacional_es"];
    $vocational_dimension_be = $_POST["vocacional_be"];
    $vocational_dimension_is = $_POST["vocacional_is"];

    $support = $_POST["apoios"];
    $support_en = $_POST["apoios_en"];
    $support_es = $_POST["apoios_es"];
    $support_be = $_POST["apoios_be"];
    $support_is = $_POST["apoios_is"];

    $activities = $_POST["atividades"];
    $activities_en = $_POST["atividades_en"];
    $activities_es = $_POST["atividades_es"];
    $activities_be = $_POST["atividades_be"];
    $activities_is = $_POST["atividades_is"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssi', $name_course, $name_course_en, $name_course_es, $name_course_be, $name_course_is, $description_course, $description_course_en, $description_course_es, $description_course_be, $description_course_is, $duration_course, $duration_course_en, $duration_course_es, $duration_course_be, $duration_course_is, $credits_ects, $credits_ects_en, $credits_ects_es, $credits_ects_be, $credits_ects_is, $languages, $languages_en, $languages_es, $languages_be, $languages_is, $course_fee, $course_fee_en, $course_fee_es, $course_fee_be, $course_fee_is, $certification, $certification_en, $certification_es, $certification_be, $certification_is, $target, $target_en, $target_es, $target_be, $target_is, $stages, $stages_en, $stages_es, $stages_be, $stages_is, $requirements, $requirements_en, $requirements_es, $requirements_be, $requirements_is, $curriculum_plan, $curriculum_plan_en, $curriculum_plan_es, $curriculum_plan_be, $curriculum_plan_is, $vocational_dimension, $vocational_dimension_en, $vocational_dimension_es, $vocational_dimension_be, $vocational_dimension_is, $support, $support_en, $support_es, $support_be, $support_is, $activities, $activities_en, $activities_es, $activities_be, $activities_is, $idcourses);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../courses_heis_t.php");
            $_SESSION["course"] = 2;
        } else {
            header("Location: ../courses_heis_t.php");
            $_SESSION["course"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../courses_heis_t.php");
        $_SESSION["course"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../courses_heis_t.php");
    $_SESSION["course"] = 2;
}
