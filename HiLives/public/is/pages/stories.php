<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Sögur</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_stories.php"; ?>
    </head>

    <body>
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/stories.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>

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
} else {
    header("Location: login.php");
}
?>