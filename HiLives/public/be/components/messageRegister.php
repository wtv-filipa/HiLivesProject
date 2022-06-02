<div class="container">


    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php

            if (isset($_SESSION["login"])) {
                $msg_show = true;
                switch ($_SESSION["login"]) {
                    case 1:
                        $message = "Registo efetuado com sucesso!";
                        $class = "alert-success";
                        $_SESSION["login"] = 0;
                        break;
                    case 0:
                        $msg_show = false;
                        break;
                    default:
                        $msg_show = false;
                        $_SESSION["login"] = 0;
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
                                    <a href="../../../index.php" title="Voltar à página inicial"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="Logótipo do HiLives" title="Bem-vindo à HiLives!"></a>

                                    <h1 class="mb-4 weightTitle">Espera que alguém entre em contacto contigo!</h1>
                                    <p class="mb-4 descricao">Para teres acesso à Plataforma HiLives, precisas de esperar que alguém te contacte. Vamos falar contigo, no máximo, em duas semanas.</p>

                                    <hr class="mt-4 mb-4">
                                    <a href="../../../index.php" title="Voltar à página inicial">
                                        <button class="btn buttonDesign buttonWork buttonMessageRegisterSize m-0">
                                            Voltar à página inicial
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>