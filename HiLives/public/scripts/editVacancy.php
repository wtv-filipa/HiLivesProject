<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE vacancies
SET vacancy_name = ?, description_vac = ?, free_vac = ?, requirements = ?, region_idregion = ?, workday_idworkday = ?, educ_lvl_ideduc_lvl = ?, areas_idareas = ?
WHERE idvacancies = ?";

$query2 = "DELETE FROM vacancies_has_capacities 
WHERE vacancies_idvacancies = ?";

$query3 = "INSERT INTO vacancies_has_capacities (vacancies_idvacancies, capacities_idcapacities)
VALUES (?, ?)";

if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"]) && !empty($_POST["area"]) && !empty($_POST["jornada"]) && !empty($_POST["educ"]) && !empty($_POST["regiao"])) {
    
    $vacancy_name = $_POST["nomevaga"];
    $description_vac = $_POST["descricao"];
    $free_vac = $_POST["numvagas"];
    $requirements = $_POST["requisitos"];
    $vacancy_id = $_GET["vac"];
    $region_idregion = $_POST["regiao"];
    $workday_idworkday = $_POST["jornada"];
    $educ_lvl_ideduc_lvl = $_POST["educ"];
    $areas_idareas = $_POST["area"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancy_name, $description_vac, $free_vac, $requirements, $region_idregion, $workday_idworkday, $educ_lvl_ideduc_lvl, $areas_idareas, $vacancy_id);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../pt/pages/editVacancy.php?vac=$vacancy_id");
            $_SESSION["vac"] = 1;
        } else {
            //UPDATE COURSES AREAS
            if (!empty($_POST["area"])) {
                //FIRST WE DELETE THE AREAS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $vacancy_id);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../pt/pages/editVacancy.php?vac=$vacancy_id");
                        $_SESSION["vac"] = 1;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW AREAS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $vacancy_id, $idcapacities);
                    foreach ($_POST["capacity"] as $idcapacities) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../pt/pages/editVacancy.php?vac=$vacancy_id");
                            $_SESSION["vac"] = 1;
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }
            header("Location: ../pt/pages/profile.php?user=$id_navegar");
            $_SESSION["profile"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../pt/pages/editVacancy.php?vac=$vacancy_id");
        $_SESSION["vac"] = 1;
    }
    mysqli_close($link);
} else {
    header("Location: ../pt/pages/editVacancy.php?vac=$vacancy_id");
    $_SESSION["vac"] = 2;
}