<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="nl">

    <head>
        <?php include "public/helpers/meta.php"; ?>
        <title>HiLives</title>
        <?php include "public/helpers/fonts.php"; ?>
        <?php include "public/helpers/css_index.php"; ?>
    </head>

    <body>
        <?php include "public/be/components/navbarHomeNoLogin.php"; ?>
        <?php include "public/be/components/homepageNoLogin.php"; ?>
        <?php include "public/be/components/footerNoLogin.php"; ?>

        <!-- <script>
        $(function() {
            $('a[href*=#]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 500, 'linear');
            });
        });
    </script> -->
    <?php include "public/helpers/js.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: public/be/pages/homeComp.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: public/be/pages/homePerson.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: public/be/pages/homeHei.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 16) {
    header("Location: public/be/pages/homeTutor.php");
}
?>