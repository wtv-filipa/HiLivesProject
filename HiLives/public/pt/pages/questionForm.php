<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>Contacto</title>
    <?php include "../../helpers/fonts.php"; ?>
    <?php include "../../helpers/css_forms.php"; ?>
</head>

<body class="bg_horizontal_28">
    <?php include "../components/loading_screen.php"; ?>
    <?php include "../components/navbar.php"; ?>
    <?php include "../components/questionForm.php"; ?>
    <?php include "../components/footer.php"; ?>

    <?php include "../../helpers/js.php"; ?>
    <?php include "../../helpers/js_upload.php"; ?>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").fadeOut("slow");
        });
    </script>
</body>

</html>