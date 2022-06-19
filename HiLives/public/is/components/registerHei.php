<?php
require_once("../../connections/connection.php");

//querys
$query2 = "SELECT idRegion, name_region_is FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Portugal'";

$query3 = "SELECT idRegion, name_region_is FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Espanha'";

$query4 = "SELECT idRegion, name_region_is FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Bélgica'";

$query5 = "SELECT idRegion, name_region_is FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Islândia'";

$query6 = "SELECT idlearning_type, name_learning_is FROM learning_type";

$query7 = "SELECT idinstitution_type, name_institution_type_is FROM institution_type";
?>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php
            if (isset($_SESSION["register"])) {
                $msg_show = true;
                switch ($_SESSION["register"]) {
                    case 1:
                        $message = "Villa kom upp í stýriskránni, reyndu aftur.";
                        $class = "alert-warning";
                        $_SESSION["register"] = 0;
                        break;
                    case 2:
                        $message = "Fylla verður út alla nauðsynlega reiti.";
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
                                    <h1 class="mb-4 weightTitle">Gakktu til liðs við okkur!</h1>
                                </div>
                                <form method="post" role="form" id="register-form" action="../../scripts/registerHei_is.php">
                                    <p style="font-size: 14px; color: #005E89 !important;">* Skylda</p>
                                    <!--NAME-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="username">Nafn <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Skrifaðu hér nafn háskólastofnunarinnar" aria-required="true" required="required">
                                        </div>
                                    </div>
                                    <!--EMAIL-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="email">Tölvupóstur <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Skrifaðu hér tölvupóst háskólastofnunarinnar" aria-required="true" required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!--PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Aðgangsorð <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Búðu til lykilorðið þitt fyrir HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>

                                    <!--CONFIRM PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password_confirm">Villuleita aðgangsorð <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Endurtaktu lykilorðið þitt" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                    </div>

                                    <!--WEBSITE-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="site">Vefsetur <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="site" name="site" placeholder="Sláðu inn hér heimasíðu Háskóla Íslands" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--CONTACT-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="phone">Símatengiliður <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Skrifaðu hér símasamband háskólastofnana" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--TIPO DE ENSINO-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="ensino">Velja menntunargerð stofnunarinnar<span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="ensino" name="ensino">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query6)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idlearning_type, $name_learning);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idlearning_type\">$name_learning</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--TIPO DE INSTITUIÇÃO-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="instituicao">Velja gerð stofnunar<span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="instituicao" name="instituicao">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query7)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idinstitution_type, $name_institution_type);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idinstitution_type\">$name_institution_type</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--WEBSITE-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="endereco">Heimilisfang stofnunarinnar <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="endereco" name="endereco" placeholder="Færið inn hér fullt heimilisfang Háskóla íslands" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--COUNTRY-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="pais">Land stofnunarinnar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="pais">
                                            <option value="pt">Portúgal</option>
                                            <option value="es">Spánn</option>
                                            <option value="be">Belgía</option>
                                            <option value="ic">Ísland</option>
                                        </select>
                                    </div>

                                    <!--REGION PORTUGAL-->
                                    <div class="form-group pb-4 formulario" id="pt">
                                        <label class="boldFont mt-3 pb-2" for="regiao">Velja svæði æðri menntastofnunar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--REGION SPAIN-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="es">
                                        <label class="boldFont mt-3 pb-2" for="regiao">Velja svæði æðri menntastofnunar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query3)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--REGION BELGIUM-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="be">
                                        <label class="boldFont mt-3 pb-2" for="regiao">Velja svæði æðri menntastofnunar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query4)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--REGION ICELAND-->
                                    <div class="form-group pb-4 formulario" style="display:none;" id="ic">
                                        <label class="boldFont mt-3 pb-2" for="regiao">Velja svæði æðri menntastofnunar <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Velja valkost</option>
                                            <?php
                                            $link = new_db_connection();
                                            $stmt = mysqli_stmt_init($link);
                                            if (mysqli_stmt_prepare($stmt, $query5)) {
                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region);
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        echo "\n\t\t<option value=\"$idRegion\">$name_region</option>";
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Skrá</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Smelltu til að endurheimta lykilorðið þitt" href="construction.php">Ertu búinn að gleyma lykilorðinu þínu?</a>
                                </div>
                                <div class="text-center textForm">
                                    <a class="small" title="Smelltu til að skrá þig" href="login.php">Ertu nú þegar skráður? Trjábolur!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>