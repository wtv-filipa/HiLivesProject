<h1 class="title404">Error 404</h1>
<p class="zoom-area">Parece que la dirección que ha buscado no existe. Por favor, intente otra dirección o haga clic en el botón y vuelva a la página de inicio.</p>
<?php
if (isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  if ($User_type == 7) {
?>
    <div class="link-container">
      <a target="_self" href="homeComp.php" class="more-link" title="Volver a la página de inicio"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir a la página de inicio</button></a>
    </div>
  <?php
  } else if ($User_type == 10) {
  ?>
    <div class="link-container">
      <a target="_self" href="homePerson.php" class="more-link" title="Volver a la página de inicio"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir a la página de inicio</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeHei.php" class="more-link" title="Volver a la página de inicio"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir a la página de inicio</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeTutor.php" class="more-link" title="Volver a la página de inicio"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir a la página de inicio</button></a>
    </div>
<?php
  }
}
?>
<section class="error-container">
  <span><span>4</span></span>
  <span>0</span>
  <span><span>4</span></span>
</section>