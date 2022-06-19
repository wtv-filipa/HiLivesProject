<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (!isset($_SESSION["idUser"]) && !isset($_SESSION["type"])) {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="indexES.php" title="Voltar à página inicial">
                <img src="img/logo.svg" alt="Logotipo de la aplicación HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="public/es/pages/login.php" title="Ir a la página de inicio de sesión">
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
                        <img src="public/img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Bandera de España">
                        <span class="name ms-1 align-middle hideTextNav">
                            Español
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="indexEN.php" title="Traducir al inglés">
                                <img src="public/img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Bandera del Reino Unido">
                                <span class="name ms-1 align-middle">
                                    Inglés
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="index.php" title="Traducir al portugués">
                                <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandera de Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugués
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexBE.php" title="Traducir a flamenco">
                                <img src="public/img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Bandera de Bélgica">
                                <span class="name ms-1 align-middle">
                                    Flandes
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexIS.php" title="Traducir a islandés">
                                <img src="public/img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Bandera de Islandia">
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