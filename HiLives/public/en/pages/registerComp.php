<?php
session_start();
if (!isset($_SESSION["idUser"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../../helpers/meta.php"; ?>
    <title>Register</title>
    <?php include "../../helpers/fonts.php"; ?>
    <?php include "../../helpers/css_forms.php"; ?>
</head>

<body class="bg_login_reg">
    <?php include "../components/registerComp.php"; ?>

    <?php include "../../helpers/formsValidation_en.php"; ?>
    <?php include "../../helpers/js.php"; ?>
    <?php include "../../helpers/js_enableToltip.php"; ?>
</body>

</html>
<?php
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 4) {
   header("Location: ../../../admin/index.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 7) {
    header("Location: homeComp.php");
} else  if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 10) {
    header("Location: homePerson.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 13) {
    header("Location: homeHei.php");
} else if (isset($_SESSION["idUser"]) && $_SESSION["type"] == 16) {
    header("Location: homeTutor.php");
}
?>