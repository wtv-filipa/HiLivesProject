<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="be">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Aanmelden</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_login">
        <?php include "../components/login.php"; ?>

        <?php include "../../helpers/js.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 4) {
   header("Location: ../../../admin/index.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
    header("Location: homeComp.php");
} else  if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
    header("Location: homeHei.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
}
?>