<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Breyta námskeiði</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_vertical_28">
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/editCourseHei.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js_validateCheckbox_is.php"; ?>
        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_characterCounter.php"; ?>
        <?php include "../../helpers/js_upload.php"; ?>
        <?php include "../../helpers/js_enablePopover.php"; ?>
        <?php include "../../helpers/js_enableToltip.php"; ?>

        <script>
            $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
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