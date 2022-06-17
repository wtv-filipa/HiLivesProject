<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "UPDATE users
SET description = ?, description_en = ?, description_es = ?, description_be = ?, description_is = ?, work_xp = ?, work_xp_en = ?, work_xp_es = ?, work_xp_be = ?, work_xp_is = ?
WHERE idusers = ?";

$query2 = "UPDATE users
SET description = ?, description_en = ?, description_es = ?, description_be = ?, description_is = ?
WHERE idusers = ?";

if (isset($_GET["user"]) && isset($_GET["type"])) {

    $iduser = $_GET["user"];
    $type_user = $_GET["type"];

    if ($type_user == "Pessoa") {
        $description = $_POST["descricao"];
        $description_en = $_POST["descricao_en"];
        $description_es = $_POST["descricao_es"];
        $description_be = $_POST["descricao_be"];
        $description_is = $_POST["descricao_is"];

        $work_xp = $_POST["exp_t"];
        $work_xp_en = $_POST["exp_t_en"];
        $work_xp_es = $_POST["exp_t_es"];
        $work_xp_be = $_POST["exp_t_be"];
        $work_xp_is = $_POST["exp_t_is"];

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssssssssi', $description, $description_en, $description_es, $description_be, $description_is, $work_xp, $work_xp_en, $work_xp_es, $work_xp_be, $work_xp_is, $iduser);
            if (!mysqli_stmt_execute($stmt)) {
                header("Location: ../users_t.php");
                $_SESSION["user"] = 2;
            } else {
                header("Location: ../users_t.php");
                $_SESSION["user"] = 1;
                mysqli_stmt_close($stmt);
            }
        } else {
            header("Location: ../users_t.php");
            $_SESSION["user"] = 2;
        }
    } else if ($type_user == "Empresa") {

        $description = $_POST["descricao"];
        $description_en = $_POST["descricao_en"];
        $description_es = $_POST["descricao_es"];
        $description_be = $_POST["descricao_be"];
        $description_is = $_POST["descricao_is"];

        if (mysqli_stmt_prepare($stmt, $query2)) {
            mysqli_stmt_bind_param($stmt, 'sssssi', $description, $description_en, $description_es, $description_be, $description_is, $iduser);
            if (!mysqli_stmt_execute($stmt)) {
                header("Location: ../users_t.php");
                $_SESSION["user"] = 2;
            } else {
                header("Location: ../users_t.php");
                $_SESSION["user"] = 1;
                mysqli_stmt_close($stmt);
            }
        } else {
            header("Location: ../users_t.php");
            $_SESSION["user"] = 2;
        }
    } else {
        header("Location: ../users_t.php");
        $_SESSION["user"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../users_t.php");
    $_SESSION["user"] = 2;
}
