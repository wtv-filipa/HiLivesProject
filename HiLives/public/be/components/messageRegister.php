<div class="container">


    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php

            if (isset($_SESSION["login"])) {
                $msg_show = true;
                switch ($_SESSION["login"]) {
                    case 1:
                        $message = "Geslaagde registratie!";
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
                                    <a href="../../../indexBE.php" title="Terug naar home"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="HiLives-logo" title="Welkom bij HiLives!"></a>

                                    <h1 class="mb-4 weightTitle">Wacht tot iemand contact met je opneemt!</h1>
                                    <p class="mb-4 descricao">Om toegang te krijgen tot het HiLives-platform, moet u wachten tot iemand contact met u opneemt. We spreken je over maximaal twee weken.</p>

                                    <hr class="mt-4 mb-4">
                                    <a href="../../../index.php" title="Terug naar home">
                                        <button class="btn buttonDesign buttonWork buttonMessageRegisterSize m-0">
                                            Terug naar home
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