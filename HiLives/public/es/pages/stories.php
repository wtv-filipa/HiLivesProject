<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Historias</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_stories.php"; ?>
    </head>

    <body>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/stories.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 4) {
   header("Location: ../../../admin/index.php");
} else {
    header("Location: login.php");
}
?>