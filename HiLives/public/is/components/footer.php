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
          <p class="pr-5">HiLives er vettvangur sem gerir fólki með vitsmuna- og þroskaerfiðleika kleift að finna tækifæri til náms við ýmsa háskóla í Evrópusambandinu og komast inn á vinnumarkaðinn.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Vefsíða Af HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook Af HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter Af HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Samstarfsaðila</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Vefsíða Háskólans í Aveiro">Íversity Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Heimasíða Háskóla Íslands">Íróleiki Íslands (IU)</a></li>
            <li><a href="https://www.usal.es/" title="Vefsíða Háskólans í Salamanca">Háskólinn í Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Vefsíða Háskólans í Gent">Háskólinn í Gent</a></li>
            <li><a href="https://assol.pt/" title="Vefsíða ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Vefsíða FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Vefsíða Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Vefsíða AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Annar</h4>
          <ul class="m-0 p-0">
            <?php
            if ($User_type == 7) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?comp=<?= $idUser ?>" title="Aftur heim">Heimasíða</a></li>
              <li><a href="matchVacancyComp.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a></li>
              <li><a href="allVacanciesComp.php" title="Fara á síðuna mína um laus störf">Laus störf</a></li>
            <?php
            } else if ($User_type == 10) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?person=<?= $idUser ?>" title="Aftur heim">Heimasíða</a></li>
              <li><a href="matchCourse.php" title="Fara á tenglana með námskeiðasíðu">Mig langar að læra</a></li>
              <li><a href="matchVacancy.php" title="Fara á tenglasíðuna með lausum störfum">Mig langar að vinna</a></li>
            <?php
            } else if ($User_type == 13) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?hei=<?= $idUser ?>" title="Aftur heim">Heimasíða</a></li>
              <li><a href="matchCourseHeis.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a></li>
              <li><a href="allCoursesHeis.php" title="Fara á námskeiðasíðuna mína">Námskeið</a></li>
            <?php
            } else if ($User_type == 16) {
            ?>
              <li><a href="homeTutor.php" title="Aftur heim">Heimasíða</a></li>
              <li><a href="registerRequestsTutor.php" title="Fara á síðu skráningarbeiðna">Umsóknir um skráningu</a></li>
              <li><a href="editRequestsTutor.php" title="Fara á síðuna breyta beiðnum">Beiðnum breytt</a></li>
            <?php
            }
            ?>
            <li><a href="stories.php" title="Fara á síðuna HiLives Stories">HiLives sögur</a></li>
            <li><a href="accessibility.php" title="Fara á aðgengissíðu">Aðgengileiki</a></li>
            <li><a href="help.php" title="Fara á hjálparsíðuna">Hjálpa</a></li>
            <li><a href="construction.php" title="Fara á vettvangskortið">Verkvangsvörpun</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Höfundarréttur © HiLives 2022. Allur réttur áskilinn.</small></p>
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
          <p class="pr-5">HiLives er vettvangur sem gerir fólki með vitsmuna- og þroskaerfiðleika kleift að finna tækifæri til náms við ýmsa háskóla í Evrópusambandinu og komast inn á vinnumarkaðinn.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Vefsíða Af HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="Facebook Af HiLives">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="Twitter Af HiLives">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Samstarfsaðila</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Vefsíða Háskólans í Aveiro">Íversity Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Heimasíða Háskóla Íslands">Íróleiki Íslands (IU)</a></li>
            <li><a href="https://www.usal.es/" title="Vefsíða Háskólans í Salamanca">Háskólinn í Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Vefsíða Háskólans í Gent">Háskólinn í Gent</a></li>
            <li><a href="https://assol.pt/" title="Vefsíða ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Vefsíða FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Vefsíða Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Vefsíða AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Annar</h4>
          <ul class="m-0 p-0">
            <li><a href="accessibility.php" title="Fara á aðgengissíðu">Aðgengileiki</a></li>
            <li><a href="help.php" title="Fara á hjálparsíðuna">Hjálpa</a></li>
            <li><a href="construction.php" title="Fara á vettvangskortið">Verkvangsvörpun</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small>Höfundarréttur © HiLives 2022. Allur réttur áskilinn.</small></p>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>