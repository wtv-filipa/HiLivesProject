<h1 class="title404">Fout 404</h1>
<p class="zoom-area">Het lijkt erop dat het adres dat u zoekt niet bestaat! Probeer een ander adres of klik op de knop en ga terug naar de startpagina.</p>
<?php
if (isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  if ($User_type == 7) {
?>
    <div class="link-container">
      <a target="_self" href="homeComp.php" class="more-link" title="Terug naar home"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ga naar homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 10) {
  ?>
    <div class="link-container">
      <a target="_self" href="homePerson.php" class="more-link" title="Terug naar home"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ga naar homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeHei.php" class="more-link" title="Terug naar home"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ga naar homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeTutor.php" class="more-link" title="Terug naar home"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ga naar homepage</button></a>
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