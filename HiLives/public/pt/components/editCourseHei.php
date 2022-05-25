<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["course"])) {
    $idUser = $_SESSION["idUser"];
    $idcourse = $_GET["course"];

    $query = "SELECT name_course, description_course, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course, credits_ects, languages, course_fee, certification, target, number_vac, stages, requirements, curriculum_plan, vocational_dimension, support, activities, course_regime_idcourse_regime, accommodation_idaccommodation
    FROM courses
    WHERE users_idusers = ? AND idcourses = ?";

    $query2 = "SELECT idcourse_regime, name_regime
    FROM course_regime";

    $query3 = "SELECT idaccommodation, name_accommodation
    FROM accommodation";

    $query4 = "SELECT idareas, name_interested_area, areas_idareas
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
                        <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Voltar aos meus cursos">Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar um curso</li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["course"])) {
                    $msg_show = true;
                    switch ($_SESSION["course"]) {
                        case 1:
                            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["course"] = 0;
                            break;
                        case 2:
                            $message = "É necessário preencher todos os campos obrigatórios.";
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
                                            Editar o curso
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Utilize uma linguagem simples e frases curtas. Sempre que encontrar um símbolo semelhante junto dos campos a preencher, poderá encontrar dicas de como preencher os mesmos. Caso pretenda que o texto apareça com parágrafos, coloque cada parágrafo entre '<p></p>'. Se pretender destacar alguma palavra coloque-a entre '<b></b>'">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </h1>
                                    </div>
                                    <form method="post" id="register-form" role="form" action="../../scripts/editCourseHei.php?course=<?= $idcourse ?>">
                                        <!--VACANCIE NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="nome">Nome do Curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Insira aqui o nome do curso" aria-required="true" required="required" value="<?= $name_course ?>">
                                            </div>
                                        </div>

                                        <!--DESCRIPTION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="descricao">Breve descrição do curso <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Insira uma pequena descrição relativamente ao curso" maxlength="445" aria-required="true" required="required"><?= $description_course ?></textarea>
                                            <div id="the-count">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 445</span>
                                            </div>
                                        </div>

                                        <!--WEBSITE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="website">
                                                Website <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Insira o link do website sem o https//">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Insira o link do website com informação do curso" aria-required="true" required="required" value="<?= $website_course ?>">
                                            </div>
                                        </div>

                                        <!--FACEBOOK-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="facebook">
                                                Facebook
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Insira apenas o nome de utilizador. Por exemplo: @exemploFacebook">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Insira aqui o facebook do curso" value="<?= $facebook_course ?>">
                                            </div>
                                        </div>

                                        <!--INSTAGRAM-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="instagram">
                                                Instagram
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Insira apenas o nome de utilizador. Por exemplo: @exemploInstagram">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Insira aqui o instagram do curso" value="<?= $instagram_course ?>">
                                            </div>
                                        </div>

                                        <!--COURSE DIRECTOR-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="diretor">Diretor(a) do Curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Insira aqui o nome do diretor do curso" aria-required="true" required="required" value="<?= $course_director ?>">
                                            </div>
                                        </div>

                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">Email do Curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Insira aqui o email que as pessoas podem contactar para esclarecer dúvidas do curso" aria-required="true" required="required" value="<?= $email_course ?>">
                                            </div>
                                        </div>

                                        <!--PHONE NUMBER-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="telefone">Telefone do curso <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Insira aqui o telefone que as pessoas podem contactar para esclarecer dúvidas do curso" aria-required="true" required="required" value="<?= $phone_course ?>">
                                            </div>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Características gerais do Curso</h3>
                                        <!----------->

                                        <!--AREAS-->
                                        <div class="form-group pb-4">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="area">Selecione as áreas científicas que se adequam ao Curso <span class="asteriskPink">*</span></label>
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
                                                Duração do Curso <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique a duração do curso através de anos - semestres. Por exemplo: 1 ano - 2 semestres">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Indique a duração prevista do curso (em semestres)" aria-required="true" required="required" value="<?= $duration_course ?>">
                                            </div>
                                        </div>

                                        <!--ECTCS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="ects">
                                                Créditos ECTS <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique o apenas o número de ECTS. Por exemplo: 180">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Indique o número de ECTS que os estudantes podem adquirir" aria-required="true" required="required" value="<?= $credits_ects ?>">
                                            </div>
                                        </div>

                                        <!--COURSE REGIME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="regime">Regime <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
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
                                            <label class="boldFont mt-3 pb-2" for="idioma">Idioma(s) de lecionação <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Insira o(s) idioma(s) em que o curso será lecionado" aria-required="true" required="required" value="<?= $languages ?>">
                                            </div>
                                        </div>

                                        <!--FEE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="propina">
                                                Valor da propina <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indique se o valor é anual ou semestral. Por exemplo: 1000€/ano ou 1000€/semestre">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Indique o valor da propina do curso" aria-required="true" required="required" value="<?= $course_fee ?>">
                                            </div>
                                        </div>

                                        <!--CERTIFICATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="certificacao">Certificação de curso <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Indique o tipo de certificação que os estudantes irão obter ( se dão certificado, diploma ...)" aria-required="true" required="required"><?= $certification ?></textarea>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Destinatários e condições de admissão</h3>
                                        <!----------->

                                        <!--TARGET-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="destinatarios">Destinatários <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Indique a quem se destina o curso (todas as Pessoas com DID, a Pessoas com e sem DID, apenas a um grupo mais específico de DID...)" aria-required="true" required="required"><?= $target ?></textarea>
                                        </div>

                                        <!--VACANCIES AVAILABLE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="vagas">
                                                Vagas disponíveis <span class="asteriskPink">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Insira apenas números.">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Indique o número de vagas anuais disponíveis para o Curso" aria-required="true" required="required" value="<?= $number_vac ?>">
                                            </div>
                                        </div>

                                        <!--STAGES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="periodo">Fase(s) de candidatura <span class="asteriskPink">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Indique em que datas podem ser realizadas as candidaturas aos cursos" aria-required="true" required="required" value="<?= $stages ?>">
                                            </div>
                                        </div>

                                        <!--REQUIREMENTS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="requisitos">Requisitos <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Indique os requisitos que a pessoa deve cumprir para entrar no curso" aria-required="true" required="required"><?= $requirements ?></textarea>
                                        </div>

                                        <!--secção-->
                                        <h3 class="text-center" role="heading">Detalhes do Curso</h3>
                                        <!----------->

                                        <!--CURRICULUM PLAN-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="curricular">Tipo de plano curricular <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Indique se é um Plano curricular com UCs para estudantes com DID e sem DID e/ou Plano curricular com UCs só para estudantes com DID (domínio académico e/ou domínio profissional)" aria-required="true" required="required"><?= $curriculum_plan ?></textarea>
                                        </div>

                                        <!--VOCATIONAL DIMENSION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="vocacional">Dimensão profissional <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="Se o curso tem uma dimensão profissional ou se proporciona atividades do âmbito profissional. Se não existir, escreva: “Não existe esta dimensão no curso”" aria-required="true" required="required"><?= $vocational_dimension ?></textarea>
                                        </div>

                                        <!--ACTIVITIES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="atividades">Atividades extracurriculares <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Se há atividades extracurriculares promovidas pela HE e/ou específicas para as pessoas com DID, bem como se estas atividades são obrigatórias ou não" aria-required="true" required="required"><?= $activities ?></textarea>
                                        </div>

                                        <!--SUPPORT-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="apoios">Apoios <span class="asteriskPink">*</span></label>
                                            <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Apoio ao nível académico, social, para uma vida independente (por exemplo: saber orientar-se) ou outro." aria-required="true" required="required"><?= $support ?></textarea>
                                        </div>

                                        <!--ACCOMMODATION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="alojamento">Alojamento <span class="asteriskPink">*</span></label>
                                            <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
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

                                                <a href="profile.php?user=<?= $idUser ?>" title="Sair da edição">
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