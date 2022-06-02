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
                <a class="navbar-brand me-5" href="homeComp.php" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="homePerson.php" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="homeHei.php" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
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
                            <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Go to the connections with people page">Candidates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allVacanciesComp.php" title="Go to my vacancies page">Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourse.php" title="Go to course connections">I want to study</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="matchVacancy.php" title="Go to vacancies connections">I want to work</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Go to the connections with people page">Candidates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allCoursesHeis.php" title="Go to my courses page">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewVacanciesHei.php" title="Go to my courses page">Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="IGo to the registration request page">Registration requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editRequestsTutor.php" title="Go to the edit requests page">Editing requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Go to my area">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="<?= $profile_img ?>" alt="Profile picture" title="Profile picture">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Without profile picture" title="Without profile picture">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        My area
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change language to english">
                        <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Flag of Portugal">
                        <span class="name ms-1 align-middle hideTextNav">
                            English
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Change language to portuguese">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Flag of the United Kingdom">
                                <span class="name ms-1 align-middle">
                                    Portuguese
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Change language to spanish">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Flag of Spain">
                                <span class="name ms-1 align-middle">
                                    Spanish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Change language to flemish">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Flag of Belgium">
                                <span class="name ms-1 align-middle">
                                    Flemish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Change language to icelandic">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Flag of Iceland">
                                <span class="name ms-1 align-middle">
                                    Icelandic
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
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_en.php?comp=<?= $idUser ?>" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_en.php?person=<?= $idUser ?>" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <!--Link with match-->
                <a class="navbar-brand me-5" href="../../scripts/matchLogo_en.php?hei=<?= $idUser ?>" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Back to homepage">
                    <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
                </a>
            <?php
            }
            ?>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Go to my area">
                    <?php
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid" style="max-width:29px" alt="<?= $profile_img ?>" alt="Profile picture" title="Profile picture">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Without profile picture" title="Without profile picture">
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
                    <a class="nav-link dropdown-toggle ps-0 pe-0" href="homePerson.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change language to english">
                        <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Flag of Portugal">
                        <span class="name ms-1 align-middle hideTextNav">
                            English
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../pt/pages/homePerson.php" title="Change language to portuguese">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Flag of the United Kingdom">
                                <span class="name ms-1 align-middle">
                                    Portuguese
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../es/pages/homePerson.php" title="Change language to spanish">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Flag of Spain">
                                <span class="name ms-1 align-middle">
                                    Spanish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../be/pages/homePerson.php" title="Change language to flemish">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Flag of Belgium">
                                <span class="name ms-1 align-middle">
                                    Flemish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../is/pages/homePerson.php" title="Change language to icelandic">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Flag of Iceland">
                                <span class="name ms-1 align-middle">
                                    Icelandic
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
                                    <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Go to the connections with people page">Candidates</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allVacanciesComp.php" title="Go to my vacancies page">Vacancies</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourse.php" title="Go to courses connections">I want to study</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="matchVacancy.php" title="Go to vacancies connections">I want to work</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Go to the connections with people page">Candidates</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allCoursesHeis.php" title="Go to my courses page">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="viewVacanciesHei.php" title="Go to my courses page">Vacancies</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Go to the registration requests page">Registration requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="editRequestsTutor.php" title="Go to the edit requests page">Edit requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Go to HiLives stories">HiLives stories</a>
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
            <a class="navbar-brand me-5" href="../../../indexEN.php" title="Back to homepage">
                <img src="../../img/logo.svg" alt="HiLives logo" class="img-fluid logo" title="HiLives logo">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="login.php" title="Iniciar sessão">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmaller m-0">
                            Login
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="../../../indexEN.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change language to english">
                        <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Flag of Portugal">
                        <span class="name ms-1 align-middle hideTextNav">
                            English
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../index.php" title="Change language to portuguese">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Flag of the United Kingdom">
                                <span class="name ms-1 align-middle">
                                    Portuguese
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexES.php" title="Change language to spanish">
                                <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Flag of Spain">
                                <span class="name ms-1 align-middle">
                                    Spanish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexBE.php" title="Change language to flemish">
                                <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Flag of Belgium">
                                <span class="name ms-1 align-middle">
                                    Flemish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexIS.php" title="Change language to icelandic">
                                <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Flag of Iceland">
                                <span class="name ms-1 align-middle">
                                    Icelandic
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