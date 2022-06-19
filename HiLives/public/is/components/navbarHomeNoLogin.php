<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (!isset($_SESSION["idUser"]) && !isset($_SESSION["type"])) {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="indexIS.php" title="Aftur heim">
                <img src="img/logo.svg" alt="HiLives app merki" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="public/pt/pages/login.php" title="Skrá inn">
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
                        <img src="public/img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Íslenski fáninn">
                        <span class="name ms-1 align-middle hideTextNav">
                            Íslenska
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../../indexEN.php" title="Þýða á ensku">
                                <img src="public/img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Fáni Bretlands">
                                <span class="name ms-1 align-middle">
                                    Enska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexES.php" title="Þýða á spænsku">
                                <img src="public/img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Fáni Spánar">
                                <span class="name ms-1 align-middle">
                                    Spænska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../indexBE.php" title="Þýða á flæmsku">
                                <img src="public/img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Fáni Belgíu">
                                <span class="name ms-1 align-middle">
                                    Flæmska
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="../../../index.php" title="Þýða á portúgölsku">
                                <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Fáni Portúgals">
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