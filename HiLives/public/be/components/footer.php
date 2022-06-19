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
          <p class="pr-5">HiLives is een platform dat mensen met intellectuele en ontwikkelingsmoeilijkheden in staat stelt om kansen te vinden om te studeren aan verschillende universiteiten in de Europese Unie en de arbeidsmarkt te betreden.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Website Van HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook Van HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter Van HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Parceiros</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Website van de Universiteit van Aveiro">Universiteit van Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Website van de Universiteit van IJsland">Universiteit van IJsland (IU)</a></li>
            <li><a href="https://www.usal.es/" title="Website van de Universiteit van Salamanca">Universiteit van Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Website universiteit Gent">Universiteit Gent</a></li>
            <li><a href="https://assol.pt/" title="Website van ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Website van FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Website van Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Website van AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Overige</h4>
          <ul class="m-0 p-0">
            <?php
            if ($User_type == 7) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?comp=<?= $idUser ?>" title="Ga naar home"> Home</a></li>
              <li><a href="matchVacancyComp.php" title="Ga naar de pagina Personenlinks">Kandidaten</a></li>
              <li><a href="allVacanciesComp.php" title="Ga naar mijn vacaturepagina"> Vacatures</a></li>
            <?php
            } else if ($User_type == 10) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?person=<?= $idUser ?>" title="Ga naar home"> Home</a></li>
              <li><a href="matchCourse.php" title="Ga naar de links pagina met cursussen">Ik wil studeren</a></li>
              <li><a href="matchVacancy.php" title="Ga naar de vacaturelinks pagina">Wil werken</a></li>
            <?php
            } else if ($User_type == 13) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?hei=<?= $idUser ?>" title="Ga naar home"> Home</a></li>
              <li><a href="matchCourseHeis.php" title="Ga naar de pagina Personenlinks">Kandidaten</a></li>
              <li><a href="allCoursesHeis.php" title="Ga naar mijn cursuspagina">Cursussen</a></li>
            <?php
            } else if ($User_type == 16) {
            ?>
              <li><a href="homeTutor.php" title="Ga naar home"> Home</a></li>
              <li><a href="registerRequestsTutor.php" title="Ga naar de pagina registratieverzoeken">Verzoeken</a></li>
              <li><a href="editRequestsTutor.php" title="Ga naar de pagina bewerkingsverzoeken">Verzoeken bewerken</a></li>
            <?php
            }
            ?>
            <li><a href="stories.php" title="Ga naar hilives stories pagina">HiLives-verhalen</a></li>
            <li><a href="accessibility.php" title="Ga naar de toegankelijkheidspagina">Toegankelijkheid</a></li>
            <li><a href="help.php" title="Ga naar de helppagina">Help</a></li>
            <li><a href="construction.php" title="Ga naar de platformkaart">Platform Map</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small>Copyright © HiLives 2022. Alle rechten voorbehouden.</small></p>
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
          <p class="pr-5">HiLives is een platform waarmee mensen met intellectuele en ontwikkelingsmoeilijkheden mogelijkheden kunnen vinden om te studeren aan verschillende universiteiten in de Europese Unie.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Website Van HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook Van HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter Van HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Parceiros</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Website van de Universiteit van Aveiro">Universiteit van Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Website van de Universiteit van IJsland">Universiteit van IJsland (IU)</a></li>
            <li><a href="https://www.usal.es/" title="Website van de Universiteit van Salamanca">Universiteit van Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Website universiteit Gent">Universiteit Gent</a></li>
            <li><a href="https://assol.pt/" title="Website van ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Website van FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Website van Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Website van AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Overige</h4>
          <ul class="m-0 p-0">
            <li><a href="accessibility.php" title="Ga naar de toegankelijkheidspagina">Toegankelijkheid</a></li>
            <li><a href="help.php" title="Ga naar de helppagina">Help</a></li>
            <li><a href="construction.php" title="Ga naar de platformkaart">Platform Map</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Copyright © HiLives 2022. Alle rechten voorbehouden.</small></p>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>