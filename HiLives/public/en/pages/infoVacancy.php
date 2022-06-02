<?php
session_start();
if (isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Vacancy information</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_info.php"; ?>
    </head>

    <body>
        <?php include "../components/navbar.php"; ?>
        <?php include "../components/infoVacancy.php"; ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>