<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idexperiences = $_GET["xp"];

$query = "UPDATE experiences
SET description = ?, description_en = ?, description_es = ?, description_be = ?, description_is = ?
WHERE idexperiences = ?";

if (isset($_GET["xp"])) {
  
    $idexperiences = $_GET["xp"];

    $description = $_POST["descricao"];
    $description_en = $_POST["descricao_en"];
    $description_es = $_POST["descricao_es"];
    $description_be = $_POST["descricao_be"];
    $description_is = $_POST["descricao_is"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $description, $description_en, $description_es, $description_be, $description_is, $idexperiences);
        if (!mysqli_stmt_execute($stmt)) {        
           header("Location: ../stories_t.php");
            $_SESSION["xp"] = 2;
        } else {
            header("Location: ../stories_t.php");
            $_SESSION["xp"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else { 
       header("Location: ../stories_t.php");
        $_SESSION["xp"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../stories_t.php");
    $_SESSION["xp"] = 2;
}