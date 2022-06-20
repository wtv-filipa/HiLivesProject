<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>Ayuda - HiLives</title>
    <?php include "../../helpers/fonts.php"; ?>
    <?php include "../../helpers/css_infoPages.php"; ?>
</head>

<body>
    <?php include "../components/loading_screen.php"; ?>
    <?php include "../components/navbar.php"; ?>
    <?php include "../components/help.php"; ?>
    <?php include "../components/footer.php"; ?>

    <?php include "../../helpers/js.php"; ?>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

</html>