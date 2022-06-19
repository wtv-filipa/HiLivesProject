<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$query = "DELETE FROM vacancies 
WHERE idvacancies = ?";

$query2 = "DELETE FROM vacancies_has_capacities 
WHERE vacancies_idvacancies = ?";

$query3 = "SELECT id_match_vac 
FROM users_has_vacancies 
WHERE vacancies_idvacancies = ?";

$query4 = "DELETE FROM learning_path_capacities 
WHERE fk_match_vac = ?";

$query5 = "DELETE FROM users_has_vacancies 
WHERE vacancies_idvacancies = ?";

if (isset($_GET["apaga"])) {
    $idVacancies = $_GET["apaga"];
    echo "estou aqui para apagar uma vaga de emprego";
    echo "</br> é a vaga $idVacancies";

    if (mysqli_stmt_prepare($stmt, $query3)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_match_vac);
        while (mysqli_stmt_fetch($stmt)) {

            if (mysqli_stmt_prepare($stmt2, $query4)) {
                mysqli_stmt_bind_param($stmt2, 'i', $id_match_vac);
                if (!mysqli_stmt_execute($stmt2)) {
                    header("Location: ../be/pages/allVacanciesComp.php");
                    $_SESSION["vac"] = 2;
                }
            } else {
                header("Location: ../be/pages/allVacanciesComp.php");
                $_SESSION["vac"] = 2;
            }

            if (mysqli_stmt_prepare($stmt2, $query5)) {
                mysqli_stmt_bind_param($stmt2, 'i', $idVacancies);
                if (!mysqli_stmt_execute($stmt2)) {
                    header("Location: ../be/pages/allVacanciesComp.php");
                    $_SESSION["vac"] = 2;
                }
            } else {
                header("Location: ../be/pages/allVacanciesComp.php");
                $_SESSION["vac"] = 2;
            }
        }
    }

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/allVacanciesComp.php");
            $_SESSION["vac"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../be/pages/allVacanciesComp.php");
        $_SESSION["vac"] = 2;
    }

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/allVacanciesComp.php");
            $_SESSION["vac"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../be/pages/allVacanciesComp.php");
        $_SESSION["vac"] = 2;
    }
    mysqli_close($link);

    header("Location: ../be/pages/allVacanciesComp.php");
    $_SESSION["vac"] = 4;
} else {
    header("Location: ../be/pages/allVacanciesComp.php");
    $_SESSION["vac"] = 2;
}
