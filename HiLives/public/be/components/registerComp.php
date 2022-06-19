<?php
require_once("../../connections/connection.php");

//querys
$query2 = "SELECT idRegion, name_region_be FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Portugal'";

$query3 = "SELECT idRegion, name_region_be FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Espanha'";

$query4 = "SELECT idRegion, name_region_be FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Bélgica'";

$query5 = "SELECT idRegion, name_region_be FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Islândia'";
?>
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">
            <?php
            if (isset($_SESSION["register"])) {
                $msg_show = true;
                switch ($_SESSION["register"]) {
                    case 1:
                        $message = "Er is een fout opgetreden in het register, probeer het opnieuw.";
                        $class = "alert-warning";
                        $_SESSION["register"] = 0;
                        break;
                    case 2:
                        $message = "U moet alle verplichte velden invullen.";
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
                                    <a href="../../../index.php" title="Terug naar home"><img class="pb-4 img-fluid reSize" src="../../img/logo.svg" alt="HiLives-logo" title="Welkom bij HiLives!"></a>
                                    <h1 class="mb-4 weightTitle">Doe mee!</h1>
                                </div>
                                <form method="post" role="form" id="register-form" action="../../scripts/registerComp_be.php">
                                    <p style="font-size: 14px; color: #005E89 !important;">* Verplicht</p>
                                    <!--NAME-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="username">Naam <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Schrijf hier de bedrijfsnaam" aria-required="true" required="required">
                                        </div>
                                    </div>
                                    <!--EMAIL-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="email">E-mail <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Schrijf hier de e-mail van het bedrijf" aria-required="true" required="required" onchange="email_validate(this.value);">
                                        </div>
                                    </div>
                                    <!--PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password">Wachtwoord <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Maak uw wachtwoord aan voor HiLives" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                        </div>
                                    </div>

                                    <!--CONFIRM PASSWORD-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="password_confirm">Wachtwoord controleren <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Herhaal uw wachtwoord" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                                            <span id="confirmMessage" class="confirmMessage"></span>
                                        </div>
                                    </div>

                                    <!--DATE OF BIRTH-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="data_nasc">Datum van oprichting <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="Datum van oprichting" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--MOBILE PHONE-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="phone">Telefonisch contact <span class="asterisk">*</span></label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Schrijf hier uw mobiele nummer" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--COUNTRY-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="pais">Selecteer het land van het bedrijf <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="pais">
                                            <option value="pt">Portugal</option>
                                            <option value="es">Spanje</option>
                                            <option value="be">België</option>
                                            <option value="ic">IJsland</option>
                                        </select>
                                    </div>

                                    <!--REGION PORTUGAL-->
                                    <div class="form-group pb-4 formulario" id="pt">
                                        <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Selecteer een optie</option>
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
                                        <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Selecteer een optie</option>
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
                                        <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Selecteer een optie</option>
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
                                        <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                        <select class="form-select greyBorder" id="regiao" name="regiao">
                                            <option selected disabled>Selecteer een optie</option>
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

                                    <!--WEBSITE-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="site">
                                            Website <span class="asterisk">*</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer de websitelink in zonder https//">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="site" name="site" placeholder="Ga hier naar de website van het bedrijf" aria-required="true" required="required">
                                        </div>
                                    </div>

                                    <!--FACEBOOK-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="face">
                                            Facebook
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer alleen de gebruikersnaam in. Bijvoorbeeld: @exemploFacebook">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="face" name="face" placeholder="Voer hier de Facebook van het bedrijf in">
                                        </div>
                                    </div>

                                    <!--INSTAGRAM-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="insta">
                                            Instagram
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer alleen de gebruikersnaam in. Bijvoorbeeld: @exemploInstagram">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </label>
                                        <div class="p-0 m-0">
                                            <input type="text" class="form-control greyBorder" id="insta" name="insta" placeholder="Plaats hier de Instagram van het bedrijf">
                                        </div>
                                    </div>

                                    <!--DESCRIÇÃO-->
                                    <div class="form-group pb-4">
                                        <label class="boldFont mt-3 pb-2" for="desc">Beschrijving <span class="asterisk">*</span></label>
                                        <textarea class="form-control " id="exp_t" rows="5" name="desc" placeholder="Schrijf hier een beschrijving" aria-required="true" required="required"></textarea>
                                    </div>

                                    <div class="form-group text-center mt-2">
                                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Registreren</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Klik om uw wachtwoord te herstellen" href="construction.php">Bent u uw wachtwoord vergeten?</a>
                                </div>
                                <div class="text-center textForm">
                                    <a class="small" title="Klik om in te loggen" href="login.php">Ben je al geregistreerd? Log!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>