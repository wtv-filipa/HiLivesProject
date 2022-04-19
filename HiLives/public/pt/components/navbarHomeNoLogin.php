<?php
require_once("connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (!isset($_SESSION["idUser"]) && !isset($_SESSION["type"])) {
?>
    <!--Navbar WITHOUT login-->
    <nav class="navbar navbar-expand-lg navbar-light navColor sticky-top">
        <div class="container">
            <a class="navbar-brand me-5" href="index.php">
                <img src="img/logo.svg" alt="logótipo da aplicação HiLives" class="img-fluid logo" title="HiLives">
            </a>
            <div class="d-flex align-middle">
                <div>
                    <a href="public/pt/pages/login.php">
                        <button class="btn buttonDesign buttonWork buttonLoginSize m-0">
                            Iniciar Sessão
                        </button>
                    </a>
                    <span class="name ms-2 me-2 align-middle">
                        |
                    </span>
                </div>
                <div class="align-middle">
                    <img src="public/img/flags/pt.png" class="img-fluid" style="max-width:23px" alt="Bandeira de portugal">
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