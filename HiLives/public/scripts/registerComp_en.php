<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["data_nasc"]) && !empty($_POST["phone"]) && !empty($_POST["site"]) && !empty($_POST["desc"])) {

    $type = 7;

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, description_en, password, website, facebook, instagram, user_type_iduser_type) VALUES (?,?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $name_user, $email_user, $contact_user, $birth_date, $description, $password, $website, $facebook, $instagram, $user_type_iduser_type);

        $name_user = $_POST['nome'];
        $email_user = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $description = $_POST["desc"];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $website = $_POST["site"];
        $facebook = $_POST["face"];
        $instagram = $_POST["insta"];
        $user_type_iduser_type = $type;

        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);

            if (!empty($_POST["regiao"])) {
                $idRegion = $_POST["regiao"];
                $query2 = "INSERT INTO users_has_region (users_idusers, region_idregion) VALUES (?, ?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $last_id, $idRegion);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../en/pages/register_comp.php");
                        $_SESSION["register"] = 1;
                    }

                    mysqli_stmt_close($stmt2);
                } else {
                    header("Location: ../en/pages/register_comp.php");
                    $_SESSION["register"] = 1;
                }
            } else {
                header("Location: ../en/pages/register_comp.php");
                $_SESSION["register"] = 2;
            }

            header("Location: ../en/pages/login.php");
            $_SESSION["login"] = 4;
        } else {

            header("Location: ../en/pages/register_comp.php");
            $_SESSION["register"] = 1;
        }
    } else {

        header("Location: ../en/pages/register_comp.php");
        $_SESSION["register"] = 1;
        mysqli_close($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    mysqli_close($link2);
} else {

    header("Location: ../en/pages/register_comp.php");
    $_SESSION["register"] = 2;
}
