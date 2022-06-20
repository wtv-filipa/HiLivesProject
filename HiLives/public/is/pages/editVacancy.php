<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Breyta lausu starfi</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_vertical_28">
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/editVacancy.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_characterCounter.php"; ?>
        <?php include "../../helpers/js_upload.php"; ?>
        <?php include "../../helpers/uploadValidationVacancy.php"; ?>
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
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
    header("Location: homeHei.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
} else {
    header("Location: login.php");
}
?>