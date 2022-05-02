<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$idCreate = $_GET["create"];

$query = "UPDATE users 
SET description = ?, work_xp = ?, educ_lvl_ideduc_lvl = ?, active_person = ?, status_create = ?
WHERE idusers = ?";

$query2 = "INSERT INTO users_has_areas (users_idusers, areas_idareas) 
VALUES (?,?)";

$query3 = "INSERT INTO users_has_capacities (users_idusers, capacities_idcapacities) 
VALUES (?,?)";

$query4 = "INSERT INTO users_has_work_environment (users_idusers, work_environment_idwork_environment) 
VALUES (?,?)";

if (isset($_GET["create"]) && !empty($_POST["esc"]) && !empty($_POST["area"]) && !empty($_POST["exp_t"]) && !empty($_POST["capacity"]) && !empty($_POST["environment"]) && !empty($_POST["def"])) {

    $idCreate = $_GET["create"];
    $description = $_POST["def"];
    $work_xp = $_POST["exp_t"];
    $educ_lvl_ideduc_lvl = $_POST["esc"];
    $active_person = 1;
    $status_create = 3;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssiiii', $description, $work_xp, $educ_lvl_ideduc_lvl, $active_person, $status_create, $idCreate);
        if (mysqli_stmt_execute($stmt)) {
            //AREAS
            if (!empty($_POST["area"])) {
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idCreate, $idAreas);

                    foreach ($_POST["area"] as $idAreas) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                            $_SESSION["create"] = 1;
                        }
                    }
                }
            } else {
                header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                $_SESSION["create"] = 2;
            }

            //CAPACITIES
            if (!empty($_POST["capacity"])) {
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idCreate, $capacities);
                    foreach ($_POST["capacity"] as $capacities) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                            $_SESSION["create"] = 1;
                        }
                    }
                }
            } else {
                header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                $_SESSION["create"] = 2;
            }

            //ENVIRONMENTS
            if (!empty($_POST["environment"])) {
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idCreate, $environment);

                    foreach ($_POST["environment"] as $environment) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                            $_SESSION["create"] = 1;
                        }
                    }
                }
            } else {
                header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
                $_SESSION["create"] = 2;
            }

            //SUCESSO
            header("Location: ../pt/pages/IndividualReqCreateTutor.php?create=$idCreate");
            $_SESSION["create"] = 1;
        } else {
            header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
            $_SESSION["create"] = 1;
        }
    } else {
        header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
        $_SESSION["create"] = 1;
        mysqli_close($link);
    }
} else {
    header("Location: ../pt/pages/createProfileTutor.php?create=$idCreate");
    $_SESSION["create"] = 2;
}
