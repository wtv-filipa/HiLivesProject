<?php
session_start();
?>
<!DOCTYPE html>
<html lang="be">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>HiLives</title>
    <?php include "../../helpers/fonts.php"; ?>
    <?php include "../../helpers/css_forms.php"; ?>
</head>

<body class="bg_login_reg">
    <?php include "../components/loading_screen.php"; ?>
    <?php include "../components/messageRegister.php"; ?>

    <?php include "../../helpers/js.php"; ?>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

</html>