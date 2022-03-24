<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>Registo</title>
    <?php include "../../helpers/fonts.php"; ?>
    <?php include "../../helpers/css_forms.php"; ?>
</head>

<body class="bg_login_reg">
    <?php include "../components/registerComp.php"; ?>

    <script>
        function checkPass() {
         //Store the password field objects into variables ...
         var pass1 = $("#register-form #password");
         var pass2 = $("#register-form #password_confirm");

         console.log(pass1.value, pass2);
         //Store the Confimation Message Object ...
         var message = $('#confirmMessage');
         //Set the colors we will be using ...
         var goodColor = "#66cc66";
         var badColor = "#ff6666";
         var opacidade = "0.7";
         //Compare the values in the password field
         //and the confirmation field
         if (pass1.val() == pass2.val()) {
             //The passwords match.
             //Set the color to the good color and inform
             //the user that they have entered the correct password
             pass2.css("backgroundColor", goodColor);
             message.css("color", goodColor);
             message.html("As palavras-passe estão iguais!");
         } else {
             //The passwords do not match.
             //Set the color to the bad color and
             //notify the user.
             pass2.css("backgroundColor", badColor);
             pass2.css("opacity", opacidade);
             message.css("color", badColor);
             message.html("As palavras-passe estão diferentes!");
         }
     }
    </script>
    <?php include "../../helpers/js.php"; ?>
</body>

</html>