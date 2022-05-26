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
                                        <h1 class="mb-4 weightTitle">
                                            Editar a história
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="O texto deve ter uma linguagem simples. Sempre que encontrares um símbolo semelhante junto dos campos a preencher, podes ver dicas de como os preencher. Grava os teus vídeos ou imagens na horizontal, para que as outras pessoas os possam ver com mais facilidade.">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </h1>
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