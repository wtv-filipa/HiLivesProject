<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Heimasíða</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_homePerson.php"; ?>
    </head>

    <body>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/homeComp.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
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