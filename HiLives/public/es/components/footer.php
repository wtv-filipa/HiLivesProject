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
          <p class="pr-5">HiLives es una plataforma que permite a las personas con Discapacidad Intelectual y del Desarrollo encontrar oportunidades para estudiar en diversas universidades de la Unión Europea e incorporarse al mercado laboral.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Sitio web de HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="HiLives Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="HiLives Twitter">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Socios</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Página web de la Universidad de Aveiro">Universidad de Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Página web de la Universidade de Islândia">Universidad de Islandia (UI)</a></li>
            <li><a href="https://www.usal.es/" title="Página web de la Universidad de Salamanca">Universidad de Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Página web de la Universidad de Gante">Universidad de Gante</a></li>
            <li><a href="https://assol.pt/" title="Página web de ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Página web de FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Página web de Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Página web de AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Otros</h4>
          <ul class="m-0 p-0">
            <?php
            if ($User_type == 7) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?comp=<?= $idUser ?>" title="Volver a la página de inicio">Página de inicio</a></li>
              <li><a href="matchVacancyComp.php" title="Enlace a personas">Candidatos</a></li>
              <li><a href="allVacanciesComp.php" title="Ir a mi página de vacantes">Vacantes</a></li>
            <?php
            } else if ($User_type == 10) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?person=<?= $idUser ?>" title="Volver a la página de inicio">Página de inicio</a></li>
              <li><a href="matchCourse.php" title="Ir a la página de enlaces con cursos">Quiero estudiar</a></li>
              <li><a href="matchVacancy.php" title="Ir a la página de enlaces con ofertas de empleo">Quiero trabajar</a></li>
            <?php
            } else if ($User_type == 13) {
            ?>
              <!--Link with match-->
              <li><a href="../../scripts/matchLogo.php?hei=<?= $idUser ?>" title="Volver a la página de inicio">Página de inicio</a></li>
              <li><a href="matchCourseHeis.php" title="Enlace a personas">Candidatos</a></li>
              <li><a href="allCoursesHeis.php" title="Ir a mi página de cursos">Cursos</a></li>
            <?php
            } else if ($User_type == 16) {
            ?>
              <li><a href="homeTutor.php" title="Volver a la página de inicio">Página de inicio</a></li>
              <li><a href="registerRequestsTutor.php" title="Ir a la página de solicitud de inscripción">Solicitudes de inscripción</a></li>
              <li><a href="editRequestsTutor.php" title="Ir a la página de solicitudes de edición">Editar solicitudes
                </a></li>
            <?php
            }
            ?>
            <li><a href="stories.php" title="Ir a la página de historias de HiLives">Historias de HiLives</a></li>
            <li><a href="accessibility.php" title="Ir a la página de accesibilidad">Accesibilidad</a></li>
            <li><a href="help.php" title="Ir a la página de ayuda">Ayuda</a></li>
            <li><a href="construction.php" title="Ir al mapa de la plataforma">Mapa de la plataforma</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Copyright © HiLives 2022. Todos los derechos reservados.</small></p>
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
          <p class="pr-5">HiLives es una plataforma que permite a las personas con Discapacidad Intelectual y del Desarrollo encontrar oportunidades para estudiar en diversas universidades de la Unión Europea e incorporarse al mercado laboral.</p>
          <p class="socialLinks">
            <a href="http://hilives.web.ua.pt/" class="me-3" title="Sitio web de HiLives">
              <i class="fa-solid fa-globe"></i>
            </a>
            <a href="https://www.facebook.com/HiLives_Erasmus-111765073655672/" class="me-3" title="HiLives Facebook">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/HiLives_Erasmus" title="HiLives Twitter">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links mb-3">
          <h4 class="mt-lg-0 mt-sm-3">Socios</h4>
          <ul class="m-0 p-0">
            <li><a href="https://www.ua.pt/" title="Página web de la Universidad de Aveiro">Universidad de Aveiro</a></li>
            <li><a href="https://english.hi.is/university_of_iceland" title="Página web de la Universidade de Islândia">Universidad de Islandia (UI)</a></li>
            <li><a href="https://www.usal.es/" title="Página web de la Universidad de Salamanca">Universidad de Salamanca</a></li>
            <li><a href="https://www.ugent.be/en" title="Página web de la Universidad de Gante">Universidad de Gante</a></li>
            <li><a href="https://assol.pt/" title="Página web de ASSOL">ASSOL</a></li>
            <li><a href="https://www.formem.org.pt/" title="Página web de FORMEM">FORMEM</a></li>
            <li><a href="https://paisemrede.pt/" title="Página web de Pais em Rede">Pais em Rede</a></li>
            <li><a href="https://www.facebook.com/pages/category/Organization/AVISPT21-Associa%C3%A7%C3%A3o-de-Viseu-de-Portadores-de-Trissomia-21-1642598149403790/" title="Página web de AVISPT21">AVISPT21</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-4">Otros</h4>
          <ul class="m-0 p-0">
            <li><a href="accessibility.php" title="Ir a la página de accesibilidad">Accesibilidad</a></li>
            <li><a href="help.php" title="Ir a la página de ayuda">Ayuda</a></li>
            <li><a href="construction.php" title="Ir al mapa de la plataforma">Mapa de la plataforma</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row mt-2">
        <div class="col copyright">
          <p><small> Copyright © HiLives 2022. Todos los derechos reservados.</small></p>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>