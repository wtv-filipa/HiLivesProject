<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];

$query = "UPDATE users
SET name_user = ?, email_user = ?, contact_user = ?, birth_date = ?, description_be = ?, website = ?, facebook = ?, instagram = ?
WHERE idusers = ?";

$query2 = "DELETE FROM users_has_region 
WHERE users_idusers = ?";

$query3 = "INSERT INTO users_has_region (users_idusers, region_idregion)
VALUES (?, ?)";

if (isset($_GET["edit"]) && !empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["data_nasc"]) && !empty($_POST["phone"]) && !empty($_POST["site"]) && !empty($_POST["desc"]) && !empty($_POST["regiao"])) {

    $idUser = $_GET["edit"];
    $name_user = $_POST["nome"];
    $email_user = $_POST["email"];
    $contact_user = $_POST["phone"];
    $birth_date = $_POST["data_nasc"];
    $description = $_POST["desc"];
    $website = $_POST["site"];
    $facebook = $_POST["face"];
    $instagram = $_POST["insta"];
    $idRegion = $_POST["regiao"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $name_user, $email_user, $contact_user, $birth_date, $description, $website, $facebook, $instagram, $idUser);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_comp"] = 3;
        } else {
            //UPDATE USER REGIONS
            if (!empty($_POST["regiao"])) {
                //FIRST WE DELETE THE REGIONS
                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
                        $_SESSION["edit_comp"] = 3;
                    }
                    mysqli_stmt_close($stmt2);
                }

                //THEN WE ADD THE NEW REGIONS
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $idUser, $idRegion);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
                        $_SESSION["edit_comp"] = 3;
                    }

                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($link2);
            }
            header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
            $_SESSION["edit_comp"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
        $_SESSION["edit_comp"] = 3;
        echo "erro penultimo";
    }
    mysqli_close($link);
} else {
    header("Location: ../be/pages/editProfile.php?edit=$id_navegar");
    $_SESSION["edit_comp"] = 2;
    echo "erro ultimo";
}
