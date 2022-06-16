<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idVac = $_GET["vac"];

$query = "UPDATE vacancies
SET vacancy_name_en = ?, vacancy_name_es = ?, vacancy_name_be = ?, vacancy_name_is = ?, description_vac_en = ?, description_vac_es = ?, description_vac_be = ?, description_vac_is = ?, requirements_en = ?, requirements_es = ?, requirements_be = ?, requirements_is = ?
WHERE idvacancies = ?";

if (isset($_GET["vac"])) {
  
    $idVac = $_GET["vac"];

    $vacancy_name = $_POST["nomevaga"];
    $vacancy_name_en = $_POST["nomevaga_en"];
    $vacancy_name_es = $_POST["nomevaga_es"];
    $vacancy_name_be = $_POST["nomevaga_be"];
    $vacancy_name_is = $_POST["nomevaga_is"];

    $description_vac = $_POST["descricao"];
    $description_vac_en = $_POST["descricao_en"];
    $description_vac_es = $_POST["descricao_es"];
    $description_vac_be = $_POST["descricao_be"];
    $description_vac_is = $_POST["descricao_is"];

    $requirements = $_POST["requisitos"];
    $requirements_en = $_POST["requisitos_en"];
    $requirements_es = $_POST["requisitos_es"];
    $requirements_be = $_POST["requisitos_be"];
    $requirements_is = $_POST["requisitos_is"];   

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssssi', $vacancy_name_en, $vacancy_name_es, $vacancy_name_be, $vacancy_name_is, $description_vac_en, $description_vac_es, $description_vac_be, $description_vac_is, $requirements_en, $requirements_es, $requirements_be, $requirements_is, $idVac);
        if (!mysqli_stmt_execute($stmt)) {        
           header("Location: ../vac_t.php");
            $_SESSION["vac"] = 2;
        } else {
            header("Location: ../vac_t.php");
            $_SESSION["vac"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else { 
       header("Location: ../vac_t.php");
        $_SESSION["vac"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../vac_t.php");
    $_SESSION["vac"] = 2;
}