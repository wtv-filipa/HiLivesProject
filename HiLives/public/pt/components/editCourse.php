<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_GET["uc"])) {
    $idUser = $_SESSION["idUser"];
    $iduc = $_GET["uc"];

    $query = "SELECT cu_name, university_name, date_cu
    FROM done_cu 
    WHERE users_idusers LIKE ? AND iddone_cu LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $iduc);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cu_name, $university_name, $date_cu);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <li class="breadcrumb-item"><a href="profile.php?user=<?=$idUser?>" title="Voltar à minha área">A minha área</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar uma Unidade Curricular ou Curso feito</li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["doneCU"])) {
                    $msg_show = true;
                    switch ($_SESSION["doneCU"]) {
                        case 1:
                            $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["doneCU"] = 0;
                            break;
                        case 2:
                            $message = "É necessário preencher todos os campos obrigatórios.";
                            $class = "alert-warning";
                            $_SESSION["doneCU"] = 0;
                            break;
                        case 0:
                            $msg_show = false;
                            break;
                        default:
                            $msg_show = false;
                            $_SESSION["doneCU"] = 0;
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

                <div class="card o-hidden border-0 shadowCard my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="paddingForms">
                                    <div class="text-center">
                                        <h1 class="mb-2 weightTitle">Editar a Unidade Curricular ou Curso feito</h1>
                                        <h2 class="textPink mb-4"><?= $cu_name ?></h2>
                                    </div>
                                    <form method="post" role="form" action="../../scripts/editCourse.php?uc=<?=$iduc?>">
                                        <!--NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="nomeuc">Nome da Unidade Curricular ou Curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="nomeuc" name="nomeuc" placeholder="Escreve aqui o nome da Unidade Curricular/ Curso" aria-required="true" required="required" value="<?= $cu_name ?>">
                                            </div>
                                        </div>

                                        <!--HEIS MADE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="uniuc">Instituição de Ensino Superior onde foi feita <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="uniuc" name="uniuc" placeholder="Escreve aqui o nome da Instituição de Ensino Superior onde concluíste a Unidade Curricular ou o Curso" aria-required="true" required="required" value="<?= $university_name ?>">
                                            </div>
                                        </div>

                                        <!--CONCLUSION DATE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="data">Data de conclusão <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="date" class="form-control greyBorder" id="data" name="data" placeholder="Escreve aqui o nome da Unidade Curricular/ Curso" aria-required="true" required="required" value="<?= $date_cu ?>">
                                            </div>
                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize me-4">Guardar</button>
                                                <a href="profile.php?user=<?=$idUser?>" title="Sair da edição">
                                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancelar</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    include("404.php");
}

?>