<?php
session_start();

if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 4) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php include "helpers/meta.php"; ?>
    <title>Dashboard</title>
    <?php include "helpers/fonts.php"; ?>
    <?php include "helpers/css.php"; ?>

  </head>

  <body id="page-top">
    <div id="wrapper">
      <?php include "components/side_nav.php"; ?>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <?php include "components/nav_top.php"; ?>

          <div class="container-fluid">
            <?php include "components/heading.php"; ?>
            <?php include "components/index.php"; ?>
          </div>
        </div>
        <?php include "components/footer.php"; ?>
      </div>
    </div>
    <?php include "components/scroll_button.php"; ?>
    <?php include "components/logout_modal.php"; ?>
    <?php include "helpers/js.php"; ?>

  </body>

  </html>
<?php
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 7) {
  header("Location: ../public/pt/pages/homeComp.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 10) {
  header("Location: ../public/pt/pages/homePerson.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 13) {
  header("Location: ../public/pt/pages/homeHei.php");
} else if (isset($_SESSION["idUser"]) and $_SESSION["type"] == 16) {
  header("Location: ../public/pt/pages/homeTutor.php");
} else {
  header("Location: ../public/pt/pages/login.php");
}
?>