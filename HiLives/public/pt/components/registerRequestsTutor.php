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
    ORDER BY idusers DESC";

    $query2 = "SELECT name_region
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE users.user_type_iduser_type = 10 AND users.active_person = 0 AND idusers = ?";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedidos de registo</li>
            </ol>
        </nav>

        <h1 class="pb-2">Pedidos de registo</h1>
        <p class="pb-4">Nesta página é possível ver quais são os pedidos de registo que ainda estão pendentes.</p>

        <section class="pb-5">
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
                                        <img class="imgProfilePerson borderPink mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem padrão" />
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
                                            ?></p>
                                        <a href="IndividualReqCreateTutor.php?create=<?= $idusers ?>" title="Ver pedido">
                                            <button class="btn buttonDesign buttonStudy buttonLoginSize m-0 mb-3">
                                                Ver pedido
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </section>

    </div>
<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>