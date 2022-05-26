<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT idvacancies, vacancy_name, areas_idareas, name_interested_area
    FROM vacancies
    INNER JOIN areas ON vacancies.areas_idareas = areas.idareas
    WHERE company_id = ? ORDER BY idvacancies DESC";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">Vagas</li>
            </ol>
        </nav>

        <?php
        if (isset($_SESSION["vac"])) {
            $msg_show = true;
            switch ($_SESSION["vac"]) {
                case 1:
                    $message = "Vaga carregada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 2:
                    $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["vac"] = 0;
                    break;
                case 3:
                    $message = "Vaga editada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 4:
                    $message = "Vaga eliminada com sucesso!";
                    $class = "alert-success";
                    $_SESSION["vac"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["vac"] = 0;
            }

            if ($msg_show == true) {
                echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                     <button type=\"button\" class=\"close\" data-bs-dismiss=\"alert\" aria-label=\"Close\">
                        <span title=\"Fechar\" aria-hidden=\"true\" style=\"position: absolute;
                         top: 0;
                         right: 0;
                         padding: 0.75rem 1.25rem;
                         color: inherit;\">&times;</span>
                    </button>
                </div>";
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        }
        ?>

        <h1 class="pb-2">As minhas vagas</h1>
        <p class="pb-4">Aqui pode gerir todas as suas vagas publicadas até ao momento.</p>

        <section class="row">
            <?php

            if (mysqli_stmt_prepare($stmt, $query1)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idvacancies, $vacancy_name, $areas_idareas, $name_interested_area);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while (mysqli_stmt_fetch($stmt)) {
            ?>
                        <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                            <div class="list listWork text-center">
                                <a href="infoVacancy.php?vac=<?= $idvacancies ?>" title="Ver informações da vaga <?= $vacancy_name ?>">
                                    <h4><?= $vacancy_name ?></h4>
                                </a>
                                <p><?= $name_interested_area ?></p>
                                <div>
                                    <a href="editVacancy.php?vac=<?= $idvacancies ?>" class="linkIcons" title="Editar a vaga <?= $vacancy_name ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-3" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deletevac<?= $idvacancies ?>" class="linkIcons" title="Eliminar a vaga <?= $vacancy_name ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        include('../components/deleteModal.php');
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
                                        Neste momento não tem nenhuma vaga adicionada.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php
                }
            }
            ?>
        </section>

        <div class="text-center pt-4 pb-5">
            <a href="uploadVacancy.php" title="Adicionar novas vagas">
                <button class="btn buttonDesign buttonWork buttonRegisterSizeHEI m-0">Adicionar novas vagas</button>
            </a>
        </div>

    </div>

<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>