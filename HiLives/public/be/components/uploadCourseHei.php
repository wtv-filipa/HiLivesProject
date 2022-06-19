<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_SESSION["idUser"];

$query = "SELECT idareas, name_interested_area_be FROM areas";
$query2 = "SELECT idcourse_regime, name_regime_be FROM course_regime";
$query3 = "SELECT idaccommodation, name_accommodation_be FROM accommodation";

$query5 = "SELECT region_idregion, idregion, name_region_be FROM users_has_region
INNER JOIN region ON users_has_region.region_idregion = region.idregion
WHERE users_idusers = ?";
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeHei.php" title="Terug naar Startpagina"> Startpagina</a></li>
            <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Terug naar mijn cursussen">Cursussen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Een nieuwe cursus laden</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["course"])) {
        $msg_show = true;
        switch ($_SESSION["course"]) {
            case 1:
                $message = "U moet alle verplichte velden invullen.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 2:
                $message = "Er is een fout opgetreden bij het verwerken van uw bestelling, probeer het later opnieuw.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["course"] = 0;
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
                            <h1 class="mb-4 weightTitle">
                                Nieuwe cursus maken
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Gebruik eenvoudige taal en korte zinnen. Wanneer u een soortgelijk symbool vindt naast de in te vullen velden, kunt u tips vinden over hoe u deze kunt invullen. Als u wilt dat de tekst met alinea's wordt weergegeven, plaatst u elke alinea tussen '<p></p>'. Als je een woord wilt markeren, zet het dan tussen '<b></b>'">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </h1>
                        </div>

                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourseHei_be.php?course=<?= $idUser ?>">
                            <!--COURSE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome">Naam cursus <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Vul hier de cursusnaam in" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Korte cursusbeschrijving <span class="asteriskPink">*</span></label>
                                <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Voer een korte beschrijving van de cursus in" maxlength="445" aria-required="true" required="required"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 445</span>
                                </div>
                            </div>

                            <!--WEBSITE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="website">
                                    Website <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer de websitelink in zonder https//">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Voer de websitelink met cursusinformatie in" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FACEBOOK-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="facebook">
                                    Facebook
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer alleen de gebruikersnaam in. Bijvoorbeeld: @exemploFacebook">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Vul hier de cursus facebook in">
                                </div>
                            </div>

                            <!--INSTAGRAM-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="instagram">
                                    Instagram
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer alleen de gebruikersnaam in. Bijvoorbeeld: @exemploInstagram">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Plaats hier de instagram van de cursus">
                                </div>
                            </div>

                            <!--COURSE DIRECTOR-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="diretor">Cursusdirecteur <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Vul hier de naam van de cursusleider in" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">E-mail cursus <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Vul hier het e-mailadres in waarmee mensen contact kunnen opnemen om vragen over de cursus te verduidelijken" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--PHONE NUMBER-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="telefone">Reistelefoon <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Vul hier de telefoon in waarmee mensen contact kunnen opnemen om vragen over de cursus te verduidelijken" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REGION-->
                            <div class="form-group pb-4 formulario">
                                <label class="boldFont mt-3 pb-2" for="regiao">Selecteer het cursusgebied <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao" aria-required="true" required="required">
                                    <option selected disabled>Selecteer een optie</option>
                                    <?php
                                    if (mysqli_stmt_prepare($stmt, $query5)) {
                                        mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $region_idregion, $idregion, $name_region);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idregion\">$name_region</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Algemene cursusfuncties</h3>
                            <!----------->

                            <!--AREAS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Selecteer de wetenschappelijke gebieden die bij de cursus passen <span class="asteriskPink">*</span></label>
                                <div class="row ps-3">
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idareas, $name_interested_area);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<div class='form-check col-12 col-md-6'>
                                                    <input class='form-check-input' type='checkbox' name='area[]' value='$idareas' id='$idareas'>
                                                    <label class='form-check-label' for='$idareas'>
                                                        $name_interested_area
                                                     </label>
                                                </div>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!--DURATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="duracao">
                                    Duur van de cursus <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Geef de duur van de cursus door jaren heen aan - semesters. Bijvoorbeeld: 1 jaar - 2 semesters">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Geef de verwachte duur van de cursus aan (in semesters)" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--ECTCS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="ects">
                                    ECTS-credits <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Vermeld alleen het ECTS-nummer. Bijvoorbeeld: 180">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Geef het aantal ECTS aan dat studenten kunnen kopen" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--COURSE REGIME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="regime">Regime <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecteer een optie</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query2)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idcourse_regime, $name_regime);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idcourse_regime\">$name_regime</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!--LANGUAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="idioma">Instructietaal/talen <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Voer de taal of talen in waarin de cursus wordt gegeven" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FEE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="propina">
                                    Cursusgeld <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Geef aan of het bedrag jaarlijks of halfjaarlijks is. Bijvoorbeeld: 1000€/jaar of 1000€/semester">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Geef a.u.b. het lesgeld voor de cursus aan" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CERTIFICATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="certificacao">Cursuscertificaat <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Geef het type certificering aan dat de studenten zullen behalen (indien ze een certificaat, diploma ... geven)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Ontvangers en toelatingsvoorwaarden</h3>
                            <!----------->

                            <!--TARGET-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="destinatarios">Ontvangers <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Geef aan voor wie de cursus bedoeld is (alle mensen met een verstandelijke beperking en ontwikkelingsstoornis, mensen met en zonder een verstandelijke beperking en ontwikkelingsstoornis, alleen een specifieke groep van mensen met een verstandelijke beperking en ontwikkelingsstoornis...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VACANCIES AVAILABLE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vagas">
                                    Vacatures beschikbaar <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Voer alleen getallen in.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Geef het aantal jaarlijkse vacatures aan dat beschikbaar is voor de Cursus" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--STAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="periodo">Fase(s) van de kandidatuur <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Geef aan op welke data aanvragen voor cursussen kunnen worden gedaan" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIREMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Vereisten <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Geef de vereisten aan waaraan de persoon moet voldoen om deel te nemen aan de cursus" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Cursus details</h3>
                            <!----------->

                            <!--CURRICULUM PLAN-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="curricular">Type leerplan <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Geef aan of het een curriculumplan is met currculaire eenheden voor studenten met intellectuele en ontwikkelingsstoornissen en zonder intellectuele en ontwikkelingsstoornissen en / of curriculumplan met currculaire eenheden alleen voor studenten met intellectuele en ontwikkelingsstoornissen (academisch domein en / of professioneel domein)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VOCATIONAL DIMENSION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vocacional">Professionele dimensie <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Als de cursus een professionele dimensie heeft of als het activiteiten van de professionele reikwijdte biedt. Als het niet bestaat, schrijf dan: 'Er is geen dergelijke dimensie in de cursus'" aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACTIVITIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="atividades">Buitenschoolse activiteiten <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Of er buitenschoolse activiteiten zijn die door de onderwijsinstelling worden gepromoot en /of specifiek zijn voor mensen met intellectuele en ontwikkelingsmoeilijkheden, evenals of deze activiteiten verplicht zijn of niet" aria-required="true" required="required"></textarea>
                            </div>

                            <!--SUPPORT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="apoios">Ondersteuning <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Ondersteuning bij de academische, sociale, voor een zelfstandig leven (bijvoorbeeld weten hoe je elkaar moet oriënteren) of een ander." aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACCOMMODATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="alojamento">Accommodatie <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecteer een optie</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query3)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idaccommodation, $name_accommodation);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idaccommodation\">$name_accommodation</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group text-center mt-4">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Toevoegen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>