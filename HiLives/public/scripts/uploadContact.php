<?php
session_start();
require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "INSERT INTO contact (name, email, suggestion, users_idusers) VALUES (?,?,?,?)";

if (!empty($_POST["nome_user"]) && !empty($_POST["email"]) && !empty($_POST["descricao"])) {

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $suggestion, $users_idusers);

        $name = $_POST['nome_user'];
        $email = $_POST['email'];
        $suggestion = $_POST['descricao'];
        $users_idusers = $_SESSION["idUser"];

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            header("Location: ../pt/pages/questionForm.php");
            $_SESSION["question"] = 3;
        } else {
            header("Location: ../pt/pages/questionForm.php");
            $_SESSION["question"] = 1;
        }
    } else {
        header("Location: ../pt/pages/questionForm.php");
        $_SESSION["question"] = 1;
    }
} else {
    header("Location: ../pt/pages/questionForm.php");
    $_SESSION["question"] = 2;
}

