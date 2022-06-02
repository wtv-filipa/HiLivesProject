<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query = "SELECT idusers, name_user, email_user
    FROM users
    WHERE user_type_iduser_type = 10 AND active_person = 0
    ORDER BY idusers DESC
    LIMIT 6";

    $query2 = "SELECT name_region
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE users.user_type_iduser_type = 10 AND users.active_person = 0 AND idusers = ?";
?>
    <!-- Header -->
    <div class="jumbotron bg-cover text-white startBgPerson">
        <div class="container py-5 text-center">
            <h1 class="fontWhite textBanner">Bem-vindo(a) ao HiLives!</h1>
            <div class="arrow">
                <a class="fa-solid fa-circle-chevron-down" href="#firstSectionTutor" title="Ir para a primeira secção"></a>
            </div>
        </div>
    </div>

    <!-- Matchs -->
    <section id="firstSectionTutor" class="conatiner-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">Qual é o papel de um tutor?</h2>
            <div class="row">
                <div class="col-12 col-md-6 ps-4 pe-4 marginBottomSmall">
                    <img src="../../img/add.svg" alt="Ícone de uma pessoa com um símbolo de +" class="img-fluid" title="Registo de pessoas">
                    <h3 class="mt-4 pb-2">Facilitar o registo das Pessoas com DID</h3>
                    <p>O tutor deverá de realizar uma entrevista com as Pessoas com DID para que estas possam completar o seu registo de uma forma mais simples.</p>
                    <br>
                    <a href="registerRequestsTutor.php" title="Ver pedidos de registo">
                        <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                            Ver pedidos de registo
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-6 ps-4 pe-4">
                    <img src="../../img/edit.svg" alt="Ícone de um lápis" class="img-fluid" title="Atualização dos perfis">
                    <h3 class="mt-4 pb-2">Facilitar a atualização do perfil das Pessoas com DID</h3>
                    <p class="heightEqual">Caso exista alguma pessoa com DID que necessite de atualizar campos específicos do seu perfil, esta irá pedir uma entrevista com o tutor e este vai ajudá-la com a atualização.</p>
                    <br>
                    <a href="editRequestsTutor.php" title="Ver pedidos de Edição">
                        <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                            Ver pedidos de edição
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- HiLives Stories-->
    <section class="container pt-5 pb-5">
        <h2 class="pb-4 text-center">Candidaturas recentes</h2>
        <div class="row">
            <?php

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idusers, $name_user, $email_user);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while (mysqli_stmt_fetch($stmt)) {
            ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card text-center shadowCard o-hidden border-0">
                                <div class="card-body">
                                    <img class="imgProfilePerson mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
                                    <h4 class="pb-2"><?= $name_user ?></h4>
                                    <p class="pb-0"><?= $email_user ?></p>
                                    <p>Regiões de interesse:
                                        <?php
                                        $first = true;
                                        if (mysqli_stmt_prepare($stmt2, $query2)) {
                                            mysqli_stmt_bind_param($stmt2, 'i', $idusers);
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
                                    <a href="IndividualReqCreateTutor.php?create=<?= $idusers ?>" title="Ver pedido de <?= $name_user ?>">
                                        <button class="btn buttonDesign buttonStudy buttonLoginSize m-0 mb-3">
                                            Ver pedido
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <section class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card text-center shadowCard o-hidden border-0">
                                <div class="card-body  pt-5 pb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-x-circle mb-3" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                    <p class="mx-auto" style="font-size: 1rem;">
                                        Neste momento não existe nenhum pedido de registo pendente. Por favor volte mais tarde.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php
                }
            }
            ?>
        </div>
    </section>
<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>