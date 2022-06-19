<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE users
SET name_user = ?, email_user = ?, contact_user = ?, birth_date = ?
WHERE idusers = ?";

$query2 = "DELETE FROM users_has_region 
WHERE users_idusers = ?";

$query3 = "INSERT INTO users_has_region (users_idusers, region_idregion)
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

if (isset($_GET["id"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_nasc"]) && !empty($_POST["phone"])) {
    $idUser = $_GET["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tlm = $_POST["phone"];
    $data_nasc = $_POST["data_nasc"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $tlm, $data_nasc, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_jovem"] = 3;
        } else {
            //UPDATE USER REGIONS
            if (!empty($_POST["regiao"])) {
                //FIRST WE DELETE THE REGIONS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
                        $_SESSION["edit_jovem"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW REGIONS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idRegion);
                    foreach ($_POST["regiao"] as $idRegion) {
                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
                            $_SESSION["edit_jovem"] = 3;
                        }
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }

            //NOW WE DELETE THE MATCHS
            //MATCH COURSES
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
            header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_jovem"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
        $_SESSION["edit_jovem"] = 3;
    }
    mysqli_close($link);
} else {
    header("Location: ../is/pages/editProfile.php?edit=$id_navegar");
    $_SESSION["edit_jovem"] = 2;
}
