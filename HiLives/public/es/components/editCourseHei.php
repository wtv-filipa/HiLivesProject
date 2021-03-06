<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["course"])) {
    $idUser = $_SESSION["idUser"];
    $idcourse = $_GET["course"];

    $query = "SELECT name_course_es, description_course_es, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course_es, credits_ects_es, languages_es, course_fee_es, certification_es, target_es, number_vac, stages_es, requirements_es, curriculum_plan_es, vocational_dimension_es, support_es, activities_es, course_regime_idcourse_regime, accommodation_idaccommodation
    FROM courses
    WHERE users_idusers = ? AND idcourses = ?";

    $query2 = "SELECT idcourse_regime, name_regime_es
    FROM course_regime";

    $query3 = "SELECT idaccommodation, name_accommodation_es
    FROM accommodation";

    $query4 = "SELECT idareas, name_interested_area_es, areas_idareas
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
                        <li class="breadcrumb-item"><a href="homeHei.php" title="Volver a la p??gina de inicio">P??gina de inicio</a></li>
                        <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Volver a mis cursos">Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar el curso <?= $name_course ?></li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["course"])) {
                    $msg_show = true;
                    switch ($_SESSION["course"]) {
                        case 1:
                            $message = "Se ha producido un error al procesar su solicitud, int??ntelo de nuevo m??s tarde.";
                            $class = "alert-warning";
                            $_SESSION["course"] = 0;
                            break;
                        case 2:
                            $message = "Todos los campos obligatorios deben ser rellenados.";
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
                        <span title=\"Cerrar\" aria-hidden=\"true\" style=\"position: absolute;
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
                                            Editar o curso <?= $name_course ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Consejos" data-bs-content="Utiliza un lenguaje sencillo y frases cortas. Siempre que encuentre un s??mbolo similar junto a los campos a rellenar, podr?? encontrar consejos sobre c??mo rellenar los campos. Si desea que el texto aparezca en forma de p??rrafos, encierre cada p??rrafo en '<p></p>'. Si desea resaltar una palabra, col??quela entre '<b></b>'">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </h1>
                                    </div>
                                    <form method="post" id="register-form" role="form" action="../../scripts/editCourseHei_es.php?course=<?= $idcourse ?>">
                                        <!--VACANCIE NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="nome">Nombre del curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Inserte el nombre del curso aqu??" aria-required="true" required="required" value="<?= $name_course ?>">
                                            </div>
                                        </div>

                                        <!--DESCRIPTION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="descricao">Breve descripci??n del curso <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Por favor, introduzca una breve descripci??n del curso" maxlength="445" aria-required="true" required="required"><?= $description_course ?></textarea>
                                            <div id="the-count">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 445</span>
                                            </div>
                                        </div>

                                        <!--WEBSITE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="website">
                                                Website <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Inserte el enlace del sitio web sin el https//">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Inserte el enlace del sitio web con la informaci??n del curso" aria-required="true" required="required" value="<?= $website_course ?>">
                                            </div>
                                        </div>

                                        <!--FACEBOOK-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="facebook">
                                                Facebook
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="S??lo tienes que introducir tu nombre de usuario. Por ejemplo: @ejemploFacebook">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Inserta aqu?? la p??gina de facebook del curso" value="<?= $facebook_course ?>">
                                            </div>
                                        </div>

                                        <!--INSTAGRAM-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="instagram">
                                                Instagram
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="S??lo tienes que introducir tu nombre de usuario. Por ejemplo: @ejemploInstagram">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Inserta aqu?? el instagram del curso" value="<?= $instagram_course ?>">
                                            </div>
                                        </div>

                                        <!--COURSE DIRECTOR-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="diretor">Director(a) del Curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Introduzca aqu?? el nombre del director del curso" aria-required="true" required="required" value="<?= $course_director ?>">
                                            </div>
                                        </div>

                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">Correo electr??nico del curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Inserte aqu?? el correo electr??nico con el que la gente puede ponerse en contacto para aclarar dudas sobre el curso" aria-required="true" required="required" value="<?= $email_course ?>">
                                            </div>
                                        </div>

                                        <!--PHONE NUMBER-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="telefone">Tel??fono del curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Inserte aqu?? el n??mero de tel??fono al que pueden dirigirse las personas para aclarar dudas sobre el curso" aria-required="true" required="required" value="<?= $phone_course ?>">
                                            </div>
                                        </div>

                                        <!--sec????o-->
                                        <h3 class="text-center" role="heading">Caracter??sticas generales del curso</h3>
                                        <!----------->

                                        <!--AREAS-->
                                        <div class="form-group pb-4">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="area">Seleccione las ??reas cient??ficas que se adaptan al Curso <span class="asteriskPink">*</span></label>
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
                                            Duraci??n del curso <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique la duraci??n del curso por a??os - semestres. Por ejemplo: 1 a??o - 2 semestres">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Indique la duraci??n estimada del curso (en semestres)" aria-required="true" required="required" value="<?= $duration_course ?>">
                                            </div>
                                        </div>

                                        <!--ECTCS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="ects">
                                                Cr??ditos ECTS <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique ??nicamente el n??mero de ECTS. Por ejemplo: 180">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Indicar el n??mero de ECTS que los estudiantes pueden adquirir" aria-required="true" required="required" value="<?= $credits_ects ?>">
                                            </div>
                                        </div>

                                        <!--COURSE REGIME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="regime">Programa <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Seleccione una opci??n</option>
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
                                            <label class="boldFont mt-3 pb-2" for="idioma">Lengua(s) de ense??anza <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Introduzca la(s) lengua(s) en que se impartir?? el curso" aria-required="true" required="required" value="<?= $languages ?>">
                                            </div>
                                        </div>

                                        <!--FEE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="propina">
                                            Importe de la matr??cula <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique si el importe es anual o semestral. Por ejemplo: 1000???/a??o o 1000???/semestre">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Indique el importe de la matr??cula del curso" aria-required="true" required="required" value="<?= $course_fee ?>">
                                            </div>
                                        </div>

                                        <!--CERTIFICATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="certificacao">Certificaci??n del curso <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Indicar el tipo de certificaci??n que obtendr??n los alumnos (si dan certificado, diploma...)" aria-required="true" required="required"><?= $certification ?></textarea>
                                        </div>

                                        <!--sec????o-->
                                        <h3 class="text-center" role="heading">Destinatarios y condiciones de admisi??n</h3>
                                        <!----------->

                                        <!--TARGET-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="destinatarios">Destinatarios <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Indique a qui??n va dirigido el curso (a todas las personas con DID, a personas con y sin DID, s??lo a un grupo m??s espec??fico od DID...)" aria-required="true" required="required"><?= $target ?></textarea>
                                        </div>

                                        <!--VACANCIES AVAILABLE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="vagas">
                                            Puestos disponibles <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Introduzca s??lo n??meros.">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Por favor, indique el n??mero de plazas disponibles anualmente para el Curso" aria-required="true" required="required" value="<?= $number_vac ?>">
                                            </div>
                                        </div>

                                        <!--STAGES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="periodo">Etapa(s) de aplicaci??n <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Por favor, indique las fechas en las que puede solicitar los cursos" aria-required="true" required="required" value="<?= $stages ?>">
                                            </div>
                                        </div>

                                        <!--REQUIREMENTS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="requisitos">Requisitos <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Indicar los requisitos que debe cumplir la persona para acceder al curso" aria-required="true" required="required"><?= $requirements ?></textarea>
                                        </div>

                                        <!--sec????o-->
                                        <h3 class="text-center" role="heading">Detalles del curso</h3>
                                        <!----------->

                                        <!--CURRICULUM PLAN-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="curricular">Tipo de plan de estudios <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Indique si se trata de un Plan Curricular con cr??ditos para alumnos con y sin DID y/o un Plan Curricular con cr??ditos s??lo para alumnos con DID (dominio acad??mico y/o profesional)." aria-required="true" required="required"><?= $curriculum_plan ?></textarea>
                                        </div>

                                        <!--VOCATIONAL DIMENSION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="vocacional">Dimensi??n profesional <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Si el curso tiene una dimensi??n profesional o si ofrece actividades en el ??mbito profesional. Si no existe, escriba: 'Esta dimensi??n no existe en el curso'." aria-required="true" required="required"><?= $vocational_dimension ?></textarea>
                                        </div>

                                        <!--ACTIVITIES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="atividades">Actividades extracurriculares  <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Si existen actividades extracurriculares promovidas por la Instituci??n de Educaci??n Superior  y/o espec??ficas para personas con DID, as?? como si estas actividades son obligatorias o no" aria-required="true" required="required"><?= $activities ?></textarea>
                                        </div>

                                        <!--SUPPORT-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="apoios">Apoyo <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Apoyo acad??mico, social, de vida independiente (por ejemplo, para desplazarse) o de otro tipo." aria-required="true" required="required"><?= $support ?></textarea>
                                        </div>

                                        <!--ACCOMMODATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="alojamento">Alojamiento <span class="asteriskPink">*</span></label>
                                            <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Seleccione una opci??n</option>
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
                                                <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize me-4">Guardar</button>

                                                <a href="profile.php?user=<?= $idUser ?>" title="Salir de la edici??n">
                                                    <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancelar</button>
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