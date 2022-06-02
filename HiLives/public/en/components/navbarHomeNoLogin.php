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
                    <a href="public/en/pages/login.php" title="Iniciar sessão">
                        <button class="btn buttonDesign buttonWork buttonLoginSizeSmaller m-0">
                            Login
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>

                <div class="nav-item dropdown align-middle">
                    <a class="nav-link dropdown-toggle p-0" href="indexEN.php" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change language to english">
                        <img src="public/img/flags/en.png" class="img-fluid" style="max-width:23px" alt="Flag of Portugal">
                        <span class="name ms-1 align-middle hideTextNav">
                            English
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php" title="Change language to portuguese">
                                <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Flag of the United Kingdom">
                                <span class="name ms-1 align-middle">
                                    Portuguese
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexES.php" title="Change language to spanish">
                                <img src="public/img/flags/es.png" class="img-fluid" style="max-width:23px" alt="Flag of Spain">
                                <span class="name ms-1 align-middle">
                                    Spanish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexBE.php" title="Change language to flemish">
                                <img src="public/img/flags/be.png" class="img-fluid" style="max-width:23px" alt="Flag of Belgium">
                                <span class="name ms-1 align-middle">
                                    Flemish
                                </span>
                            </a></li>
                        <li><a class="dropdown-item" href="indexIS.php" title="Change language to icelandic">
                                <img src="public/img/flags/is.png" class="img-fluid" style="max-width:23px" alt="Flag of Iceland">
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