<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["course"])) {
    $idUser = $_SESSION["idUser"];
    $idcourse = $_GET["course"];

    $query = "SELECT name_course_is, description_course_is, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course_is, credits_ects_is, languages_is, course_fee_is, certification_is, target_is, number_vac, stages_is, requirements_is, curriculum_plan_is, vocational_dimension_is, support_is, activities_is, course_regime_idcourse_regime, accommodation_idaccommodation
    FROM courses
    WHERE users_idusers = ? AND idcourses = ?";

    $query2 = "SELECT idcourse_regime, name_regime_is
    FROM course_regime";

    $query3 = "SELECT idaccommodation, name_accommodation_is
    FROM accommodation";

    $query4 = "SELECT idareas, name_interested_area_is, areas_idareas
    FROM areas
    LEFT JOIN courses_has_areas
    ON  areas.idareas= courses_has_areas.areas_idareas AND courses_has_areas.courses_idcourses= ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $idUser, $idcourse);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_course, $description_course, $website_course, $facebook_course, $instagram_course, $course_director, $email_course, $phone_course, $duration_course, $credits_ects, $languages, $course_fee, $certification, $target, $number_vac, $stages, $requirements, $curriculum_plan, $vocational_dimension, $support, $activities, $course_regime_idcourse_regime, $accommodation_idaccommodation);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="homeHei.php" title="Aftur heim">Heimasíða</a></li>
                        <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Til baka á námskeiðin mín">Námskeið</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Breyta námskeiðinu <?= $name_course ?></li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["course"])) {
                    $msg_show = true;
                    switch ($_SESSION["course"]) {
                        case 1:
                            $message = "Villa kom upp við vinnslu pöntunarinnar, vinsamlegast reyndu aftur síðar.";
                            $class = "alert-warning";
                            $_SESSION["course"] = 0;
                            break;
                        case 2:
                            $message = "Fylla verður út alla nauðsynlega reiti.";
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
                     <button type=\"button\" class=\"close\" data-bs-dismiss=\"alert\" aria-label=\"Loka\">
                        <span title=\"Loka\" aria-hidden=\"true\" style=\"position: absolute;
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
                                        Breyta námskeiðinu <?= $name_course ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Ábendingar" data-bs-content="Notaðu einfalt tungumál og stuttar setningar. Alltaf þegar þú finnur svipað tákn við hliðina á reitunum sem á að fylla út geturðu fundið ábendingar um hvernig á að fylla þau út. Ef þú vilt að textinn birtist með málsgreinum skaltu setja hverja málsgrein á milli '<p></p>'. Ef þú vilt leggja áherslu á orð, settu það á milli '<b></b>'">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </h1>
                                    </div>
                                    <form method="post" id="register-form" role="form" action="../../scripts/editCourseHei_is.php?course=<?= $idcourse ?>">
                                        <!--VACANCIE NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="nome">Heiti námskeiðs <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Sláðu inn heiti námskeiðsins hér" aria-required="true" required="required" value="<?= $name_course ?>">
                                            </div>
                                        </div>

                                        <!--DESCRIPTION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="descricao">Stutt námskeiðslýsing <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Færa inn stutta lýsingu á námskeiðinu" maxlength="445" aria-required="true" required="required"><?= $description_course ?></textarea>
                                            <div id="the-count">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 445</span>
                                            </div>
                                        </div>

                                        <!--WEBSITE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="website">
                                            Vefsíða <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Sláðu inn tengilinn án https //">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Sláðu inn vefsíðutengilinn með upplýsingum um námskeið" aria-required="true" required="required" value="<?= $website_course ?>">
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
                                                <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Sláðu inn námskeiðið Facebook hér" value="<?= $facebook_course ?>">
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
                                                <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Settu inn instagram námskeiðsins hér" value="<?= $instagram_course ?>">
                                            </div>
                                        </div>

                                        <!--COURSE DIRECTOR-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="diretor">Námskeiðsstjóri <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Sláðu inn hér nafn námskeiðsstjóra" aria-required="true" required="required" value="<?= $course_director ?>">
                                            </div>
                                        </div>

                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">Tölvupóstur námskeiðs <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Sláðu hér inn tölvupóstinn sem fólk getur haft samband við til að skýra spurningar námskeiðsins" aria-required="true" required="required" value="<?= $email_course ?>">
                                            </div>
                                        </div>

                                        <!--PHONE NUMBER-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="telefone">Ferðasími <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Sláðu inn hér símann sem fólk getur haft samband við til að skýra spurningar námskeiðsins" aria-required="true" required="required" value="<?= $phone_course ?>">
                                            </div>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Almennir eiginleikar námskeiðs</h3>
                                        <!----------->

                                        <!--AREAS-->
                                        <div class="form-group pb-4">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="area">Velja þau vísindasvið sem henta námskeiðinu <span class="asteriskPink">*</span></label>
                                                <?php
                                                if (mysqli_stmt_prepare($stmt2, $query4)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idcourse);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idareas, $name_interested_area, $areas_idareas);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($areas_idareas != null) {
                                                                $checked = "checked";
                                                            }
                                                            echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                        <input class='form-check-input' type='checkbox' value='$idareas' $checked id='flexCheckDefault' name='area[]'>
                                                        <label class='form-check-label' for='flexCheckDefault'>
                                                        $name_interested_area
                                                        </label>
                                                    </div>";
                                                        }

                                                        mysqli_stmt_close($stmt2);
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
                                                <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Tilgreina áætlaðan tímalengd námskeiðsins (í önnum)" aria-required="true" required="required" value="<?= $duration_course ?>">
                                            </div>
                                        </div>

                                        <!--ECTCS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="ects">
                                            Nafnalisti ECTS <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Tilgreinið aðeins ECTS-númerið. Númer síðu: 180">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Tilgreina fjölda ECTS sem nemendur geta keypt" aria-required="true" required="required" value="<?= $credits_ects ?>">
                                            </div>
                                        </div>

                                        <!--COURSE REGIME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="regime">Stjórnarfar <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Velja valkost</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idcourse_regime, $name_regime);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($course_regime_idcourse_regime == $idcourse_regime) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idcourse_regime\" $selected>$name_regime</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--LANGUAGES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="idioma">Kennslumál <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Sláðu inn tungumálin sem námskeiðið verður kennt í" aria-required="true" required="required" value="<?= $languages ?>">
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
                                                <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Tilgreina upphæð námskeiðsþóknunar" aria-required="true" required="required" value="<?= $course_fee ?>">
                                            </div>
                                        </div>

                                        <!--CERTIFICATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="certificacao">Vottun námskeiðs <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Tilgreinið tegund vottunar sem nemendur fá (ef þeir gefa vottorð, prófskírteini ...)" aria-required="true" required="required"><?= $certification ?></textarea>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Viðtakendur og skilyrði fyrir innlögn</h3>
                                        <!----------->

                                        <!--TARGET-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="destinatarios">Viðtakendur <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Tilgreinið fyrir hvern námskeiðið er ætlað (allir Einstaklingar með IDD, Fólk með og án IDD, aðeins í sértækari idd hóp...)" aria-required="true" required="required"><?= $target ?></textarea>
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
                                                <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Tilgreina fjölda árlegra lausra starfa sem eru í boði fyrir námskeiðið" aria-required="true" required="required" value="<?= $number_vac ?>">
                                            </div>
                                        </div>

                                        <!--STAGES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="periodo">Umsóknaráfangar <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Tilgreina á hvaða dagsetningum hægt er að sækja um námskeið" aria-required="true" required="required" value="<?= $stages ?>">
                                            </div>
                                        </div>

                                        <!--REQUIREMENTS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="requisitos">Kröfur <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Tilgreina kröfurnar sem einstaklingurinn þarf að uppfylla til að færa inn námskeiðið" aria-required="true" required="required"><?= $requirements ?></textarea>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Upplýsingar um námskeið</h3>
                                        <!----------->

                                        <!--CURRICULUM PLAN-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="curricular">Gerð námskrár <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Tilgreinið hvort um sé að ræða námskráráætlun með námsskráreiningar fyrir nemendur með IDD og án IDD og/eða námskráráætlunar með námsskráreiningar aðeins fyrir nemendur með IDD (fræðilegt lén og/ eða faglegt lén)" aria-required="true" required="required"><?= $curriculum_plan ?></textarea>
                                        </div>

                                        <!--VOCATIONAL DIMENSION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="vocacional">Fagleg vídd <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Ef námskeiðið hefur faglega vídd eða ef það veitir starfsemi af faglegu umfangi. Ef það er ekki til, skrifaðu: “Það er engin slík vídd á námskeiðinu”" aria-required="true" required="required"><?= $vocational_dimension ?></textarea>
                                        </div>

                                        <!--ACTIVITIES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="atividades">Starfsemi utanskóla <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Hvort sem það eru utanskólastarfsemi kynnt af HE og / eða sérstaklega fyrir fólk með IDD, svo og hvort þessi starfsemi sé skylda eða ekki" aria-required="true" required="required"><?= $activities ?></textarea>
                                        </div>

                                        <!--SUPPORT-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="apoios">Styðja <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Stuðningur við akademískt, félagslegt, fyrir sjálfstætt líf (t.d. að vita hvernig á að stilla hvert annað) eða annað." aria-required="true" required="required"><?= $support ?></textarea>
                                        </div>

                                        <!--ACCOMMODATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="alojamento">Húsnæði <span class="asteriskPink">*</span></label>
                                            <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Velja valkost</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idaccommodation, $name_accommodation);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($accommodation_idaccommodation == $idaccommodation) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idaccommodation\" $selected>$name_accommodation</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group text-center mt-4">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize me-4">Geyma</button>

                                                <a href="profile.php?user=<?= $idUser ?>" title="Sair da edição">
                                                    <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Afturkalla</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    include("404.php");
}

?>