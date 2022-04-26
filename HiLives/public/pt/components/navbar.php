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
                <a class="navbar-brand me-5" href="homeComp.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="homePerson.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="homeHei.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
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
                            <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Ir para a página das ligações com pessoas">Candidatos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allVacanciesComp.php" title="Ir para a página das minhas vagas">Vagas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 10) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir para as ligações com cursos">Eu quero estudar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="matchVacancy.php" title="Ir para as ligações com vagas">Eu quero trabalhar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 13) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Ir para a página das ligações com pessoas">Candidatos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allCoursesHeis.php" title="Ir para a página dos meus cursos">Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                        </li>
                    <?php
                    } else if ($User_type == 16) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Ir para a página de pedidos de registo">Pedidos de registo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editRequestsTutor.php" title="Ir para a página de pedidos de edição">Pedidos de edição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ir para a minha área">
                    <?php
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="<?= $profile_img ?>" title="Imagem de perfil">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid alignMiddle" style="max-width:29px" alt="Imagem de perfil">
                    <?php
                            }
                        }
                    }
                    ?>

                    <span class="name mb-0 ms-2 align-middle">
                        A minha área
                    </span>
                </a>
                <div class="alignMiddle">
                    <span class="name ms-2 mb-0 me-2 align-middle">
                        |
                    </span>
                </div>

                <button class="navbar-toggler alignMiddle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavLightDropdown" aria-controls="navbarNavLightDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon alignMiddle"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavLightDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                                <span class="name ms-1 align-middle">
                                    Português
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">
                                        <img src="../../img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                                        <span class="name ms-1 align-middle">
                                            Inglês
                                        </span>
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <img src="../../img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                                        <span class="name ms-1 align-middle">
                                            Espanhol
                                        </span>
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <img src="../../img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                                        <span class="name ms-1 align-middle">
                                            Flamengo
                                        </span>
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <img src="../../img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                                        <span class="name ms-1 align-middle">
                                            Islandês
                                        </span>
                                    </a></li>
                            </ul>
                        </li>
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
                <a class="navbar-brand me-5" href="homeComp.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 10) {
            ?>
                <a class="navbar-brand me-5" href="homePerson.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 13) {
            ?>
                <a class="navbar-brand me-5" href="homeHei.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            } else if ($User_type == 16) {
            ?>
                <a class="navbar-brand me-5" href="homeTutor.php" title="Voltar à página inicial">
                    <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
                </a>
            <?php
            }
            ?>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php?user=<?= $idUser ?>" class="alignMiddle" title="Ir para a minha área">
                    <?php
                    $stmt = mysqli_stmt_init($link);
                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $profile_img);
                        while (mysqli_stmt_fetch($stmt)) {
                            if (isset($profile_img)) {

                    ?>
                                <img src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" class="profileImg img-fluid" style="max-width:29px" alt="<?= $profile_img ?>" title="Imagem de perfil">
                            <?php
                            } else {
                            ?>
                                <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Imagem de perfil">
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
                <div class="alignMiddle me-2">
                    <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
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
                                    <a class="nav-link" aria-current="page" href="matchVacancyComp.php" title="Ir para a página das ligações com pessoas">Candidatos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allVacanciesComp.php" title="Ir para a página das minhas vagas">Vagas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 10) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir para as ligações com cursos">Eu quero estudar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="matchVacancy.php" title="Ir para as ligações com vagas">Eu quero trabalhar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="matchCourseHeis.php" title="Ir para a página das ligações com pessoas">Candidatos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="allCoursesHeis.php" title="Ir para a página dos meus cursos">Cursos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                                </li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="registerRequestsTutor.php" title="Ir para a página de pedidos de registo">Pedidos de registo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="editRequestsTutor.php" title="Ir para a página de pedidos de edição">Pedidos de edição</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
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
            <a class="navbar-brand me-5" href="../../../index.php" title="Voltar à página inicial">
                <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="login.php" title="Iniciar sessão">
                        <button class="btn buttonDesign buttonWork buttonLoginSize m-0">
                            Iniciar Sessão
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="align-middle">
                    <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                    <span class="name ms-1 align-middle hideTextNav">
                        Português
                    </span>
                </div>
            </div>
        </div>
    </nav>
<?php
}
?>