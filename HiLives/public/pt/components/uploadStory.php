<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>

    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item"><a href="stories.php" title="Voltar às histórias da HiLives">Histórias da HiLives</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar uma nova história à HiLives</li>
            </ol>
        </nav>

        <?php
        if (isset($_SESSION["xp_jovem"])) {
            $msg_show = true;
            switch ($_SESSION["xp_jovem"]) {
                case 1:
                    $message = "O ficheiro que tentaste carregar não é um vídeo.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 2:
                    $message = "O vídeo que tentaste carregar já existe nas tuas experiências.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 3:
                    $message = "É necessário preencher pelo menos um campo.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 4:
                    $message = "O ficheiro que tentaste carregar tem um tamanho superior ao suportado.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 5:
                    $message = "O ficheiro que tentaste carregar tem um formato que não é suportado pela nossa aplicação.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 6:
                    $message = "Ocorreu um erro ao carregar o teu ficheiro, por favor volta a tentar.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 7:
                    $message = "Ocorreu um erro ao carregar a tua história, por favor volta a tentar.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["xp_jovem"] = 0;
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
                                <h1 class="mb-4 weightTitle">Carregar uma história</h1>
                            </div>
                            <form method="post" role="form" class="inserir_dados" action="../../scripts/uploadStory.php?xp=<?= $id_navegar ?>" enctype="multipart/form-data">
                                <!--FILES-->
                                <div class="alert alert-warning mb-3" role="alert">
                                    Insere um vídeo, áudio ou imagem até 50MB (Opcional).
                                </div>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4, .mov, .jpg, .png, .svg, .ogg, .mp3, .wav">
                                    <label class="custom-file-label" for="fileToUpload">Escolher ficheiro</label>
                                </div>
                                <!--DESCRIPTION-->
                                <div class="form-group pb-4">
                                    <label class="boldFont mt-3 pb-2" for="descricao">Descrição</label>
                                    <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Descreve a tua história"></textarea>
                                </div>

                                <div class="form-group text-center mt-2">
                                    <div class="mx-auto col-sm-10 pb-3 pt-2">
                                        <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Adicionar</button>
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
} else {
    include("404.php");
}
?>