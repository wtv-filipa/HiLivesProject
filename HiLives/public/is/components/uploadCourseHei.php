<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_SESSION["idUser"];

$query = "SELECT idareas, name_interested_area_is FROM areas";
$query2 = "SELECT idcourse_regime, name_regime_is FROM course_regime";
$query3 = "SELECT idaccommodation, name_accommodation_is FROM accommodation";

$query5 = "SELECT region_idregion, idregion, name_region_is FROM users_has_region
INNER JOIN region ON users_has_region.region_idregion = region.idregion
WHERE users_idusers = ?";
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeHei.php" title="Aftur heim">Heimasíða</a></li>
            <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Til baka á námskeiðin mín">Námskeið</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hlaða inn nýju námskeiði</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["course"])) {
        $msg_show = true;
        switch ($_SESSION["course"]) {
            case 1:
                $message = "Fylla verður út alla nauðsynlega reiti.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 2:
                $message = "Villa kom upp við vinnslu pöntunarinnar, vinsamlegast reyndu aftur síðar.";
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
                                Stofna nýtt námskeið
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Notaðu einfalt tungumál og stuttar setningar. Alltaf þegar þú finnur svipað tákn við hliðina á reitunum sem á að fylla út geturðu fundið ábendingar um hvernig á að fylla þau út. Ef þú vilt að textinn birtist með málsgreinum skaltu setja hverja málsgrein á milli '<p></p>'. Ef þú vilt leggja áherslu á orð, settu það á milli '<b></b>'">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </h1>
                        </div>

                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourseHei_is.php?course=<?= $idUser ?>">
                            <!--COURSE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome">Heiti námskeiðs <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Sláðu inn heiti námskeiðsins hér" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Stutt námskeiðslýsing <span class="asteriskPink">*</span></label>
                                <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Færa inn stutta lýsingu á námskeiðinu" maxlength="445" aria-required="true" required="required"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 445</span>
                                </div>
                            </div>

                            <!--WEBSITE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="website">
                                    Vefsetur <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Sláðu inn tengilinn án https //">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Sláðu inn vefsíðutengilinn með upplýsingum um námskeið" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FACEBOOK-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="facebook">
                                    Facebook
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Færið aðeins inn notandanafnið. Til dæmis: @exemploFacebook">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Sláðu inn námskeiðið Facebook hér">
                                </div>
                            </div>

                            <!--INSTAGRAM-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="instagram">
                                    Instagram
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Færið aðeins inn notandanafnið. Til dæmis: @exemploInstagram">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Settu inn instagram námskeiðsins hér">
                                </div>
                            </div>

                            <!--COURSE DIRECTOR-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="diretor">Námskeiðsstjóri <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Sláðu inn hér nafn námskeiðsstjóra" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">Tölvupóstur námskeiðs <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Sláðu hér inn tölvupóstinn sem fólk getur haft samband við til að skýra spurningar námskeiðsins" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--PHONE NUMBER-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="telefone">Ferðasími <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Sláðu inn hér símann sem fólk getur haft samband við til að skýra spurningar námskeiðsins" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REGION-->
                            <div class="form-group pb-4 formulario">
                                <label class="boldFont mt-3 pb-2" for="regiao">Velja námskeiðssvæðið <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao" aria-required="true" required="required">
                                    <option selected disabled>Velja valkost</option>
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
                            <h3 class="text-center" role="heading">Almennir eiginleikar námskeiðs</h3>
                            <!----------->

                            <!--AREAS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Velja þau vísindasvið sem henta námskeiðinu <span class="asteriskPink">*</span></label>
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
                                    Lengd námskeiðs <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Tilgreinið lengd námskeiðsins í gegnum árin - annir. Til dæmis: 1 ár - 2 annir">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Tilgreina áætlaðan tímalengd námskeiðsins (í önnum)" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--ECTCS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="ects">
                                    ECTS einingar <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Tilgreinið aðeins ECTS-númerið. Númer síðu: 180">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Tilgreina fjölda ECTS sem nemendur geta keypt" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--COURSE REGIME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="regime">Stjórnarfar <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Velja valkost</option>
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
                                <label class="boldFont mt-3 pb-2" for="idioma">Kennslumál <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Sláðu inn tungumálin sem námskeiðið verður kennt í" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FEE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="propina">
                                    Skólagjald <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Tilgreinið hvort upphæðin sé árleg eða semiannual. Til dæmis: 1000€/ári eða 1000€/önn">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Tilgreina upphæð námskeiðsþóknunar" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CERTIFICATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="certificacao">Vottun námskeiðs <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Tilgreinið tegund vottunar sem nemendur fá (ef þeir gefa vottorð, prófskírteini ...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Viðtakendur og skilyrði fyrir innlögn</h3>
                            <!----------->

                            <!--TARGET-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="destinatarios">Viðtakendur <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Tilgreinið hver er að fara á námskeiðið (allt fólk með IDD, Fólk með og án IDD, aðeins til sértækari hóps IDD...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VACANCIES AVAILABLE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vagas">
                                    Laus störf í boði <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Færið aðeins inn tölur.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Tilgreina fjölda árlegra lausra starfa sem eru í boði fyrir námskeiðið" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--STAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="periodo">Umsóknaráfangar <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Tilgreina á hvaða dagsetningum hægt er að sækja um námskeið" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIREMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Kröfur <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Tilgreina kröfurnar sem einstaklingurinn þarf að uppfylla til að færa inn námskeiðið" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Upplýsingar um námskeið</h3>
                            <!----------->

                            <!--CURRICULUM PLAN-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="curricular">Gerð námskrár <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Tilgreindu hvort það sé námskráráætlun með CUs fyrir nemendur með IDD og án IDD og / eða námskráráætlunar með CUs aðeins fyrir nemendur með IDD (fræðilegt lén og / eða faglegt lén)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VOCATIONAL DIMENSION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vocacional">Fagleg vídd <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Ef námskeiðið hefur faglega vídd eða ef það veitir starfsemi af faglegu umfangi. Ef það er ekki til, sláðu inn: 'Það er engin slík vídd í námskeiðinu'" aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACTIVITIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="atividades">Starfsemi utanskóla <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Hvort sem það eru utanskólastarfsemi kynnt af HE og / eða sérstaklega fyrir fólk með IDD, sem og hvort þessi starfsemi er skylda eða ekki" aria-required="true" required="required"></textarea>
                            </div>

                            <!--SUPPORT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="apoios">Styðja <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Stuðningur við akademískt, félagslegt, fyrir sjálfstætt líf (t.d. að vita hvernig á að stilla hvert annað) eða annað." aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACCOMMODATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="alojamento">Húsnæði <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Velja valkost</option>
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
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Bæta við</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>