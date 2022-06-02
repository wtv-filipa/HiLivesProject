<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php
            if (isset($_SESSION["login"])) {
                $msg_show = true;
                switch ($_SESSION["login"]) {
                    case 1:
                        $message = "An error has occurred while processing your request, please try again later.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 2:
                        $message = "All fields must be filled in.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 3:
                        $message = "Incorrect data entered, please try again.";
                        $class = "alert-warning";
                        $_SESSION["login"] = 0;
                        break;
                    case 4:
                        $message = "Successfully registered!";
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
                                    <a href="../../../indexEN.php" title="Back to homepage"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="HiLives logo" title="HiLives logo"></a>
                                    <h1 class="mb-4 weightTitle">Welcome!</h1>
                                </div>
                                <form method="post" role="form" id="register-form" action="../../scripts/login_en.php">

                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="inputEmail">Email</label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control greyBorder" id="inputEmail" name="email" placeholder="Type here the email address of your HiLives account" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Palavra-passe</label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Type your HiLives password here" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Login</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Click to recover your password" href="construction.php">Forgot your password?</a>
                                </div>
                                <div class="text-center textForm">
                                    <a class="small" title="Click to register" href="../../../indexEN.php">Not registered yet? Sign up now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>