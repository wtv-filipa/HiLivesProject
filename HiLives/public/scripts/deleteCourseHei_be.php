<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$query = "DELETE FROM courses 
WHERE idcourses = ?";

$query2 = "DELETE FROM courses_has_areas 
WHERE courses_idcourses = ?";

$query3 = "DELETE FROM users_has_courses 
WHERE courses_idcourses = ?";

if (isset($_GET["apaga"])) {
    $idCoursesHei = $_GET["apaga"];
    echo "estou aqui para apagar uma vaga de emprego";
    echo "</br> é a vaga $idCoursesHei";

    //First we delete from users_has courses
    if (mysqli_stmt_prepare($stmt, $query3)) {
        mysqli_stmt_bind_param($stmt, 'i', $idCoursesHei);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/allCoursesHeis.php");
            $_SESSION["course"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../be/pages/allCoursesHeis.php");
        $_SESSION["course"] = 2;
    }

    //Second we delete from courses_has_areas
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $idCoursesHei);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/allCoursesHeis.php");
            $_SESSION["course"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../be/pages/allCoursesHeis.php");
        $_SESSION["course"] = 2;
    }

    //Third we delete from courses
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idCoursesHei);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/allCoursesHeis.php");
            $_SESSION["course"] = 2;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../be/pages/allCoursesHeis.php");
        $_SESSION["course"] = 2;
    }
    mysqli_close($link);

    header("Location: ../be/pages/allCoursesHeis.php");
    $_SESSION["course"] = 4;
} else {
    header("Location: ../be/pages/allCoursesHeis.php");
    $_SESSION["course"] = 2;
}