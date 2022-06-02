<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_SESSION["idUser"];

$query = "SELECT idareas, name_interested_area_en FROM areas";
$query2 = "SELECT idcourse_regime, name_regime_en FROM course_regime";
$query3 = "SELECT idaccommodation, name_accommodation_en FROM accommodation";

$query5 = "SELECT region_idregion, idregion, name_region_en FROM users_has_region
INNER JOIN region ON users_has_region.region_idregion = region.idregion
WHERE users_idusers = ?";
?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeHei.php" title="Back to homepage">Homepage</a></li>
            <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Back to my courses">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload a new course</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["course"])) {
        $msg_show = true;
        switch ($_SESSION["course"]) {
            case 1:
                $message = "All mandatory fields must be filled in.";
                $class = "alert-warning";
                $_SESSION["course"] = 0;
                break;
            case 2:
                $message = "An error has occurred processing your request, please try again later.";
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
                                Create new course
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Use simple language and short sentences. Whenever you find a similar symbol next to the fields to be filled in, you can find tips on how to fill in the fields. If you want the text to appear with paragraphs, enclose each paragraph within '<p></p>'. If you want to highlight a word, put it between '<b></b>'.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </h1>
                        </div>

                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourseHei_en.php?course=<?= $idUser ?>">
                            <!--COURSE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nome">Course Name <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nome" name="nome" placeholder="Type your course name here" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Short description of course <span class="asteriskPink">*</span></label>
                                <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Please enter a short description of the course" maxlength="445" aria-required="true" required="required"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 445</span>
                                </div>
                            </div>

                            <!--WEBSITE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="website">
                                    Website <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Type the website link without the https//">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="website" name="website" placeholder="Type the website link with course information" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FACEBOOK-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="facebook">
                                    Facebook
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Just enter your username. Eg: @exampleFacebook">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="facebook" name="facebook" placeholder="Type here the course facebook page">
                                </div>
                            </div>

                            <!--INSTAGRAM-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="instagram">
                                    Instagram
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Just enter your username. Eg: @exampleInstagram">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="instagram" name="instagram" placeholder="Type here the instagram of the course">
                                </div>
                            </div>

                            <!--COURSE DIRECTOR-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="diretor">Course Director <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="diretor" name="diretor" placeholder="Type the name of the Course Director here" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--EMAIL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="email">Course Email <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Type here the email people can contact to clarify doubts about the course" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--PHONE NUMBER-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="telefone">Course phone number <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="tel" class="form-control greyBorder" id="telefone" name="telefone" placeholder="Type here the telephone number that people can contact to clarify doubts about the course" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REGION-->
                            <div class="form-group pb-4 formulario">
                                <label class="boldFont mt-3 pb-2" for="regiao">Select course region <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao" aria-required="true" required="required">
                                    <option selected disabled>Select an option</option>
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
                            <h3 class="text-center" role="heading">General characteristics of the Course</h3>
                            <!----------->

                            <!--AREAS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Select the scientific areas that suit the Course <span class="asteriskPink">*</span></label>
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
                                    Duration of the course <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Please indicate the duration of the course by years - semesters. Eg: 1 year - 2 semesters">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="duracao" name="duracao" placeholder="Indicate the estimated duration of the course (in semesters)" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--ECTCS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="ects">
                                    ECTS Credits <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Please state the number of ECTS only. Eg: 180">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="ects" name="ects" placeholder="Indicate the number of ECTS that students can acquire" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--COURSE REGIME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="regime">Regime <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="regime" name="regime" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Select an option</option>
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
                                <label class="boldFont mt-3 pb-2" for="idioma">Language(s) of instruction <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="idioma" name="idioma" placeholder="Type the language(s) in which the course will be taught" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--FEE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="propina">
                                Course fee <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Indicate whether the amount is annual or half-yearly. Eg: 1000€/year or 1000€/semester">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="propina" name="propina" placeholder="Please indicate the tuition fee for the course" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CERTIFICATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="certificacao">Course Certification <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="certificacao" rows="5" name="certificacao" placeholder="Indicate the type of certification that students will obtain (if they give certificate, diploma ...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Target-students and admission conditions</h3>
                            <!----------->

                            <!--TARGET-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="destinatarios">Target-students <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="destinatarios" rows="5" name="destinatarios" placeholder="Please indicate who the course is aimed at (all people with IDD, people with and without IDD, only a more specific group od IDD...)" aria-required="true" required="required"></textarea>
                            </div>

                            <!--VACANCIES AVAILABLE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vagas">
                                Vacancies available <span class="asteriskPink">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Enter numbers only.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="vagas" name="vagas" placeholder="Please indicate the number of vacancies available per year for the Course" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--STAGES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="periodo">Application stage(s) <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="periodo" name="periodo" placeholder="Please indicate on which dates you can apply for the courses" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIREMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Requirements <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Indicate the requirements that the person must meet to enter the course" aria-required="true" required="required"></textarea>
                            </div>

                            <!--secção-->
                            <h3 class="text-center" role="heading">Course details</h3>
                            <!----------->

                            <!--CURRICULUM PLAN-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="curricular">Type of curricular plan <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="curricular" rows="5" name="curricular" placeholder="Please indicate if it is a Curriculum Plan with CUs for students with and without DID and/or a Curriculum Plan with CUs only for students with DID (academic and/or professional domain)." aria-required="true" required="required"></textarea>
                            </div>

                            <!--VOCATIONAL DIMENSION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="vocacional">Vocational dimension <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="vocacional" rows="5" name="vocacional" placeholder="If the course has a professional dimension or if it provides activities in the professional field. If it does not exist, write: 'This dimension does not exist in the course'" aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACTIVITIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="atividades">Extracurricular activities <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="atividades" rows="5" name="atividades" placeholder="Whether there are extracurricular activities promoted by HE and/or specific for people with IDD, as well as whether these activities are compulsory or not" aria-required="true" required="required"></textarea>
                            </div>

                            <!--SUPPORT-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="apoios">Support <span class="asteriskPink">*</span></label>
                                <textarea class="form-control " id="apoios" rows="5" name="apoios" placeholder="Academic, social, independent living (e.g. getting around) or other support." aria-required="true" required="required"></textarea>
                            </div>

                            <!--ACCOMMODATION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="alojamento">Accommodation <span class="asteriskPink">*</span></label>
                                <select class="form-select greyBorder" id="alojamento" name="alojamento" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Select an option</option>
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
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Add course</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>