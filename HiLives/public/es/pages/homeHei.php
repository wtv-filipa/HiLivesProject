<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Página de inicio</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_homePerson.php"; ?>
    </head>

    <body>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/homeHei.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
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