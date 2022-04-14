<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
    <!DOCTYPE html>
    <html lang="pt">

    <head>
        <?php include "../../helpers/meta.php"; ?>
        <title>Registo</title>
        <?php include "../../helpers/fonts.php"; ?>
        <?php include "../../helpers/css_forms.php"; ?>
    </head>

    <body class="bg_vertical_28">
        <?php include "../components/registerPerson.php"; ?>

        <script>
            /*Password check*/
            function checkPass() {
                var pass1 = $("#register-form #password");
                var pass2 = $("#register-form #password_confirm");

                console.log(pass1.value, pass2);
                var message = $('#confirmMessage');
                var goodColor = "#66cc66";
                var badColor = "#ff6666";
                var opacidade = "0.7";
                if (pass1.val() == pass2.val()) {
                    //The passwords match.
                    pass2.css("backgroundColor", goodColor);
                    message.css("color", goodColor);
                    message.html("As palavras-passe estão iguais!");
                } else {
                    //The passwords do not match.
                    pass2.css("backgroundColor", badColor);
                    pass2.css("opacity", opacidade);
                    message.css("color", badColor);
                    message.html("As palavras-passe estão diferentes!");
                }
            }

            /*Change regions*/
            var select = document.getElementById("pais");
            var formularios = document.querySelectorAll('.formulario');

            select.onchange = function() {
                for (var i = 0; i < formularios.length; i++) formularios[i].style.display = 'none';
                var divID = select.options[select.selectedIndex].value;
                var div = document.getElementById(divID);
                div.style.display = 'block';
            };
        </script>
        <?php include "../../helpers/js.php"; ?>
    </body>

    </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
    header("Location: admin/index.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
    header("Location: homeComp.php");
} else  if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
    header("Location: homeHei.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
}
?>