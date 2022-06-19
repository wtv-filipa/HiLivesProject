<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php
            if (isset($_SESSION["login"])) {
                $msg_show = true;
                switch ($_SESSION["login"]) {
                    case 1:
                        $message = "Villa kom upp við vinnslu pöntunarinnar, vinsamlegast reyndu aftur síðar.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 2:
                        $message = "Fylla verður út alla reiti.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 3:
                        $message = "Röng gögn sem færð voru inn, reyndu aftur.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 4:
                        $message = "Vel heppnuð skráning!";
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
                                    <a href="../../../indexIS.php" title="Aftur heim"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="HiLives merkið" title="Velkomin á HiLives!"></a>
                                    <h1 class="mb-4 weightTitle">Velkominn!</h1>
                                </div>
                                <form method="post" role="form" id="register-form" action="../../scripts/login_is.php">

                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="inputEmail">Tölvupóstur</label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control greyBorder" id="inputEmail" name="email" placeholder="Skrifaðu HiLives reikninginn þinn tölvupóst hér" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Aðgangsorð</label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Skrifaðu HiLives lykilorðið þitt hér" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Færa inn</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Smelltu til að endurheimta lykilorðið þitt" href="construction.php">Gleymdir þú lykilorðinu þínu?</a>
                                </div>
                                <div class="text-center textForm">
                                    <a class="small" title="Smelltu til að skrá þig" href="../../../indexIS.php">Ertu ekki enn skráður? Skrá!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>