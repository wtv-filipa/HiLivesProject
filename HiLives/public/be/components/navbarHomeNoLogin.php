<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (!isset($_SESSION["idUser"]) && !isset($_SESSION["type"])) {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="indexBE.php" title="Terug naar home">
                <img src="img/logo.svg" alt="HiLives app logo" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="public/be/pages/login.php" title="Aanmelden">
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
                        <img src="public/img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Vlag van België">
                        <span class="name ms-1 align-middle hideTextNav">
                            Vlaams
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="indexEN.php" title="Vertalen naar het Engels">
                                <img src="public/img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Vlag van het Verenigd Koninkrijk">
                                <span class="name ms-1 align-middle">
                                    Engels
                                </span>
                            </a></li>
                            <li><a class="dropdown-item" href="indexES.php" title="Vertalen naar Spaans">
                                <img src="public/img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Vlag van Spanje">
                                <span class="name ms-1 align-middle">
                                    Spaans
                                </span>
                            </a></li>
                            <li><a class="dropdown-item" href="index.php" title="Vertalen naar het Portugees">
                                <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Vlag van Portugal">
                                <span class="name ms-1 align-middle">
                                    Portugees
                                </span>
                            </a></li>
                            <li><a class="dropdown-item" href="indexIS.php" title="Vertalen naar IJslands">
                                <img src="public/img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Vlag van IJsland">
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