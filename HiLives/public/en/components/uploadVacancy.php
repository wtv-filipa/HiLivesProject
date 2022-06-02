<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idUser = $_SESSION["idUser"];

$query = "SELECT idareas, name_interested_area_en FROM areas";
$query2 = "SELECT idworkday, workday_name_en FROM workday";
$query3 = "SELECT idcapacities, capacity_comp_en FROM capacities";
$query4 = "SELECT ideduc_lvl, name_education_en FROM educ_lvl";
$query5 = "SELECT idRegion, name_region_en FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Portugal'";

$query6 = "SELECT idRegion, name_region_en FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Espanha'";

$query7 = "SELECT idRegion, name_region_en FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Bélgica'";

$query8 = "SELECT idRegion, name_region_en FROM region 
INNER JOIN country ON region.country_idcountry = country.idcountry
WHERE name_country = 'Islândia'";

?>

<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeComp.php" title="Back to homepage">Homepage</a></li>
            <li class="breadcrumb-item"><a href="allVacanciesComp.php" title="Back to my vacancies">Vacancies</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload a new vacancy</li>
        </ol>
    </nav>

    <?php
    if (isset($_SESSION["vac"])) {
        $msg_show = true;
        switch ($_SESSION["vac"]) {
            case 1:
                $message = "All mandatory fields must be filled in.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 2:
                $message = "An error has occurred processing your request, please try again later.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 3:
                $message = "The file you tried to upload is not a video.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 4:
                $message = "The video you tried to upload already exists in your files.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 5:
                $message = "The file you tried to upload is larger than supported.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 6:
                $message = "The file you tried to upload has a format that is not supported by the application.";
                $class = "alert-warning";
                $_SESSION["vac"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["vac"] = 0;
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
                                Create a new vacancy
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Use simple language and short sentences. Whenever you find a similar symbol next to the fields to be filled in, you can find tips on how to fill in the fields. If you want the text to appear with paragraphs, enclose each paragraph within '<p></p>'. If you want to highlight a word, enclose it in '<b></b>'.">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </h1>
                        </div>
                        <form method="post" role="form" id="sectionForm" action="../../scripts/uploadVacancy_en.php?vac=<?= $idUser ?>" enctype="multipart/form-data">
                            <!--VACANCIE NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nomevaga">Position in the company <span class="asterisk">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nomevaga" name="nomevaga" placeholder="Enter the name of the position available." aria-required="true" required="required">
                                </div>
                            </div>

                            <!--DESCRIPTION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="descricao">Job description <span class="asterisk">*</span></label>
                                <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Insert a text that describes the vacancy you are advertising." maxlength="445" aria-required="true" required="required"></textarea>
                                <div id="the-count">
                                    <span id="current">0</span>
                                    <span id="maximum">/ 445</span>
                                </div>
                            </div>

                            <!--NUMBER OF VACANCIES-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="numvagas">
                                    Number of places available <span class="asterisk">*</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Enter numbers only.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="numvagas" name="numvagas" placeholder="Type the number of vacancies available for the position." aria-required="true" required="required">
                                </div>
                            </div>

                            <!--REQUIRENMENTS-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="requisitos">Requirements <span class="asterisk">*</span></label>
                                <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Type all the requirements that the person must meet in order to apply for the vacancy." aria-required="true" required="required"></textarea>
                            </div>

                            <!--AREA-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="area">Area <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="area" name="area" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Select an option</option>
                                    <?php
                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idareas, $name_interested_area);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idareas\">$name_interested_area</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--WORK JOURNEY-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="jornada">Working hours <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="jornada" name="jornada" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Select an option</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query2)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $idworkday, $workday_name);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$idworkday\">$workday_name</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--CAPACITIES-->
                            <div class="form-group pb-4">
                                <label class="label-margin" for="personality">Select five (5) capacities required <span class="asterisk">*</span></label>
                                <?php
                                $stmt = mysqli_stmt_init($link);
                                if (mysqli_stmt_prepare($stmt, $query3)) {
                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $idcapacities, $capacity_comp);
                                        while (mysqli_stmt_fetch($stmt)) {
                                            if (isset($capacity_comp)) {
                                                echo "<div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' name='capacity[]' value='$idcapacities' id='$idcapacities'>
                                                        <label class='form-check-label' for='$idcapacities'>
                                                        $capacity_comp
                                                        </label>
                                                    </div>";
                                            }
                                        }
                                        mysqli_stmt_close($stmt);
                                    }
                                }
                                ?>
                            </div>
                            <!--EDUCATION LEVEL-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="educ">Level of education <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="educ" name="educ" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Select an option</option>
                                    <?php
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query4)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $ideduc_lvl, $name_education);
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "\n\t\t<option value=\"$ideduc_lvl\">$name_education</option>";
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--REGION-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="pais">Country of vacancy <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="pais" name="pais" required="required">
                                    <option value="pt">Portugal</option>
                                    <option value="es">Spain</option>
                                    <option value="be">Belgium</option>
                                    <option value="ic">Iceland</option>
                                </select>
                            </div>

                            <!--REGION PORTUGAL-->
                            <div class="form-group pb-4 formulario" id="pt">
                                <label class="boldFont mt-3 pb-2" for="regiao">Vacancy Region <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao">
                                    <option selected disabled>Select an option</option>
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

                            <!--REGION SPAIN-->
                            <div class="form-group pb-4 formulario" style="display:none;" id="es">
                                <label class="boldFont mt-3 pb-2" for="regiao">Vacancy Region <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao">
                                    <option selected disabled>Select an option</option>
                                    <?php
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query6)) {
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
                                <label class="boldFont mt-3 pb-2" for="regiao">Vacancy Region <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao">
                                    <option selected disabled>Select an option</option>
                                    <?php
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query7)) {
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
                                <label class="boldFont mt-3 pb-2" for="regiao">Vacancy Region <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="regiao" name="regiao">
                                    <option selected disabled>Select an option</option>
                                    <?php
                                    $link = new_db_connection();
                                    $stmt = mysqli_stmt_init($link);
                                    if (mysqli_stmt_prepare($stmt, $query8)) {
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

                            <!--STORY VIDEO-->

                            <label class="boldFont mt-3 pb-2" for="regiao">
                                Insert a video that describes the environment of the company
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Upload a video up to 2gb">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </label>

                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input file-upload" id="customFile" name="fileToUpload" accept=".avi, .wmv, .mp4, .mov">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>

                            <div class="form-group text-center mt-4">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" name="but_upload" class="btn buttonDesign buttonWork buttonLoginSize">Add vacancy</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>