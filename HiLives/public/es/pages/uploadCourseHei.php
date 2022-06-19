<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Añadir un curso</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_vertical_28">
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/uploadCourseHei.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js_validateCheckbox_es.php"; ?>
        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_characterCounter.php"; ?>
        <?php include "../../helpers/js_upload.php"; ?>
        <?php include "../../helpers/js_enablePopover.php"; ?>
        <?php include "../../helpers/js_enableToltip.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 4) {
   header("Location: ../../../admin/index.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
    header("Location: homeComp.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
} else {
    header("Location: login.php");
}
?>