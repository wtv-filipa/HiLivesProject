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

    $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
    <!--Navbar WITH login Bigger Screens-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top navBig">
        <div class="container">
            <?php
            if ($User_type == 7) {
            ?>
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_be.php?comp=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_be.php?person=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_be.php?hei=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
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
                            <a class="nav-link <?= ($activePage == 'homeComp') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?comp=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchVacancyComp') ? 'active' : ''; ?>" aria-current="page" href="matchVacancyComp.php" title="Ga naar de pagina Personenlinks">Kandidaten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'allVacanciesComp') ? 'active' : ''; ?>" href="allVacanciesComp.php" title="Ga naar mijn vacaturepagina"> Vacatures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homePerson') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?person=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchCourse') ? 'active' : ''; ?>" aria-current="page" href="matchCourse.php" title="Ga naar de links met cursussen">Ik wil studeren</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchVacancy') ? 'active' : ''; ?>" href="matchVacancy.php" title="Ga naar de links met vacatures">Ik wil werken</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homeHei') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?hei=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchCourseHeis') ? 'active' : ''; ?>" aria-current="page" href="matchCourseHeis.php" title="Ga naar de pagina Personenlinks">Kandidaten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'allCoursesHeis') ? 'active' : ''; ?>" href="allCoursesHeis.php" title="Ga naar mijn cursuspagina">Cursussen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'viewVacanciesHei') ? 'active' : ''; ?>" href="viewVacanciesHei.php" title="Ga naar de pagina met de vacatures van bedrijven"> Vacatures</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homeTutor') ? 'active' : ''; ?>" aria-current="page" href="homeTutor.php" title="Terug naar home">Hoofdpagina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'registerRequestsTutor') ? 'active' : ''; ?>" aria-current="page" href="registerRequestsTutor.php" title="Ga naar de pagina Registratietoepassingen"> Registratieverzoeken</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'editRequestsTutor') ? 'active' : ''; ?>" href="editRequestsTutor.php" title="Ga naar de pagina bewerkingsverzoeken"> Verzoeken bewerken</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ga naar mijn profiel">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="<?= $profile_img ?>" alt="Profielfoto" title="Profielfoto">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Geen profielfoto" title="Geen profielfoto">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        Mijn profiel
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Vertalen naar het Vlaams">
                        <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Vlag van België">
                        <span class="name ms-1 align-middle hideTextNav">
                            Vlaams
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Vertalen naar het Engels">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Vlag van het Verenigd Koninkrijk">
                                <span class="name ms-1 align-middle">
                                    Engels
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Vertalen naar Spaans">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Vlag van Spanje">
                                <span class="name ms-1 align-middle">
                                    Spaans
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Vertalen naar het Portugees">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Vlag van Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugees
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Vertalen naar IJslands">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Vlag van IJsland">
                                <span class="name ms-1 align-middle">
                                    IJslands
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
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_be.php?comp=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_be.php?person=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_be.php?hei=<?= $idUser ?>" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Terug naar home">
                    <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            }
            ?>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ga naar mijn profiel">
                    <?php
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid" style="max-width:29px" alt="<?= $profile_img ?>" alt="Profielfoto" title="Profielfoto">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Geen profielfoto" title="Geen profielfoto">
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
                    <a class="nav-link dropdown-toggle p-0 pe-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Vertalen naar het Vlaams">
                        <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Vlag van België">
                        <span class="name ms-1 align-middle hideTextNav">
                            Vlaams
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Vertalen naar het Engels">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Vlag van het Verenigd Koninkrijk">
                                <span class="name ms-1 align-middle">
                                    Engels
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Vertalen naar Spaans">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandeira de Espanho">
                                <span class="name ms-1 align-middle">
                                    Spaans
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Vertalen naar het Portugees">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Vlag van Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugees
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Vertalen naar IJslands">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Vlag van IJsland">
                                <span class="name ms-1 align-middle">
                                    IJslands
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
                                    <a class="nav-link <?= ($activePage == 'homeComp') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?comp=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchVacancyComp') ? 'active' : ''; ?>" aria-current="page" href="matchVacancyComp.php" title="Ga naar de pagina Personenlinks">Kandidaten</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'allVacanciesComp') ? 'active' : ''; ?>" href="allVacanciesComp.php" title="Ga naar mijn vacaturepagina"> Vacatures</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homePerson') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?person=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchCourse') ? 'active' : ''; ?>" aria-current="page" href="matchCourse.php" title="Ga naar de links met cursussen">Ik wil studeren</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchVacancy') ? 'active' : ''; ?>" href="matchVacancy.php" title="Ga naar de links met vacatures">Ik wil werken</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homeHei') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_be.php?hei=<?= $idUser ?>" title="Terug naar home">Hoofdpagina</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchCourseHeis') ? 'active' : ''; ?>" aria-current="page" href="matchCourseHeis.php" title="Ga naar de pagina Personenlinks">Kandidaten</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'allCoursesHeis') ? 'active' : ''; ?>" href="allCoursesHeis.php" title="Ga naar mijn cursuspagina">Cursussen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'viewVacanciesHei') ? 'active' : ''; ?>" href="viewVacanciesHei.php" title="Ir para a página das vagas das empresas">Vagas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homeTutor') ? 'active' : ''; ?>" aria-current="page" href="homeTutor.php" title="Terug naar home">Hoofdpagina</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'registerRequestsTutor') ? 'active' : ''; ?>" aria-current="page" href="registerRequestsTutor.php" title="Ga naar de pagina Registratietoepassingen"> Registratieverzoeken</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'editRequestsTutor') ? 'active' : ''; ?>" href="editRequestsTutor.php" title="Ga naar de pagina bewerkingsverzoeken"> Verzoeken bewerken</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Ga naar HiLives" verhalen>HiLives verhalen</a>
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
            <a class="navbar-brand me-5" href="../../../indexBE.php" title="Terug naar home">
                <img src="../../img/logo.svg" alt="HiLives Logootype" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="login.php" title="Aanmelden">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmallerPT m-0">
                            Aanmelden
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="indexBE.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Vertalen naar het Vlaams">
                        <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Vlag van België">
                        <span class="name ms-1 align-middle hideTextNav">
                            Vlaams
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../indexEN.php" title="Vertalen naar het Engels">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Vlag van het Verenigd Koninkrijk">
                                <span class="name ms-1 align-middle">
                                    Engels
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexES.php" title="Vertalen naar Spaans">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Vlag van Spanje">
                                <span class="name ms-1 align-middle">
                                    Spaans
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../index.php" title="Vertalen naar het Portugees">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Vlag van Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugees
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexIS.php" title="Vertalen naar IJslands">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Vlag van IJsland">
                                <span class="name ms-1 align-middle">
                                    IJslands
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