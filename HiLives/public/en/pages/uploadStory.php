<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4 && $_SESSION["type"] != 16) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Add a story</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_horizontal_28">
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/uploadStory.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_upload.php"; ?>
        <?php include "../../helpers/js_enablePopover.php"; ?>
        <?php include "../../helpers/js_enableToltip.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
} else {
    header("Location: login.php");
}
?>