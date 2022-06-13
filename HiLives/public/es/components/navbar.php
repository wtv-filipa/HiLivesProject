<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    $User_type = $_SESSION["type"];
    $idUser = $_SESSION["idUser"];

    $query = "SELECT profile_img
    FROM users
    WHERE idusers = ?";
?>
    <!--Navbar WITH login Bigger Screens-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top navBig">
        <div class="container">
            <?php
            if ($User_type == 7) {
            ?>
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_es.php?comp=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_es.php?person=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_es.php?hei=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            }
            ?>
            <!--Menu collapse-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if ($User_type == 7) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Ir a la página de enlaces con personas">Candidatos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allVacanciesComp.php" title="Ir a mi página de vacantes">Vacantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir a enlaces con cursos">Quiero estudiar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="matchVacancy.php" title="Ir a los enlaces con empleos">Quiero trabajar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Ir a la página de enlaces con personas">Candidatos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allCoursesHeis.php" title="Ir a mi página de cursos">Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewVacanciesHei.php" title="Ir a la página de vacantes de las empresas">Vacantes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Ir a la página de solicitud de inscripción">Solicitudes de inscripción</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editRequestsTutor.php" title="Ir a la página de edición de solicitudes">Editar solicitudes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ir a mi área">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="<?= $profile_img ?>" alt="Foto de perfil" title="Foto de perfil">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Sin foto de perfil" title="Sin foto de perfil">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        Mi área
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Traducir al español">
                        <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandera de España">
                        <span class="name ms-1 align-middle hideTextNav">
                            Español
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Traducir al inglés">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandera del Reino Unido">
                                <span class="name ms-1 align-middle">
                                    Inglés
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Traducir al portugués">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandera de Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugués
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Traducir a flamenco">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandera de Bélgica">
                                <span class="name ms-1 align-middle">
                                    Flandes
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Traducir a islandés">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandera de Islandia">
                                <span class="name ms-1 align-middle">
                                    Islandés
                                </span>
                            </a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <!--Navbar WITH login Smaller Screens-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top navSmall">
        <div class="container">
            <?php
            if ($User_type == 7) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_es.php?comp=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_es.php?person=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_es.php?hei=<?= $idUser ?>" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Volver a la página de inicio">
                    <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            }
            ?>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ir a mi zona">
                    <?php
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid" style="max-width:29px" alt="<?= $profile_img ?>" alt="Foto de perfil" title="Foto de perfil">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Sin foto de perfil" title="Sin foto de perfil">
                    <?php
                            }
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($link);
                    ?>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle ps-0 pe-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Traducir al español">
                        <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandera de España">
                        <span class="name ms-1 align-middle hideTextNav">
                            Español
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Traducir al inglés">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandera del Reino Unido">
                                <span class="name ms-1 align-middle">
                                    Inglês
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Traducir al portugués">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandera de Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugués
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Traducir a flamenco">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandera de Bélgica">
                                <span class="name ms-1 align-middle">
                                    Flandes
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Traducir a islandés">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandera de Islandia">
                                <span class="name ms-1 align-middle">
                                    Islandés
                                </span>
                            </a></li>
                    </ul>
                </div>

                <!--Sidebar-->
                <div>
                    <button class="btn btn-primary buttonSidebar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </div>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            if ($User_type == 7) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Ir a la página de enlaces con personas">Candidatos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allVacanciesComp.php" title="Ir a mi página de vacantes">Vacantes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir a enlaces con cursos">Quiero estudiar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="matchVacancy.php" title="Ir a los enlaces con empleos">Quiero trabajar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Ir para a página de links para as pessoas">Candidatos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allCoursesHeis.php" title="Ir a mi página de cursos">Cursos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewVacanciesHei.php" title="Ir a la página de vacantes de las empresas">Vacantes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Ir a la página de solicitud de inscripción">Solicitudes de inscripción</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="editRequestsTutor.php" title="Ir a la página de edición de solicitudes">Editar solicitudes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir a las historias de HiLives">Historias de HiLives</a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </nav>
<?php
} else {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="../../../indexES.php" title="Volver a la página de inicio">
                <img src="../../img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="login.php" title="Iniciar sessão">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmallerPT m-0">
                            Iniciar sesión
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="indexES.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Traducir al español">
                        <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandera de España">
                        <span class="name ms-1 align-middle hideTextNav">
                            Español
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../indexEN.php" title="Traducir al inglés">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandera del Reino Unido">
                                <span class="name ms-1 align-middle">
                                    Inglês
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../index.php" title="Traducir al portugués">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandera de Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugués
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexBE.php" title="Traducir a flamenco">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandera de Bélgica">
                                <span class="name ms-1 align-middle">
                                    Flandes
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexIS.php" title="Traducir a islandés">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandera de Islandia">
                                <span class="name ms-1 align-middle">
                                    Islandés
                                </span>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php
}
?>