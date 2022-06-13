<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$idUser = $_SESSION["idUser"];

?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php" title="Volver a la página de inicio">Página de inicio</a></li>
            <li class="breadcrumb-item"><a href="profile.php" title="Volver a mi área">Mi área</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cargar un nuevo curso o unidad de curso hecho</li>
        </ol>
    </nav>
    <?php
    if (isset($_SESSION["doneCU"])) {
        $msg_show = true;
        switch ($_SESSION["doneCU"]) {
            case 1:
                $message = "Se ha producido un error al procesar su solicitud, por favor inténtelo más tarde.";
                $class = "alert-warning";
                $_SESSION["doneCU"] = 0;
                break;
            case 2:
                $message = "Deben rellenarse todos los campos obligatorios.";
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
                            <h1 class="mb-4 weightTitle">Añadir un curso o unidad de curso hecho</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourse_es.php">
                            <!--NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nomeuc">Nombre de la unidad curricular o curso <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nomeuc" name="nomeuc" placeholder="Escriba aquí el nombre del curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--HEIS MADE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="uniuc">Institución de educación superior donde se realizó <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="uniuc" name="uniuc" placeholder="Escriba aquí el nombre de la Institución de Educación Superior donde concluyó el curso" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CONCLUSION DATE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="data">Fecha de finalización <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="date" class="form-control greyBorder" id="data" name="data" placeholder="Fecha de finalización" aria-required="true" required="required">
                                </div>
                            </div>

                            <div class="form-group text-center mt-2">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Añadir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>