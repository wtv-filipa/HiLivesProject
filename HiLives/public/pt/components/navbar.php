<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    $User_type = $_SESSION["type"];
    $idUser = $_SESSION["idUser"];
?>
    <!--Navbar WITH login Bigger Screens-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top navBig">
        <div class="container">
            <a class="navbar-brand me-5" href="homePerson.php" title="Voltar à página inicial">
                <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <!--Menu collapse-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir para as ligações com cursos">Eu quero estudar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="matchVacancy.php" title="Ir para as ligações com vagas">Eu quero trabalhar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                    </li>
                </ul>

            </div>
            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php" title="Ir para a minha área">
                    <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Imagem de perfil">
                    <span class="name ms-1 align-middle">
                        A minha área
                    </span>
                </a>
                <div>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div>
                    <img src="../../img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
                    <span class="name ms-1 align-middle">
                        Português
                    </span>
                </div>
            </div>

        </div>
    </nav>

    <!--Navbar WITH login Smaller Screens-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top navSmall">
        <div class="container">
            <a class="navbar-brand me-5" href="homePerson.php" title="Ir para a página inicial">
                <img src="../../img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
            </a>

            <!--My area and language menu-->
            <div class="d-flex align-middle">
                <a href="profile.php" class="alignMiddle" title="Ir para a minha área">
                    <img src="../../img/no_profile_img.png" class="profileImg img-fluid" style="max-width:29px" alt="Imagem de perfil">
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
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="matchCourse.php" title="Ir para as ligações com cursos">Eu quero estudar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="matchVacancy.php" title="Ir para as ligações com vagas">Eu quero trabalhar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="stories.php" title="Ir para as histórias da HiLives">Histórias do HiLives</a>
                            </li>
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