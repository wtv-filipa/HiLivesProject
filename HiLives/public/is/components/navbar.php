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
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_is.php?comp=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_is.php?person=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="matchLogo_is.php?hei=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
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
                            <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allVacanciesComp.php" title="Fara á síðuna mína um laus störf">Laus störf</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourse.php" title="Fara í tengla með námskeiðum">Mig langar að læra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="matchVacancy.php" title="Fara í tengingar við laus störf">Mig langar að vinna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allCoursesHeis.php" title="Fara á námskeiðasíðuna mína">Námskeið</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewVacanciesHei.php" title="Fara á síðuna með lausum störfum fyrirtækja">Laus störf</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Fara á síðu skráningarbeiðna">Umsóknir um skráningu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editRequestsTutor.php" title="Fara á síðuna breyta beiðnum">Beiðnum breytt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Fara á svæðið mitt">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="<?= $profile_img ?>" alt="Forstillingarmynd" title="Forstillingarmynd">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Engin prófílmynd" title="Engin prófílmynd">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        Svæðið mitt
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Þýða á íslensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Íslenski fáninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            Íslenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Þýða á ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Fáni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Þýða á spænsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Fáni Spánar">
                                <span class="name ms-1 align-middle">
                                    Spænska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Þýða á flæmsku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Fáni Belgíu">
                                <span class="name ms-1 align-middle">
                                    Flæmska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Þýða á portúgölsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Fáni Portúgals">
                                <span class="name ms-1 align-middle">
                                    Portúgalska
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
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_is.php?comp=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_is.php?person=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_is.php?hei=<?= $idUser ?>" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Aftur heim">
                    <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            }
            ?>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Fara á svæðið mitt">
                    <?php
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid" style="max-width:29px" alt="<?= $profile_img ?>" alt="Forstillingarmynd" title="Forstillingarmynd">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Engin prófílmynd" title="Engin prófílmynd">
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
                    <a class="nav-link dropdown-toggle ps-0 pe-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Þýða á íslensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Íslenski fáninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            Íslenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="Þýða á ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Fáni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Þýða á spænsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandeira de Espanho">
                                <span class="name ms-1 align-middle">
                                    Spænska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Þýða á flæmsku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Fáni Belgíu">
                                <span class="name ms-1 align-middle">
                                    Flæmska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Þýða á portúgölsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Fáni Portúgals">
                                <span class="name ms-1 align-middle">
                                    Portúgalska
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
                                    <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allVacanciesComp.php" title="Fara á síðuna mína um laus störf">Laus störf</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourse.php" title="Fara í tengla með námskeiðum">Mig langar að læra</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="matchVacancy.php" title="Fara í tengingar við laus störf">Mig langar að vinna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Fara á tenglana með fólk síðu">Frambjóðendur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allCoursesHeis.php" title="Fara á námskeiðasíðuna mína">Námskeið</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewVacanciesHei.php" title="Ir para a página das vagas das empresas">Laus störf</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Fara á síðu skráningarbeiðna">Umsóknir um skráningu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="editRequestsTutor.php" title="Fara á síðuna breyta beiðnum">Beiðnum breytt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Fara í HiLives sögur">HiLives sögur</a>
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
            <a class="navbar-brand me-5" href="../../../indexIS.php" title="Aftur heim">
                <img src="../../img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="login.php" title="Skrá inn">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmallerPT m-0">
                            Skrá inn
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="indexIS.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Þýða á íslensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Íslenski fáninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            Íslenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../indexEN.php" title="Þýða á ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Fáni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexES.php" title="Þýða á spænsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Fáni Spánar">
                                <span class="name ms-1 align-middle">
                                    Spænska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexBE.php" title="Þýða á flæmsku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Fáni Belgíu">
                                <span class="name ms-1 align-middle">
                                    Flæmska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../index.php" title="Þýða á portúgölsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Fáni Portúgals">
                                <span class="name ms-1 align-middle">
                                    Portúgalska
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