<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4 && $_SESSION["type"] != 16) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Breyta forstillingu</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_editProfile.php"; ?>
    </head>

    <body class="bg_vertical_28">
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>
        <?php
        if ($_SESSION["type"] == 7) {
            include "../components/editProfileComp.php";
        } else if ($_SESSION["type"] == 10) {
            include "../components/editProfilePerson.php";
        } else if ($_SESSION["type"] == 13) {
            include "../components/editProfileHei.php";
        }
        ?>
        <?php include "../components/footer.php"; ?>

        <?php include "../../helpers/js.php"; ?>
        <?php include "../../helpers/js_crop.php"; ?>
        <?php include "../../helpers/formsValidation.php"; ?>

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