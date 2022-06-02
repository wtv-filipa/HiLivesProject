<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE courses
SET name_course_en = ?, description_course_en = ?, website_course = ?, facebook_course = ?, instagram_course = ?, course_director = ?, email_course = ?, phone_course = ?, duration_course_en = ?, credits_ects_en = ?, languages_en = ?, course_fee_en = ?, certification_en = ?, target_en = ?, number_vac = ?, stages_en = ?, requirements_en = ?, curriculum_plan_en = ?, vocational_dimension_en = ?, support_en = ?, activities_en = ?, course_regime_idcourse_regime = ?, accommodation_idaccommodation = ?
WHERE idcourses = ?";

$query2 = "DELETE FROM courses_has_areas 
WHERE courses_idcourses = ?";

$query3 = "INSERT INTO courses_has_areas (courses_idcourses, areas_idareas)
VALUES (?, ?)";

if (isset($_GET["course"]) && !empty($_POST["nome"]) && !empty($_POST["descricao"]) && !empty($_POST["website"]) && !empty($_POST["diretor"]) && !empty($_POST["email"]) && !empty($_POST["telefone"]) && !empty($_POST["duracao"]) && !empty($_POST["ects"]) && !empty($_POST["regime"]) && !empty($_POST["idioma"]) && !empty($_POST["propina"]) && !empty($_POST["certificacao"]) && !empty($_POST["destinatarios"]) && !empty($_POST["vagas"]) && !empty($_POST["periodo"]) && !empty($_POST["requisitos"]) && !empty($_POST["curricular"]) && !empty($_POST["vocacional"]) && !empty($_POST["atividades"]) && !empty($_POST["apoios"]) && !empty($_POST["alojamento"])) {
    $idCourse = $_GET["course"];
    $name_course = $_POST["nome"];
    $description_course = $_POST["descricao"];
    $website_course = $_POST["website"];
    $instagram_course = $_POST['facebook'];
    $facebook_course = $_POST['instagram'];
    $course_director = $_POST["diretor"];
    $email_course = $_POST["email"];
    $phone_course = $_POST["telefone"];
    $duration_course = $_POST["duracao"];
    $credits_ects = $_POST["ects"];
    $languages = $_POST["idioma"];
    $course_fee = $_POST["propina"];
    $certification = $_POST["certificacao"];
    $target = $_POST["destinatarios"];
    $number_vac = $_POST["vagas"];
    $stages = $_POST["periodo"];
    $requirements = $_POST["requisitos"];
    $curriculum_plan = $_POST["curricular"];
    $vocational_dimension = $_POST["vocacional"];
    $support = $_POST["apoios"];
    $activities = $_POST["atividades"];
    $course_regime_idcourse_regime = $_POST["regime"];
    $accommodation_idaccommodation = $_POST["alojamento"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssiii', $name_course, $description_course, $website_course, $facebook_course, $instagram_course, $course_director, $email_course, $phone_course, $duration_course, $credits_ects, $languages, $course_fee, $certification, $target, $number_vac, $stages, $requirements, $curriculum_plan, $vocational_dimension, $support, $activities, $course_regime_idcourse_regime, $accommodation_idaccommodation, $idCourse);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../en/pages/editCourseHei.php?course=$idCourse");
            $_SESSION["course"] = 1;
            echo "erro primeiro";
        } else {
            //UPDATE COURSES AREAS
            if (!empty($_POST["area"])) {
                //FIRST WE DELETE THE AREAS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idCourse);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../en/pages/editCourseHei.php?course=$idCourse");
                        $_SESSION["course"] = 1;
                        echo "erro apagar areas";
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW AREAS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idCourse, $idareas);
                    foreach ($_POST["area"] as $idareas) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../en/pages/editCourseHei.php?course=$idCourse");
                            $_SESSION["course"] = 1;
                            echo "erro inserir areas";
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }
            header("Location: ../en/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../en/pages/editCourseHei.php?course=$idCourse");
        $_SESSION["course"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../en/pages/editCourseHei.php?course=$idCourse");
    $_SESSION["course"] = 2;
}
