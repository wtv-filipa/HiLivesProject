<?php

if (!empty($_POST["email"]) && !empty($_POST["password"])) {

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "SELECT idusers, email_user, password, user_type_iduser_type, type_user, active, active_person, login
                FROM users 
                INNER JOIN user_type ON users.User_type_idUser_type = user_type.idUser_type
                WHERE email_user LIKE ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $email_user);
        $email_user = $_POST['email'];
        $password = $_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idusers, $email_user, $passwordx, $user_type_iduser_type, $type_user, $active, $active_person, $login);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $passwordx)) {
                if ($active == 1) {
                    session_start();
                    $_SESSION["email"] = $email_user;
                    $_SESSION["type"] = $user_type_iduser_type;
                    $_SESSION["idUser"] = $idusers;
                    $link3 = new_db_connection();

                    if ($type_user == "Pessoa" and $active_person == 1) {
                        include "matchPerson.php";
                        if ($login == 0) {
                            header("Location: ../is/pages/homePerson.php");
                        } else {
                            header("Location: ../is/pages/homePerson.php");
                        }
                    } else if ($type_user == "Pessoa" and $active_person == 0) {
                        include "logout.php";
                        header("Location: ../is/pages/messageRegister.php");
                    } else if ($type_user == "Empresa") {
                        include "matchComp.php";
                        header("Location: ../is/pages/homeComp.php");
                    } else if ($type_user == "Universidade") {
                        include "matchHei.php";
                        header("Location: ../is/pages/homeHei.php");
                    } else if ($type_user == "Tutor") {
                        header("Location: ../is/pages/homeTutor.php");
                    } else if ($type_user == "Admin") {
                        header("Location: ../../admin/index.php");
                    }
                } else {
                    session_start();

                    header("Location: ../is/pages/login.php");
                    $_SESSION["login"] = 1;
                }
            } else {
                session_start();

                header("Location: ../is/pages/login.php");
                $_SESSION["login"] = 3;
            }
        } else {
            session_start();

            header("Location: ../is/pages/login.php");
            $_SESSION["login"] = 3;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        session_start();

        header("Location: ../is/pages/login.php");
        $_SESSION["login"] = 1;
    }
} else {
    session_start();

    header("Location: ../is/pages/login.php");
    $_SESSION["login"] = 2;
}
