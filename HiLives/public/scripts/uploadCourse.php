<?php
session_start();
require_once "../connections/connection.php";

if (isset($_SESSION["idUser"]) && !empty($_POST["nomeuc"]) && !empty($_POST["uniuc"]) && !empty($_POST["data"])) {

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO done_cu (cu_name, university_name, date_cu, users_idusers) VALUES (?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssi', $cu_name, $university_name, $date_cu, $users_idusers);

        $cu_name = $_POST['nomeuc'];
        $university_name = $_POST['uniuc'];
        $date_cu = $_POST['data'];
        $users_idusers = $_SESSION['idUser'];

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            
            header("Location: ../pt/pages/profile.php");
            $_SESSION["doneCU"] = 2;
        } else {

            header("Location: ../pt/pages/uploadCourse.php");
            $_SESSION["doneCU"] = 1;
        }
    } else {

        header("Location: ../pt/pages/uploadCourse.php");
        $_SESSION["doneCU"] = 1;
    }
} else {

    header("Location: ../pt/pages/uploadCourse.php");
    $_SESSION["doneCU"] = 2;
}
