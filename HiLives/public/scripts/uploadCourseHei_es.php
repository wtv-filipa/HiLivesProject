<?php
session_start();
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_GET["course"];

if (!empty($_POST["nome"]) && !empty($_POST["descricao"]) && !empty($_POST["website"]) && !empty($_POST["diretor"]) && !empty($_POST["email"]) && !empty($_POST["telefone"]) && !empty($_POST["regiao"]) && !empty($_POST["duracao"]) && !empty($_POST["ects"]) && !empty($_POST["regime"]) && !empty($_POST["idioma"]) && !empty($_POST["propina"]) && !empty($_POST["certificacao"]) && !empty($_POST["destinatarios"]) && !empty($_POST["vagas"]) && !empty($_POST["periodo"]) && !empty($_POST["requisitos"]) && !empty($_POST["curricular"]) && !empty($_POST["vocacional"]) && !empty($_POST["atividades"]) && !empty($_POST["apoios"]) && !empty($_POST["alojamento"])) {


    $query = "INSERT INTO courses (name_course_es, description_course_es, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course_es, credits_ects_es, languages_es, course_fee_es, certification_es, target_es, number_vac, stages_es, requirements_es, curriculum_plan_es, vocational_dimension_es, support_es, activities_es, course_regime_idcourse_regime, accommodation_idaccommodation, users_idusers, region_idregion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    /*inserir*/
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssiiii', $name_course, $description_course, $website_course, $facebook_course, $instagram_course, $course_director, $email_course, $phone_course, $duration_course, $credits_ects, $languages, $course_fee, $certification, $target, $number_vac, $stages, $requirements, $curriculum_plan, $vocational_dimension, $support, $activities, $course_regime_idcourse_regime, $accommodation_idaccommodation, $users_idusers, $region_idregion);

        $name_course = $_POST['nome'];
        $description_course = $_POST['descricao'];
        $website_course = $_POST['website'];
        $instagram_course = $_POST['facebook'];
        $facebook_course = $_POST['instagram'];
        $course_director = $_POST['diretor'];
        $email_course = $_POST['email'];
        $phone_course = $_POST['telefone'];
        $duration_course = $_POST['duracao'];
        $credits_ects = $_POST['ects'];
        $languages = $_POST['idioma'];
        $course_fee = $_POST['propina'];
        $certification = $_POST['certificacao'];
        $target = $_POST['destinatarios'];
        $number_vac = $_POST['vagas'];
        $stages = $_POST['periodo'];
        $requirements = $_POST['requisitos'];
        $curriculum_plan = $_POST['curricular'];
        $vocational_dimension = $_POST['vocacional'];
        $support = $_POST['apoios'];
        $activities = $_POST['atividades'];
        $course_regime_idcourse_regime = $_POST['regime'];
        $accommodation_idaccommodation = $_POST['alojamento'];
        $users_idusers = $idUser;
        $region_idregion = $_POST['regiao'];

        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
        }

        /*AREAS*/
        if (!empty($_POST["area"])) {
            $query3 = "INSERT INTO courses_has_areas (courses_idcourses, areas_idareas)
        VALUES (?, ?)";
            if (mysqli_stmt_prepare($stmt, $query3)) {
                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idareas);

                foreach ($_POST["area"] as $idareas) {
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location:../es/pages/uploadCourseHei.php");
                        $_SESSION["course"] = 2;
                    }
                }
            }
        } else {
            header("Location:../es/pages/uploadCourseHei.php");
            $_SESSION["course"] = 1;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

        header("Location:../es/pages/allCoursesHeis.php");
        $_SESSION["course"] = 1;
    } else {
        header("Location:../es/pages/uploadCourseHei.php");
        $_SESSION["course"] = 2;
    }
    /************/
} else {
    header("Location:../es/pages/uploadCourseHei.php");
    $_SESSION["course"] = 1;
}
