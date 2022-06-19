<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);

$idUser = $_GET["person"];

$query = "UPDATE users
SET work_xp_be = ?, description_be = ?, educ_lvl_ideduc_lvl = ?, edit_request = ?, status_edit = ?
WHERE idusers = ?";

//AREAS
$query2 = "DELETE FROM users_has_areas 
WHERE users_idusers = ?";

$query3 = "INSERT INTO users_has_areas (users_idusers, areas_idareas)
VALUES (?, ?)";

//CAPACITIES
$query4 = "DELETE FROM users_has_capacities 
WHERE users_idusers = ?";

$query5 = "INSERT INTO users_has_capacities (users_idusers, capacities_idcapacities)
VALUES (?, ?)";

//ENVIRONMENTS
$query6 = "DELETE FROM work_environment 
WHERE users_idusers = ?";

$query7 = "INSERT INTO work_environment (users_idusers, idwork_environment)
VALUES (?, ?)";

$queryDeleteMatch1 = "DELETE FROM users_has_courses 
WHERE users_idusers = ?";

$queryDeleteMatch2 = "SELECT id_match_vac 
FROM users_has_vacancies 
WHERE user_young = ?";

$queryDeleteMatch3 = "DELETE FROM learning_path_capacities 
WHERE fk_match_vac = ?";

$queryDeleteMatch4 = "DELETE FROM users_has_vacancies 
WHERE user_young = ?";

if (isset($_GET["person"]) && !empty($_POST["esc"]) && !empty($_POST["area"]) && !empty($_POST["exp_t"]) && !empty($_POST["capacity"]) && !empty($_POST["environment"]) && !empty($_POST["def"])) {
    $idUser = $_GET["person"];
    $lvl_educ = $_POST["esc"];
    $work_xp = $_POST["exp_t"];
    $description = $_POST["def"];
    $status_edit = 3;
    $edit_request = 0;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssiiii', $work_xp, $description, $lvl_educ, $edit_request, $status_edit, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
            $_SESSION["edit_jovem"] = 3;
        } else {
            //UPDATE USER AREAS
            if (!empty($_POST["area"])) {
                //FIRST WE DELETE THE AREAS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                        $_SESSION["edit_jovem"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW AREAS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idAreas);
                    foreach ($_POST["area"] as $idAreas) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                            $_SESSION["edit_jovem"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }

            //UPDATE USER CAPACITIES
            if (!empty($_POST["capacity"])) {
                //FIRST WE DELETE THE CAPACITIES
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                        $_SESSION["edit_jovem"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW CAPACITIES
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idCapacities);
                    foreach ($_POST["capacity"] as $idCapacities) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                            $_SESSION["edit_jovem"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }

            //UPDATE USER ENVIRONMENTS
            if (!empty($_POST["environment"])) {
                //FIRST WE DELETE THE ENVIRONMENTS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query6)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                        $_SESSION["edit_jovem"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW ENVIRONMENTS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query7)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idEnvironment);
                    foreach ($_POST["environment"] as $idEnvironment) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
                            $_SESSION["edit_jovem"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }

            // NOW WE DELETE THE MATCHS
            // MATCH COURSES
            $link2 = new_db_connection();
            $stmt2 = mysqli_stmt_init($link2);
            if (mysqli_stmt_prepare($stmt2, $queryDeleteMatch1)) {
                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                if (!mysqli_stmt_execute($stmt2)) {
                } else {
                    include "matchPersonCoursesEdit.php";
                }
                mysqli_stmt_close($stmt2);
            }
            //MATCH VACANCIES
            $link2 = new_db_connection();
            $stmt2 = mysqli_stmt_init($link2);
            if (mysqli_stmt_prepare($stmt2, $queryDeleteMatch2)) {
                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $id_match_vac);
                while (mysqli_stmt_fetch($stmt2)) {

                    if (mysqli_stmt_prepare($stmt3, $queryDeleteMatch3)) {
                        mysqli_stmt_bind_param($stmt3, 'i', $id_match_vac);
                        if (!mysqli_stmt_execute($stmt3)) {
                        }
                    }

                    if (mysqli_stmt_prepare($stmt3, $queryDeleteMatch4)) {
                        mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                        if (!mysqli_stmt_execute($stmt3)) {
                        }
                    }

                    include "matchPersonVacEdit.php";
                }
            }


            //SUCESS
            header("Location: ../be/pages/IndividualReqEditTutor.php?edit=$idUser");
            $_SESSION["edit"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
        $_SESSION["edit_jovem"] = 3;
    }
    mysqli_close($link);
} else {
    header("Location: ../be/pages/editProfileTutor.php?edit=$idUser");
    $_SESSION["edit_jovem"] = 2;
}
