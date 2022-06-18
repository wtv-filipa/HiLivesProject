<?php
session_start();
if (isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Upplýsingar um laus störf</title>
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