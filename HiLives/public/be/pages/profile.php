<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="be">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Mijn omgeving</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_profile.php"; ?>
    </head>

    <body>
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>

        <?php
        if ($_SESSION["type"] == 7) {
            include "../components/profileComp.php";
        } else if ($_SESSION["type"] == 10) {
            include "../components/profilePerson.php";
        } else if ($_SESSION["type"] == 13) {
            include "../components/profileHei.php";
        } else if ($_SESSION["type"] == 16) {
            include "../components/profileTutor.php";
        }
        ?>

        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_crop.php"; ?>

        <script>
            $(window).on("load", function() {
                $(".loader-wrapper").fadeOut("slow");
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: login.php");
}
?>