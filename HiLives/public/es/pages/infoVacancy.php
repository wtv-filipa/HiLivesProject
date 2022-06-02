<?php
session_start();
if (isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="pt">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Informação da vaga</title>
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