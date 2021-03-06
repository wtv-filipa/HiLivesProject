<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php" title="Volver a la página de inicio">Página de inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contacto</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["question"])) {
        $msg_show = true;
        switch ($_SESSION["question"]) {
            case 1:
                $message = "Se ha producido un error al enviar el mensaje, inténtelo de nuevo más tarde.";
                $class = "alert-warning";
                $_SESSION["question"] = 0;
                break;
            case 2:
                $message = "Deben rellenarse todos los campos obligatorios.";
                $class = "alert-warning";
                $_SESSION["question"] = 0;
                break;
            case 3:
                $message = "¡Duda/Sugerencia enviada con éxito! Nos pondremos en contacto en breve.";
                $class = "alert-success";
                $_SESSION["question"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["question"] = 0;
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
                            <h1 class="mb-4 weightTitle">Duda/Sugerencia</h1>
                            <p class="mt-5">Si tiene alguna pregunta o sugerencia, envíenos un mensaje. Estaremos encantados de responderle.</p>
                        </div>
                        <form method="post" role="form" id="register-form" action="../../scripts/uploadContact_es.php">
                            <!--NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome_user">Nombre <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome_user" name="nome_user" placeholder="Escriba su nombre aquí" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">Correo electrónico <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escriba su correo electrónico aquí" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--TEXT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Duda/Sugerencia <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Escriba aquí cuál es su pregunta/sugerencia" aria-required="true" required="required"></textarea>
                            </div>

                            <div class="form-group text-center mt-2">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>