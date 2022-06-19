<?php
session_start();

require_once("../connections/connection.php");
$link = new_db_connection();
$idUser = $_GET["vac"];

if ($_FILES['fileToUpload']['size'] != 0) {
    $stmt = mysqli_stmt_init($link);

    $target_dir = "../../admin/uploads/vid_vac/";
    $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["but_upload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: ../be/pages/uploadVacancy.php");
            $_SESSION["vac"] = 3;
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        header("Location: ../be/pages/uploadVacancy.php");
        $_SESSION["vac"] = 4;
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 70000000000) {
        header("Location: ../be/pages/uploadVacancy.php");
        $_SESSION["vac"] = 5;
        $uploadOk = 0;
    }

    if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4" && $vidFileType != "mov") {
        header("Location: ../be/pages/uploadVacancy.php");
        $_SESSION["vac"] = 6;
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header("Location: ../be/pages/uploadVacancy.php");
        $_SESSION["vac"] = 2;
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"]) && !empty($_POST["area"]) && !empty($_POST["jornada"]) && !empty($_POST["educ"]) && !empty($_POST["regiao"])) {

                $ficheiro = $idUser .  "_" . $_FILES["fileToUpload"]["name"];
                $query = "INSERT INTO content (content_type, content_name, users_idusers)
             VALUES (?,?,?)";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../be/pages/uploadVacancy.php");
                        $_SESSION["vac"] = 2;
                    } else {
                        $last_id = mysqli_insert_id($link);
                    }
                    $link1 = new_db_connection();
                    $stmt1 = mysqli_stmt_init($link1);
                    $query = "INSERT INTO vacancies (vacancy_name_be, description_vac_be, free_vac, requirements_be, company_id, region_idregion, workday_idworkday, content_idcontent, educ_lvl_ideduc_lvl, areas_idareas) VALUES (?,?,?,?,?,?,?,?,?,?)";

                    if (mysqli_stmt_prepare($stmt1, $query)) {
                        mysqli_stmt_bind_param($stmt1, 'ssssiiiiii', $vacancy_name, $description_vac, $free_vac, $requirements, $company_id, $region_idregion, $workday_idworkday, $content_idcontent, $educ_lvl_ideduc_lvl, $areas_idareas);

                        $vacancy_name = $_POST["nomevaga"];
                        $description_vac = $_POST["descricao"];
                        $free_vac = $_POST["numvagas"];
                        $requirements = $_POST["requisitos"];
                        $company_id = $_GET["vac"];
                        $region_idregion = $_POST["regiao"];
                        $workday_idworkday = $_POST["jornada"];
                        $content_idcontent = $last_id;
                        $educ_lvl_ideduc_lvl = $_POST["educ"];
                        $areas_idareas = $_POST["area"];

                        if (mysqli_stmt_execute($stmt1)) {
                            $idVacancies = mysqli_insert_id($link1);
                            if (isset($_POST["capacity"])) {

                                $link = new_db_connection();
                                $stmt = mysqli_stmt_init($link);
                                $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idvacancies, capacities_idcapacities)
                               VALUES (?, ?)";
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);

                                    foreach ($_POST["capacity"] as $capacities_idcapacities) {
                                        if (!mysqli_stmt_execute($stmt)) {
                                            header("Location: ../be/pages/uploadVacancy.php");
                                            $_SESSION["vac"] = 2;
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                }
                            } else {
                                header("Location: ../be/pages/uploadVacancy.php");
                                $_SESSION["vac"] = 1;
                            }
                            /*include "match_comp.php";*/
                          
                            header("Location: ../be/pages/allVacanciesComp.php");;
                            $_SESSION["vac"] = 1;
                        } else {
                            header("Location: ../be/pages/uploadVacancy.php");
                              $_SESSION["vac"] = 2;
                        }
                    }
                }
            } else {
                header("Location: ../be/pages/uploadVacancy.php");
                $_SESSION["vac"] = 2;
            }
        } else {
            header("Location: ../be/pages/uploadVacancy.php");
            $_SESSION["vac"] = 2;
        }
    }
} else {
    if (!empty($_GET["vac"]) && !empty($_POST["nomevaga"]) && !empty($_POST["descricao"]) && !empty($_POST["numvagas"]) && !empty($_POST["requisitos"]) && !empty($_POST["area"]) && !empty($_POST["jornada"]) && !empty($_POST["educ"]) && !empty($_POST["regiao"])) {
        $idUser = $_GET["vac"];
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO vacancies (vacancy_name_be, description_vac_be, free_vac, requirements_be, company_id, region_idregion, workday_idworkday, educ_lvl_ideduc_lvl, areas_idareas) VALUES (?,?,?,?,?,?,?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssiiiii', $vacancy_name, $description_vac, $free_vac, $requirements, $company_id, $region_idregion, $workday_idworkday, $educ_lvl_ideduc_lvl, $areas_idareas);

            $vacancy_name = $_POST["nomevaga"];
            $description_vac = $_POST["descricao"];
            $free_vac = $_POST["numvagas"];
            $requirements = $_POST["requisitos"];
            $company_id = $_GET["vac"];
            $region_idregion = $_POST["regiao"];
            $workday_idworkday = $_POST["jornada"];
            $educ_lvl_ideduc_lvl = $_POST["educ"];
            $areas_idareas = $_POST["area"];

            if (mysqli_stmt_execute($stmt)) {
                $idVacancies = mysqli_insert_id($link);
                if (isset($_POST["capacity"])) {

                    $query2 = "INSERT INTO vacancies_has_capacities (vacancies_idvacancies, capacities_idcapacities)
                              VALUES (?, ?)";

                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'ii', $idVacancies, $capacities_idcapacities);
                        foreach ($_POST["capacity"] as $capacities_idcapacities) {
                            if (!mysqli_stmt_execute($stmt)) {
                                header("Location: ../be/pages/uploadVacancy.php");
                                 $_SESSION["vac"] = 2;
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    header("Location: ../be/pages/uploadVacancy.php");
                    $_SESSION["vac"] = 2;
                }

                /*include "match_comp.php";*/

                header("Location: ../be/pages/allVacanciesComp.php");
                $_SESSION["vac"] = 1;
            } else {
                header("Location: ../be/pages/uploadVacancy.php");
                $_SESSION["vac"] = 2;
            }
        }
    } else {
        header("Location: ../be/pages/uploadVacancy.php");
        $_SESSION["vac"] = 1;
    }
}
