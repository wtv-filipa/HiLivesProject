<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include "public/helpers/meta.php"; ?>
        <title>HiLives</title>
        <?php include "public/helpers/fonts.php"; ?>
        <?php include "public/helpers/css_index.php"; ?>
    </head>

    <body>
        <?php include "public/pt/components/loading_screen_noLogin.php"; ?>
        <?php include "public/es/components/navbarHomeNoLogin.php"; ?>
        <?php include "public/es/components/homepageNoLogin.php"; ?>
        <?php include "public/es/components/footerNoLogin.php"; ?>

        <?php include "public/helpers/js.php"; ?>

        <script>
            $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: public/es/pages/homeComp.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: public/es/pages/homePerson.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: public/es/pages/homeHei.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 16) {
    header("Location: public/es/pages/homeTutor.php");
}
?>