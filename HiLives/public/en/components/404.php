<h1 class="title404">Error 404</h1>
<p class="zoom-area">It seems that the link you were looking for does not exist! Please try another link or click the button and go back to the home page.</p>
<?php
if (isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  if ($User_type == 7) {
?>
    <div class="link-container">
      <a target="_self" href="homeComp.php" class="more-link" title="Back to homepage"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Return to homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 10) {
  ?>
    <div class="link-container">
      <a target="_self" href="homePerson.php" class="more-link" title="Back to homepage"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Return to homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeHei.php" class="more-link" title="Back to homepage"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Return to homepage</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeTutor.php" class="more-link" title="Back to homepage"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Return to homepage</button></a>
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