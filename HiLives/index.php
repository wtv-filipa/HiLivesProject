<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="pt">

    <head>
        <?php include "public/helpers/meta.php"; ?>
        <title>HiLives</title>
        <?php include "public/helpers/fonts.php"; ?>
        <?php include "public/helpers/css_index.php"; ?>
    </head>

    <body>
        <?php include "public/pt/components/navbarHomeNoLogin.php"; ?>
        <?php include "public/pt/components/homepageNoLogin.php"; ?>
        <?php include "public/pt/components/footerNoLogin.php"; ?>

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
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: public/pt/pages/homeComp.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: public/pt/pages/homePerson.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: public/pt/pages/homeHei.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 16) {
    header("Location: public/pt/pages/homeTutor.php");
}
?>