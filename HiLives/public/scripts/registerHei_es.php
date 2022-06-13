<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["site"]) && !empty($_POST["phone"]) && !empty($_POST["endereco"]) && !empty($_POST["ensino"]) && !empty($_POST["instituicao"])) {

    $type = 13;

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "INSERT INTO users (name_user, email_user, contact_user, password, address, website, user_type_iduser_type, learning_type_idlearning_type, institution_type_idinstitution_type) VALUES (?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssiii', $name_user, $email_user, $contact_user, $password, $address, $website, $user_type_iduser_type, $learning_type_idlearning_type, $institution_type_idinstitution_type);

        $name_user = $_POST['nome'];
        $email_user = $_POST['email'];
        $contact_user = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $address = $_POST["endereco"];
        $website = $_POST["site"];
        $user_type_iduser_type = $type;
        $learning_type_idlearning_type = $_POST["ensino"];
        $institution_type_idinstitution_type = $_POST["instituicao"];


        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);

            if (!empty($_POST["regiao"])) {
                $idRegion = $_POST["regiao"];

                $query2 = "INSERT INTO users_has_region (users_idusers, region_idregion) VALUES (?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $last_id, $idRegion);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../es/pages/registerHei.php");
                        $_SESSION["register"] = 1;
                    }

                    mysqli_stmt_close($stmt2);
                }
            } else {

                header("Location: ../es/pages/registerHei.php");
                $_SESSION["register"] = 2;
            }

            header("Location: ../es/pages/login.php");
            $_SESSION["login"] = 4;
        } else {

            header("Location: ../es/pages/registerHei.php");
            $_SESSION["register"] = 1;
        }
    } else {

        header("Location: ../es/pages/registerHei.php");
        $_SESSION["register"] = 1;
        mysqli_close($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    mysqli_close($link2);
} else {

    header("Location: ../es/pages/registerHei.php");
    $_SESSION["register"] = 2;
}
