<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Requests for registration</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_requests.php"; ?>
    </head>

    <body>
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/registerRequestsTutor.php"; ?>
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
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
    header("Location: homeComp.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
    header("Location: homeHei.php");
} else {
    header("Location: login.php");
}
?>