<h1 class="title404">Erro 404</h1>
<p class="zoom-area">Parece que o endereço que procuraste não existe! Por favor tenta outro endereço ou carrega no botão e volta para a página inicial.</p>
<?php
if (isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  if ($User_type == 7) {
?>
    <div class="link-container">
      <a target="_self" href="homeComp.php" class="more-link" title="Voltar à página inicial"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir para a página inicial</button></a>
    </div>
  <?php
  } else if ($User_type == 10) {
  ?>
    <div class="link-container">
      <a target="_self" href="homePerson.php" class="more-link" title="Voltar à página inicial"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir para a página inicial</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeHei.php" class="more-link" title="Voltar à página inicial"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir para a página inicial</button></a>
    </div>
  <?php
  } else if ($User_type == 13) {
  ?>
    <div class="link-container">
      <a target="_self" href="homeTutor.php" class="more-link" title="Voltar à página inicial"><button class="btn buttonDesign buttonWork buttonRegisterSizeHEI">Ir para a página inicial</button></a>
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