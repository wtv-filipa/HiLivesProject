<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$id_navegar = $_SESSION["idUser"];

if (isset($_GET["xp"])) {
    $idUser = $_GET["xp"];
    if (!empty($_POST["descricao"]) && $_FILES["fileToUpload"]['size'] != 0) {
        $target_dir = "../../admin/uploads/experiences/";
        $target_file = $target_dir . $idUser .  "_" . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $vidFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST["but_upload"])) {
            $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                header("Location: ../pt/pages/uploadStory.php");
                $_SESSION["xp_jovem"] = 1;
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            header("Location: ../pt/pages/uploadStory.php");
            $_SESSION["xp_jovem"] = 2;
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 70000000000) {
            header("Location: ../pt/pages/uploadStory.php");
            $_SESSION["xp_jovem"] = 4;
            $uploadOk = 0;
        }
        
        if ($vidFileType != "avi" && $vidFileType != "wmv" && $vidFileType != "mp4" && $vidFileType != "mov" && $vidFileType != "jpg" && $vidFileType != "png" && $vidFileType != "svg" && $vidFileType != "ogg" && $vidFileType != "mp3" && $vidFileType != "wav") {
            header("Location: ../pt/pages/uploadStory.php");
            $_SESSION["xp_jovem"] = 5;
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            header("Location: ../pt/pages/uploadStory.php");
            $_SESSION["xp_jovem"] = 6;
            echo "uploadOK é 0";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $ficheiro =  $idUser .  "_" . $_FILES["fileToUpload"]["name"];
                $query = "INSERT INTO content (content_type, content_name, users_idusers)
                VALUES (?,?,?)";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssi', $vidFileType, $ficheiro, $idUser);
                    if (!mysqli_stmt_execute($stmt)) {
                        header("Location: ../pt/pages/uploadStory.php");
                        $_SESSION["xp_jovem"] = 6;
                        echo "Erro na query files";
                    } else {
                        $last_id = mysqli_insert_id($link);
                    }

                    $query2 = "INSERT INTO experiences (description, xp_type, users_idusers, content_idcontent) VALUES (?,?,?,?)";

                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_bind_param($stmt, 'ssii', $description, $xp_type, $User_idUser, $last_id);
                        $description = $_POST['descricao'];
                        $xp_type = "video";
                        $User_idUser = $idUser;

                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            header("Location: ../pt/pages/profile.php?user=$id_navegar");
                            $_SESSION["profile"] = 2;
                            echo "sucesso!";
                        } else {
                            header("Location: ../pt/pages/uploadStory.php");
                            $_SESSION["xp_jovem"] = 7;
                        }
                    } else {
                        header("Location: ../pt/pages/uploadStory.php");
                        $_SESSION["xp_jovem"] = 7;
                        mysqli_close($link);
                    }
                } else {
                    header("Location: ../pt/pages/uploadStory.php");
                    $_SESSION["xp_jovem"] = 7;
                }
            } else {
                header("Location: ../pt/pages/uploadStory.php");
                $_SESSION["xp_jovem"] = 7;
            }
        }
    } else if (!empty($_POST["descricao"]) && $_FILES["fileToUpload"]['size'] == 0) {
        $xp_type = "text";
    } else if (empty($_POST["descricao"]) && $_FILES["fileToUpload"]['size'] != 0) {
    } else {
        header("Location: ../pt/pages/uploadStory.php");
        $_SESSION["xp_jovem"] = 3;
    }
} else {
    header("Location: ../pt/pages/uploadStory.php");
    $_SESSION["xp_jovem"] = 7;
}
