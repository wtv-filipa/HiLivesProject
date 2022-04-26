<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["edit"]) && isset($_SESSION["type"])) {
    $idUser = $_GET["edit"];
    $idStory = $_GET["edit"];
    $User_type = $_SESSION["type"];

    $query = "SELECT description
    FROM experiences 
    WHERE idexperiences =?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $description);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb">
                        <?php
                        if ($User_type == 7) {
                        ?>
                            <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <?php
                        } else if ($User_type == 10) {
                        ?>
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <?php
                        } else if ($User_type == 13) {
                        ?>
                            <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <?php
                        } else if ($User_type == 16) {
                        ?>
                            <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <?php
                        }
                        ?>
                        <li class="breadcrumb-item"><a href="stories" title="Voltar às histórias">Histórias da HiLives</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar uma história da HiLives</li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["story"])) {
                    $msg_show = true;
                    switch ($_SESSION["story"]) {
                        case 1:
                            $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["story"] = 0;
                            break;
                        case 2:
                            $message = "É necessário preencher todos os campos obrigatórios.";
                            $class = "alert-warning";
                            $_SESSION["story"] = 0;
                            break;
                        case 0:
                            $msg_show = false;
                            break;
                        default:
                            $msg_show = false;
                            $_SESSION["story"] = 0;
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
                                        <h1 class="mb-4 weightTitle">Editar a história</h1>
                                    </div>
                                    <form method="post" role="form" id="register-form" action="../../scripts/editStory.php?xp=<?= $idStory ?>">
                                        <!--DESCRIPTION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="descricao">Descrição <span class="asterisk">*</span></label>
                                            <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Descreve a tua história" aria-required="true" required="required"><?= $description ?></textarea>
                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Guardar</button>
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