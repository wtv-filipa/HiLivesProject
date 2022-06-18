<?php
session_start();
if (isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="be">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Vacature informatie</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_info.php"; ?>
    </head>

    <body>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/infoVacancyLearn.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>