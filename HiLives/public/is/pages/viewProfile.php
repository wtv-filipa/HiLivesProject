<?php
session_start();
if (isset($_SESSION["idUser"]) && $_SESSION["type"] != 4) {
?>
    <!DOCTYPE html>
    <html lang="is">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Svæði í </title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_profile.php"; ?>
    </head>

    <body>
        <?php include "../components/loading_screen.php"; ?>
        <?php include "../components/navbar.php"; ?>

        <?php
        if (isset($_GET["userType"]) && $_GET["userType"] == 7) {
            include "../components/viewProfileComp.php";
        } else if (isset($_GET["userType"]) && $_GET["userType"] == 10) {
            include "../components/viewProfilePerson.php";
        } else if (isset($_GET["userType"]) && $_GET["userType"] == 13) {
            include "../components/viewProfileHei.php";
        } else if (isset($_GET["userType"]) && $_GET["userType"] == 16) {
            include "../components/viewProfileTutor.php";
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