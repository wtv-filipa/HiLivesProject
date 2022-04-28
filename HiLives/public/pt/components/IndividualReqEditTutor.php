<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["edit"])) {
    $idNavegar = $_SESSION["idUser"];
    $idUser = $_GET["edit"];

    $query = "SELECT name_user, email_user, contact_user, birth_date, status_edit
    FROM users
    WHERE idusers = ?";

    $query2 = "SELECT name_region
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $birth_date, $status_edit);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                $newDate = date('d-m-Y', strtotime($birth_date))
?>
                <section class="container-fluid bgGreyReq">
                    <div class="container">
                        <!--BREADCRUMBS-->
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="pt-4">
                            <ol class="breadcrumb reqBreadcrumb">
                                <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                                <li class="breadcrumb-item"><a href="editRequestsTutor" title="Voltar aos pedidos de edição">Pedidos para editar o perfil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pedido de <?= $name_user ?></li>
                            </ol>
                        </nav>

                        <h1 class="pt-4 pb-2">Pedido para editar o perfil de</h1>
                        <h3 class="pb-5 textBlue"><?= $name_user ?></h3>
                        <!--PROFILE STAGES BIG-->
                        <div class="row pb-4 bigBg">
                            <div class="col-12 text-center">
                                <div class="imageLearn">
                                    <?php
                                    if ($status_edit == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit1.svg" alt="Pedido em estado pendente" title="Pedido em estado pendente" />
                                    <?php
                                    } else if ($status_edit == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit2.svg" alt="Entrevista marcada" title="Entrevista marcada" />
                                    <?php
                                    } else if ($status_edit == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit3.svg" alt="Perfil completo" title="Perfil completo" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!--PROFILE STAGES SMALL-->
                        <div class="row pb-4 smallBg">
                            <div class="col-12 text-center">
                                <div class="imageLearn">
                                    <?php
                                    if ($status_edit == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit_small1.svg" alt="Pedido em estado pendente" title="Pedido em estado pendente" />
                                    <?php
                                    } else if ($status_edit == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit_small2.svg" alt="Entrevista marcada" title="Entrevista marcada" />
                                    <?php
                                    } else if ($status_edit == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/pending_edit_small3.svg" alt="Perfil completo" title="Perfil completo" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Info bigger devices-->
                <section class="jumbotron bgCoverSection EditBg bigBg">
                    <div class="bg-white bg-whiteSizeAdjust ps-5 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Informação sobre</h1>
                        <h3 class="pb-4 text-center textBlue"><?= $name_user ?></h3>
                        <p><b>Email</b>: <?= $email_user ?></p>
                        <p><b>Contacto</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Regiões de interesse:
                            </b>
                            <?php
                            $first = true;
                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                mysqli_stmt_execute($stmt2);
                                mysqli_stmt_bind_result($stmt2, $name_region);
                                while (mysqli_stmt_fetch($stmt2)) {
                                    if (!$first) {
                                        echo ",";
                                    }
                                    $first = false;
                                    echo " $name_region";
                                }
                            }
                            ?>
                        </p>
                        <p><b>Date of birth</b>: <?= $newDate ?> </p>
                        <div class="text-center pt-4">
                            <a href="editProfileTutor.php?edit=<?= $idUser ?>" title="Editar perfil">
                                <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                                    Editar perfil
                                </button>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Info smaller devices-->
                <section class="smallBg whiteBg">
                    <div class="jumbotron bgCoverSection EditBg smallBg"></div>
                    <div class="bg-white ps-3 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Informação sobre</h1>
                        <h3 class="pb-4 text-center textBlue"><?= $name_user ?></h3>
                        <p><b>Email</b>: <?= $email_user ?></p>
                        <p><b>Contacto</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Regiões de interesse:
                            </b>
                            <?php
                            $first = true;
                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                mysqli_stmt_execute($stmt2);
                                mysqli_stmt_bind_result($stmt2, $name_region);
                                while (mysqli_stmt_fetch($stmt2)) {
                                    if (!$first) {
                                        echo ",";
                                    }
                                    $first = false;
                                    echo " $name_region";
                                }
                            }
                            ?>
                        </p>
                        <p><b>Date of birth</b>: <?= $newDate ?> </p>
                        <div class="text-center pt-4 pb-3">
                            <a href="editProfileTutor.php?edit=<?= $idUser ?>" title="Editar perfil">
                                <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                                    Editar perfil
                                </button>
                            </a>
                        </div>
                    </div>
                </section>

                <section class="container-fluid bgGreyReq">
                    <div class="container pt-5 pb-5">
                        <h1 class="pb-5">Ligações de <?= $name_user ?></h1>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Cursos
                                    </button>
                                </h3>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-3">
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listStudy text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listStudy text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listStudy text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Vagas
                                    </button>
                                </h3>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-3">
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listWork text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listWork text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>
                                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                <div class="list listWork text-center">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <span class="ps-2 align-middle">Trabalhar</span>
                                                    </p>
                                                    <h4>Novas Tecnologias da Comunicação</h4>
                                                    <p>Universidade de Aveiro</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
<?php
            }
        }
    }
} else {
    include("404.php");
}

mysqli_close($link);

?>