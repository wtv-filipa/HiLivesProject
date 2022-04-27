<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE users
SET name_user = ?, email_user = ?, contact_user = ?, address = ?, website = ?, learning_type_idlearning_type = ?, institution_type_idinstitution_type = ?
WHERE idusers = ?";

$query2 = "DELETE FROM users_has_region 
WHERE users_idusers = ?";

$query3 = "INSERT INTO users_has_region (users_idusers, region_idregion)
VALUES (?, ?)";

if (isset($_GET["edit"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["site"]) && !empty($_POST["phone"]) && !empty($_POST["endereco"]) && !empty($_POST["ensino"]) && !empty($_POST["instituicao"]) && !empty($_POST["regiao"])) {
    $idUser = $_GET["edit"];
    $name_user = $_POST['nome'];
    $email_user = $_POST['email'];
    $contact_user = $_POST['phone'];
    $address = $_POST["endereco"];
    $website = $_POST["site"];
    $learning_type_idlearning_type = $_POST["ensino"];
    $institution_type_idinstitution_type = $_POST["instituicao"];
    $idRegion = $_POST["regiao"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssiii', $name_user, $email_user, $contact_user, $address, $website,$learning_type_idlearning_type, $institution_type_idinstitution_type, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_hei"] = 3;
        } else {
            //UPDATE USER REGIONS
            if (!empty($_POST["regiao"])) {
                //FIRST WE DELETE THE REGIONS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
                        $_SESSION["edit_hei"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW REGIONS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idRegion);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
                        $_SESSION["edit_hei"] = 3;
                    }

                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }
            header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_hei"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
        $_SESSION["edit_hei"] = 3;
    }
    mysqli_close($link);
} else {
    header("Location: ../pt/pages/editProfile.php?edit=$id_navegar");
    $_SESSION["edit_hei"] = 2;
}
