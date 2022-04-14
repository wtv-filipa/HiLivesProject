<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

?>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-7">
            <?php
            if (isset($_SESSION["register"])) {
                $msg_show = true;
                switch ($_SESSION["register"]) {
                    case 1:
                        $message = "Ocorreu um erro no registo, por favor tenta novamente.";
                        $class = "alert-warning";
                        $_SESSION["register"] = 0;
                        break;
                    case 2:
                        $message = "É necessário preencher todos os campos obrigatórios.";
                        $class = "alert-warning";
                        $_SESSION["register"] = 0;
                        break;
                    case 0:
                        $msg_show = false;
                        break;
                    default:
                        $msg_show = false;
                        $_SESSION["register"] = 0;
                }

                if ($msg_show == true) {
                    echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span title=\"Fechar\" aria-hidden=\"true\">&times;</span>
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
                            <div class="p-5">
                                <div class="text-center">
                                    <a href="../../../index.php"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="Logótipo do HiLives" title="Bem-vindo à HiLives!"></a>
                                    <h1 class="mb-4 weightTitle">Junta-te a nós!</h1>
                                    <p class="mb-4 descricao">Plataforma de apoio à qualificação e emprego de jovens com dificuldades intelectuais e desenvolvimentais.</p>
                                </div>

                                <form method="post" role="form" id="register-form" action="../../scripts/registerPerson.php">
                                    <p style="font-size: 14px; color: #005E89 !important;">* Preenchimento
                                        obrigatório</p>
                                    <!--NAME-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="username">Nome <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Escreve aqui o teu nome" aria-required="true" required="required">
                                        </div>
                                    </div>
                                    <!--EMAIL-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="email">Email <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escreve aqui o teu email" aria-required="true" required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!--PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Palavra-passe <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Cria a tua palavra-passe para o HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>

                                    <!--CONFIRM PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password_confirm">Verificar palavra-passe <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Repete a tua palavra-passe" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                    </div>

                                    <!--DATE OF BIRTH-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="data_nasc">Data de nascimento <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="data de nascimento" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--MOBILE PHONE-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="phone">Número de telemóvel <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Escreve aqui o teu número de telemóvel" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--COUNTRY-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="pais">País onde quero estudar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="pais">
                                            <option value="pt">Portugal</option>
                                            <option value="es">Espanha</option>
                                            <option value="be">Bélgica</option>
                                            <option value="ic">Islândia</option>
                                        </select>
                                    </div>

                                    <!--REGION PORTUGAL-->
                                    <div class="form-group pb-4 formulario" id="pt">
                                        <div class="row">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                trabalhar <span class="asterisk">*</span></label>
                                            <?php
                                            $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Portugal'";
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {

                                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idRegion' id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                    }

                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!--REGION SPAIN-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="es">
                                        <div class="row">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                trabalhar <span class="asterisk">*</span></label>
                                            <?php
                                            $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Espanha'";
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {

                                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idRegion' id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                    }

                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!--REGION BELGIUM-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="be">
                                        <div class="row">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                trabalhar <span class="asterisk">*</span></label>
                                            <?php
                                            $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Bélgica'";
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {

                                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idRegion' id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                    }

                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!--REGION ICELAND-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="ic">
                                        <div class="row">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                trabalhar <span class="asterisk">*</span></label>
                                            <?php
                                            $query = "SELECT idRegion, name_region FROM region
                                                      INNER JOIN country ON region.country_idcountry = country.idcountry
                                                      WHERE name_country = 'Islândia'";
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {

                                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idRegion' id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                    }

                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>



                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Registar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Clica para recuperares a tua palavra-passe" href="construction.php">Esqueceste-te da tua palavra-passe?</a>
                                </div>
                                <div class="text-center textForm">
                                    <a class="small" title="Clica para te registares" href="login.php">Já estás inscrito? Inicia sessão!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>