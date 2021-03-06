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
                            <a class="nav-link <?= ($activePage == 'homeComp') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?comp=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchVacancyComp') ? 'active' : ''; ?>" aria-current="page" href="matchVacancyComp.php" title="Fara ?? tenglana me?? f??lk s????u">Frambj????endur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'allVacanciesComp') ? 'active' : ''; ?>" href="allVacanciesComp.php" title="Fara ?? s????una m??na um laus st??rf">Laus st??rf</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homePerson') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?person=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchCourse') ? 'active' : ''; ?>" aria-current="page" href="matchCourse.php" title="Fara ?? tengla me?? n??mskei??um">Mig langar a?? l??ra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchVacancy') ? 'active' : ''; ?>" href="matchVacancy.php" title="Fara ?? tengingar vi?? laus st??rf">Mig langar a?? vinna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homeHei') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?hei=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'matchCourseHeis') ? 'active' : ''; ?>" aria-current="page" href="matchCourseHeis.php" title="Fara ?? tenglana me?? f??lk s????u">Frambj????endur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'allCoursesHeis') ? 'active' : ''; ?>" href="allCoursesHeis.php" title="Fara ?? n??mskei??as????una m??na">N??mskei??</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'viewVacanciesHei') ? 'active' : ''; ?>" href="viewVacanciesHei.php" title="Fara ?? s????una me?? lausum st??rfum fyrirt??kja">Laus st??rf</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'homeTutor') ? 'active' : ''; ?>" aria-current="page" href="homeTutor.php" title="Aftur heim">Heimas????a</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'registerRequestsTutor') ? 'active' : ''; ?>" aria-current="page" href="registerRequestsTutor.php" title="Fara ?? s????u skr??ningarbei??na">Ums??knir um skr??ningu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'editRequestsTutor') ? 'active' : ''; ?>" href="editRequestsTutor.php" title="Fara ?? s????una breyta bei??num">Bei??num breytt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Fara ?? sv????i?? mitt">
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
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Engin pr??f??lmynd" title="Engin pr??f??lmynd">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        Sv????i?? mitt
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="??????a ?? ??slensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="??slenski f??ninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            ??slenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="??????a ?? ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="F??ni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="??????a ?? sp??nsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="F??ni Sp??nar">
                                <span class="name ms-1 align-middle">
                                    Sp??nska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="??????a ?? fl??msku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="F??ni Belg??u">
                                <span class="name ms-1 align-middle">
                                    Fl??mska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="??????a ?? port??g??lsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="F??ni Port??gals">
                                <span class="name ms-1 align-middle">
                                    Port??galska
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
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Fara ?? sv????i?? mitt">
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
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Engin pr??f??lmynd" title="Engin pr??f??lmynd">
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
                    <a class="nav-link dropdown-toggle ps-0 pe-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="??????a ?? ??slensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="??slenski f??ninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            ??slenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../en/pages/homePerson.php" title="??????a ?? ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="F??ni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="??????a ?? sp??nsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandeira de Espanho">
                                <span class="name ms-1 align-middle">
                                    Sp??nska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="??????a ?? fl??msku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="F??ni Belg??u">
                                <span class="name ms-1 align-middle">
                                    Fl??mska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="??????a ?? port??g??lsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="F??ni Port??gals">
                                <span class="name ms-1 align-middle">
                                    Port??galska
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
                                    <a class="nav-link <?= ($activePage == 'homeComp') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?comp=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchVacancyComp') ? 'active' : ''; ?>" aria-current="page" href="matchVacancyComp.php" title="Fara ?? tenglana me?? f??lk s????u">Frambj????endur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'allVacanciesComp') ? 'active' : ''; ?>" href="allVacanciesComp.php" title="Fara ?? s????una m??na um laus st??rf">Laus st??rf</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homePerson') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?person=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchCourse') ? 'active' : ''; ?>" aria-current="page" href="matchCourse.php" title="Fara ?? tengla me?? n??mskei??um">Mig langar a?? l??ra</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchVacancy') ? 'active' : ''; ?>" href="matchVacancy.php" title="Fara ?? tengingar vi?? laus st??rf">Mig langar a?? vinna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homeHei') ? 'active' : ''; ?>" aria-current="page" href="../../scripts/matchLogo_is.php?hei=<?= $idUser ?>" title="Aftur heim">Heimas????a</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'matchCourseHeis') ? 'active' : ''; ?>" aria-current="page" href="matchCourseHeis.php" title="Fara ?? tenglana me?? f??lk s????u">Frambj????endur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'allCoursesHeis') ? 'active' : ''; ?>" href="allCoursesHeis.php" title="Fara ?? n??mskei??as????una m??na">N??mskei??</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'viewVacanciesHei') ? 'active' : ''; ?>" href="viewVacanciesHei.php" title="Ir para a p??gina das vagas das empresas">Laus st??rf</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'homeTutor') ? 'active' : ''; ?>" aria-current="page" href="homeTutor.php" title="Aftur heim">Heimas????a</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'registerRequestsTutor') ? 'active' : ''; ?>" aria-current="page" href="registerRequestsTutor.php" title="Fara ?? s????u skr??ningarbei??na">Ums??knir um skr??ningu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'editRequestsTutor') ? 'active' : ''; ?>" href="editRequestsTutor.php" title="Fara ?? s????una breyta bei??num">Bei??num breytt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'stories') ? 'active' : ''; ?>" href="stories.php" title="Fara ?? HiLives s??gur">HiLives s??gur</a>
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
                    <a href="login.php" title="Skr?? inn">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmallerPT m-0">
                            Skr?? inn
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="indexIS.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="??????a ?? ??slensku">
                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="??slenski f??ninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            ??slenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../indexEN.php" title="??????a ?? ensku">
                                <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="F??ni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexES.php" title="??????a ?? sp??nsku">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="F??ni Sp??nar">
                                <span class="name ms-1 align-middle">
                                    Sp??nska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexBE.php" title="??????a ?? fl??msku">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="F??ni Belg??u">
                                <span class="name ms-1 align-middle">
                                    Fl??mska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../index.php" title="??????a ?? port??g??lsku">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="F??ni Port??gals">
                                <span class="name ms-1 align-middle">
                                    Port??galska
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