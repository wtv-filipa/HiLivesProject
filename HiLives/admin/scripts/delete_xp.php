<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$query = "DELETE FROM experiences WHERE idexperiences = ?";
$query2 = "DELETE FROM content WHERE idcontent = ?";
$query3 = "SELECT content_name FROM content WHERE idcontent = ?";

if (isset($_GET['apaga']) && isset($_GET['type']) && isset($_GET['content'])) {
    $idStory = $_GET["apaga"];
    $storyType =  $_GET["type"];
    $idContent =  $_GET["content"];

    if ($storyType == "text") {
        //DELETE STORY WITH ONLY TEXT
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $idStory);

            if (!mysqli_stmt_execute($stmt)) {
                 header("Location: ../hilives_stories.php");
                $_SESSION["xp"] = 2;
            } else {
                //SUCCESS
                 header("Location: ../hilives_stories.php");
                $_SESSION["xp"] = 1;
            }
        } else {
             header("Location: ../hilives_stories.php");
            $_SESSION["xp"] = 2;
        }
    } else {
        //DELETE OTHER TYPES OF STORIES
        if (mysqli_stmt_prepare($stmt, $query3)) {

            mysqli_stmt_bind_param($stmt, 'i', $idContent);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $content_name);
            while (mysqli_stmt_fetch($stmt)) {
                $ficheiro = "../uploads/experiences/" . $content_name;

                if (!unlink($ficheiro)) {

                     header("Location: ../hilives_stories.php");
                     $_SESSION["xp"] = 2;
                } else {
                    //DELETE FROM CONTENT
                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                        mysqli_stmt_bind_param($stmt2, 'i', $idContent);

                        if (!mysqli_stmt_execute($stmt2)) {
                             header("Location: ../hilives_stories.php");
                             $_SESSION["xp"] = 2;
                        }
                    } else {

                         header("Location: ../hilives_stories.php");
                         $_SESSION["xp"] = 2;
                    }

                    //DELETE FROM EXPERIENCES
                    if (mysqli_stmt_prepare($stmt2, $query)) {
                        mysqli_stmt_bind_param($stmt2, 'i', $idStory);

                        if (!mysqli_stmt_execute($stmt2)) {
                             header("Location: ../hilives_stories.php");
                             $_SESSION["xp"] = 2;
                        }
                    } else {

                         header("Location: ../hilives_stories.php");
                         $_SESSION["xp"] = 2;
                    }

                    //SUCCESS
                     header("Location: ../hilives_stories.php");
                     $_SESSION["xp"] = 1;
                }
            }
            mysqli_stmt_close($stmt);
        } else {

             header("Location: ../hilives_stories.php");
            $_SESSION["xp"] = 2;
        }

        mysqli_close($link);
        mysqli_close($link2);
    }
} else {
     header("Location: ../hilives_stories.php");
     $_SESSION["xp"] = 2;
}
