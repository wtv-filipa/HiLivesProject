<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["data_nasc"]) && !empty($_POST["phone"])) {

    $type = 10;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, password, user_type_iduser_type) VALUES (?, ?, ?, ?, ?, ?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name_user, $email_user, $contact_user, $birth_date, $password, $user_type_iduser_type);

        $name_user = $_POST['nome'];
        $email_user = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_type_iduser_type = $type;

        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
        }

        /*Region*/
        if (!empty($_POST["regiao"])) {
            $query2 = "INSERT INTO users_has_region (users_idusers, region_idregion)
                       VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query2)) {
                mysqli_stmt_bind_param($stmt, 'ii', $last_id, $idRegion);
                foreach ($_POST["regiao"] as $idRegion) {

                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../is/pages/registerPerson.php");
                        $_SESSION["register"] = 1;
                    }
                }
            }
        } else {
            header("Location: ../is/pages/registerPerson.php");
            $_SESSION["register"] = 2;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        header("Location: ../is/pages/messageRegister.php");
        $_SESSION["login"] = 1;
    } else {
        header("Location: ../is/pages/registerPerson.php");
        $_SESSION["register"] = 1;
    }
} else {
    header("Location: ../is/pages/registerPerson.php");
    $_SESSION["register"] = 2;
}
