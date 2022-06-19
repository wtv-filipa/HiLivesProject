<h1 class="title404">Villa 404</h1>
<p class="zoom-area">Heimilisfangið sem þú leitar að er ekki til. Vinsamlegast reyndu annað heimilisfang eða ýttu á hnappinn og farðu aftur á heimasíðuna.</p>
<?php
if (isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  if ($User_type == 7) {
?>
    <div class="link-container">
      <a target="_self" href="homeComp.php" class="more-link" title="Aftur heim"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI"></button>Fara á heimasíðuna</a>
    </div>
  <?php
  } else if ($User_type == 10) {
  ?>
    <div class="link-container">
      <a target="_self" href="homePerson.php" class="more-link" title="Aftur heim"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Fara á heimasíðuna</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeHei.php" class="more-link" title="Aftur heim"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Fara á heimasíðuna</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeTutor.php" class="more-link" title="Aftur heim"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Fara á heimasíðuna</button></a>
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