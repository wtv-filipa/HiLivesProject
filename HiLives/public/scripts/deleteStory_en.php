<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$id_navegar = $_SESSION["idUser"];
$userType = $_SESSION["type"];

$query = "DELETE FROM experiences WHERE idexperiences = ?";
$query2 = "DELETE FROM content WHERE idcontent = ?";
$query3 = "SELECT content_name FROM content WHERE idcontent = ?";

if (isset($_GET['apaga']) && isset($_GET['user']) && isset($_GET['type']) && isset($_GET['content'])) {
    $idStory = $_GET["apaga"];
    $idUser =  $_GET["user"];
    $storyType =  $_GET["type"];
    $idContent =  $_GET["content"];

    if ($storyType == "text") {
        //DELETE STORY WITH ONLY TEXT
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $idStory);

            if (!mysqli_stmt_execute($stmt)) {
                header("Location: ../en/pages/profile.php?user=$idUser");
                if ($userType == 10) {
                    $_SESSION["profile"] = 5;
                } else {
                    $_SESSION["profile"] = 6;
                }
            } else {
                //SUCCESS
                header("Location: ../en/pages/profile.php?user=$idUser");
                if ($userType == 10) {
                    $_SESSION["profile"] = 7;
                } else {
                    $_SESSION["profile"] = 5;
                }
            }
        } else {

            header("Location: ../en/pages/profile.php?user=$idUser");
            if ($userType == 10) {
                $_SESSION["profile"] = 5;
            } else {
                $_SESSION["profile"] = 6;
            }
        }
    } else {
        //DELETE OTHER TYPES OF STORIES
        if (mysqli_stmt_prepare($stmt, $query3)) {

            mysqli_stmt_bind_param($stmt, 'i', $idContent);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $content_name);
            while (mysqli_stmt_fetch($stmt)) {
                $ficheiro = "../../admin/uploads/experiences/" . $content_name;

                if (!unlink($ficheiro)) {

                    header("Location: ../en/pages/profile.php?user=$idUser");
                    if ($userType == 10) {
                        $_SESSION["profile"] = 5;
                    } else {
                        $_SESSION["profile"] = 6;
                    }
                } else {
                    //DELETE FROM CONTENT
                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                        mysqli_stmt_bind_param($stmt2, 'i', $idContent);

                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../en/pages/profile.php?user=$idUser");
                            if ($userType == 10) {
                                $_SESSION["profile"] = 5;
                            } else {
                                $_SESSION["profile"] = 6;
                            }
                        }
                    } else {

                        header("Location: ../en/pages/profile.php?user=$idUser");
                        if ($userType == 10) {
                            $_SESSION["profile"] = 5;
                        } else {
                            $_SESSION["profile"] = 6;
                        }
                    }

                    //DELETE FROM EXPERIENCES
                    if (mysqli_stmt_prepare($stmt2, $query)) {
                        mysqli_stmt_bind_param($stmt2, 'i', $idStory);

                        if (!mysqli_stmt_execute($stmt2)) {
                            header("Location: ../en/pages/profile.php?user=$idUser");
                            if ($userType == 10) {
                                $_SESSION["profile"] = 5;
                            } else {
                                $_SESSION["profile"] = 6;
                            }
                        }
                    } else {

                        header("Location: ../en/pages/profile.php?user=$idUser");
                        if ($userType == 10) {
                            $_SESSION["profile"] = 5;
                        } else {
                            $_SESSION["profile"] = 6;
                        }
                    }

                    //SUCCESS
                    header("Location: ../en/pages/profile.php?user=$idUser");
                    if ($userType == 10) {
                        $_SESSION["profile"] = 7;
                    } else {
                        $_SESSION["profile"] = 5;
                    }
                }
            }
            mysqli_stmt_close($stmt);
        } else {

            header("Location: ../en/pages/profile.php?user=$idUser");
            $_SESSION["xp_jovem"] = 4;
        }

        mysqli_close($link);
        mysqli_close($link2);
    }
} else {
    header("Location: ../en/pages/profile.php?user=$idUser");
    if ($userType == 10) {
        $_SESSION["profile"] = 5;
    } else {
        $_SESSION["profile"] = 6;
    }
}
