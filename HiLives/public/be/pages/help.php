<?php
session_start();
?>
<!DOCTYPE html>
<html lang="be">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>Hulp - HiLives</title>
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