<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
  $User_type = $_SESSION["type"];
  $idUser = $_SESSION["idUser"];
?>
  <!--FOOTER WITH LOGIN-->
  <div class="pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 aboutCompany">
          <h3>HiLives</h3>
          <p class="pr-5">A HiLives é uma plataforma que permite a pessoas com Dificuldades Intelectuais e Desenvolvimentais encontrarem oportunidades para estudar em várias universidades da União Europeia.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Website da HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook da HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter da HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Parceiros</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Website da Universidade de Aveiro">Universidade de Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Website da Universidade da Islândia">Universidade da Islândia (UI)</a></li>
            <li><a href="https://www.usal.es/" title="Website da Universidade de Salamanca">Universidade de Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Website da Universidade de Ghent">Universidade de Ghent</a></li>
            <li><a href="https://assol.pt/" title="Website da ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Website da FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Website da Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Website da AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Outros</h4>
          <ul class="m-0 p-0">
            <?php
            if ($User_type == 7) {
            ?>
            <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?comp=<?= $idUser ?>" title="Ir para a página inicial">Página Inicial</a></li>
              <li><a href="matchVacancyComp.php" title="Ir para a página das ligações com pessoas">Candidatos</a></li>
              <li><a href="allVacanciesComp.php" title="Ir para a página das minhas vagas">Vagas</a></li>
            <?php
            } else if ($User_type == 10) {
            ?>
            <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?person=<?= $idUser ?>" title="Ir para a página inicial">Página Inicial</a></li>
              <li><a href="matchCourse.php" title="Ir para a página das ligações com cursos">Eu quero estudar</a></li>
              <li><a href="matchVacancy.php" title="Ir para a página das ligações com vagas">Eu quero trabalhar</a></li>
            <?php
            } else if ($User_type == 13) {
            ?>
            <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?hei=<?= $idUser ?>" title="Ir para a página inicial">Página Inicial</a></li>
              <li><a href="matchCourseHeis.php" title="Ir para a página das ligações com pessoas">Candidatos</a></li>
              <li><a href="allCoursesHeis.php" title="Ir para a página dos meus cursos">Cursos</a></li>
            <?php
            } else if ($User_type == 16) {
            ?>
              <li><a href="homeTutor.php" title="Ir para a página inicial">Página Inicial</a></li>
              <li><a href="registerRequestsTutor.php" title="Ir para a página de pedidos de registo">Pedidos de registo</a></li>
              <li><a href="editRequestsTutor.php" title="Ir para a página de pedidos de edição">Pedidos de edição</a></li>
            <?php
            }
            ?>
            <li><a href="stories.php" title="Ir para a página das histórias da HiLives">Histórias da HiLives</a></li>
            <li><a href="accessibility.php" title="Ir para a página da acessibilidade">Acessibilidade</a></li>
            <li><a href="help.php" title="Ir para a página da ajuda">Ajuda</a></li>
            <li><a href="appMap.php" title="Ir para o mapa da plataforma">Mapa da Plataforma</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Copyright © HiLives 2022. Todos os direitos reservados.</small></p>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
?>
  <!--FOOTER WITHOUT LOGIN-->
  <div class="pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 aboutCompany">
          <h3>HiLives</h3>
          <p class="pr-5">A HiLives é uma plataforma que permite a pessoas com Dificuldades Intelectuais e Desenvolvimentais encontrarem oportunidades para estudar em várias universidades da União Europeia.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Website da HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook da HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter da HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Parceiros</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Website da Universidade de Aveiro">Universidade de Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Website da Universidade da Islândia">Universidade da Islândia (UI)</a></li>
            <li><a href="https://www.usal.es/" title="Website da Universidade de Salamanca">Universidade de Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Website da Universidade de Ghent">Universidade de Ghent</a></li>
            <li><a href="https://assol.pt/" title="Website da ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Website da FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Website da Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Website da AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Outros</h4>
          <ul class="m-0 p-0">
            <li><a href="accessibility.php" title="Ir para a página da acessibilidade">Acessibilidade</a></li>
            <li><a href="help.php" title="Ir para a página da ajuda">Ajuda</a></li>
            <li><a href="appMap.php" title="Ir para o mapa da plataforma">Mapa da Plataforma</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Copyright © HiLives 2022. Todos os direitos reservados.</small></p>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>