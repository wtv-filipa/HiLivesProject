<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (!isset($_SESSION["idUser"]) && !isset($_SESSION["type"])) {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="index.php" title="Voltar à página inicial">
                <img src="img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="public/pt/pages/login.php" title="Iniciar sessão">
                        <button class="btn buttonDesign buttonWork buttonLoginSize m-0">
                            Iniciar Sessão
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="index.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Mudar o idioma para português">
                        <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de Portugal">
                        <span class="name ms-1 align-middle hideTextNav">
                            Português
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="indexEN.php" title="Mudar o idioma para inglês">
                                <img src="public/img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandeira do Reino Unido">
                                <span class="name ms-1 align-middle">
                                    Inglês
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexES.php" title="Mudar o idioma para espanhol">
                                <img src="public/img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandeira de Espanha">
                                <span class="name ms-1 align-middle">
                                    Espanhol
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexBE.php" title="Mudar o idioma para flamengo">
                                <img src="public/img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandeira da Bélgica">
                                <span class="name ms-1 align-middle">
                                    Flamengo
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexIS.php" title="Mudar o idioma para islandês">
                                <img src="public/img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandeira da Islândia">
                                <span class="name ms-1 align-middle">
                                    Islandês
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