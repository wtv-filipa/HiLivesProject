<?php
session_start();
if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    if ($_SESSION["type"] == 10 || $_SESSION["type"] == 13 || $_SESSION["type"] == 16) {
?>
        <!DOCTYPE html>
        <html lang="be">

        <head>
            <?php include "../../helpers/meta.php"; ?>
            <title>Cursus informatie</title>
            <?php include "../../helpers/fonts.php"; ?>
            <?php include "../../helpers/css_info.php"; ?>
        </head>

        <body>
            <?php include "../components/loading_screen.php"; ?>
            <?php include "../components/navbar.php"; ?>
            <?php include "../components/infoCourse.php"; ?>
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
    } else if ($_SESSION["type"] == 4) {
        header("Location: ../../../admin/index.php");
    } else if ($_SESSION["type"] == 7) {
        header("Location: homeComp.php");
    }
} else {
    header("Location: login.php");
}
?>