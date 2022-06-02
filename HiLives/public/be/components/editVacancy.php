<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["vac"]) && isset($_SESSION["type"])) {
    $idUser = $_SESSION["idUser"];
    $idVacancy = $_GET["vac"];
    $User_type = $_SESSION["type"];

    $query = "SELECT vacancies.vacancy_name, vacancies.description_vac, vacancies.free_vac, vacancies.requirements, vacancies.company_id, workday_idworkday, educ_lvl_ideduc_lvl, areas_idareas
    FROM vacancies
    WHERE idvacancies = ?";

    $query2 = "SELECT idworkday, workday_name
    FROM workday";

    $query3 = "SELECT ideduc_lvl, name_education
    FROM educ_lvl";

    $query4 = "SELECT idareas, name_interested_area
    FROM areas";

    $query5 = "SELECT idcapacities, capacity_comp, capacities_idcapacities
    FROM capacities
    LEFT JOIN vacancies_has_capacities
    ON  capacities.idcapacities = vacancies_has_capacities.capacities_idcapacities AND vacancies_has_capacities.vacancies_idvacancies = ?";

    $query6 = "SELECT idregion, name_region, region_idregion
    FROM region
    LEFT JOIN vacancies
    ON  region.idregion = vacancies.region_idregion AND vacancies.idvacancies= ?
    INNER JOIN country ON region.country_idcountry = country.idcountry
    WHERE name_country = 'Portugal'";

    $query7 = "SELECT idregion, name_region, region_idregion
    FROM region
    LEFT JOIN vacancies
    ON  region.idregion = vacancies.region_idregion AND vacancies.idvacancies= ?
    INNER JOIN country ON region.country_idcountry = country.idcountry
    WHERE name_country = 'Espanha'";

    $query8 = "SELECT idregion, name_region, region_idregion
    FROM region
    LEFT JOIN vacancies
    ON  region.idregion = vacancies.region_idregion AND vacancies.idvacancies= ?
    INNER JOIN country ON region.country_idcountry = country.idcountry
    WHERE name_country = 'Bélgica'";

    $query9 = "SELECT idregion, name_region, region_idregion
    FROM region
    LEFT JOIN vacancies
    ON  region.idregion = vacancies.region_idregion AND vacancies.idvacancies= ?
    INNER JOIN country ON region.country_idcountry = country.idcountry
    WHERE name_country = 'Islândia'";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idVacancy);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $vacancy_name, $description_vac, $free_vac, $requirements, $company_id, $workday_idworkday, $educ_lvl_ideduc_lvl, $areas_idareas);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <li class="breadcrumb-item"><a href="allVacanciesComp.php" title="Voltar às vagas">Vagas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar a vaga <?= $vacancy_name ?></li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["vac"])) {
                    $msg_show = true;
                    switch ($_SESSION["vac"]) {
                        case 1:
                            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["vac"] = 0;
                            break;
                        case 2:
                            $message = "É necessário preencher todos os campos obrigatórios.";
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
                                            Editar a vaga <?= $vacancy_name ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="Utilize uma linguagem simples e frases curtas. Sempre que encontrar um símbolo semelhante junto dos campos a preencher, poderá encontrar dicas de como preencher os mesmos. Caso pretenda que o texto apareça com parágrafos, coloque cada parágrafo entre '<p></p>'. Se pretender destacar alguma palavra coloque-a entre '<b></b>'">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                            </svg>
                                        </h1>
                                    </div>
                                    <form method="post" role="form" id="register-form" action="../../scripts/editVacancy.php?vac=<?= $idVacancy ?>">
                                        <!--VACANCIE NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="nomevaga">Cargo na empresa <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="nomevaga" name="nomevaga" placeholder="Insira o nome do cargo disponível." aria-required="true" required="required" value="<?= $vacancy_name ?>">
                                            </div>
                                        </div>

                                        <!--DESCRIPTION-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="descricao">Descrição da vaga <span class="asterisk">*</span></label>
                                            <textarea class="form-control textareaCountable" id="descricao" rows="5" name="descricao" placeholder="Insira um texto que descreva a vaga que está a anunciar." maxlength="445" aria-required="true" required="required"><?= $description_vac ?></textarea>
                                            <div id="the-count">
                                                <span id="current">0</span>
                                                <span id="maximum">/ 445</span>
                                            </div>
                                        </div>

                                        <!--NUMBER OF VACANCIES-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="numvagas">
                                                Número de vagas disponíveis <span class="asterisk">*</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Insira apenas números.">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg>
                                            </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="numvagas" name="numvagas" placeholder="Insira o número de vagas disponíveis para o cargo." aria-required="true" required="required" value="<?= $free_vac ?>">
                                            </div>
                                        </div>

                                        <!--REQUIRENMENTS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="requisitos">Requisitos <span class="asterisk">*</span></label>
                                            <textarea class="form-control " id="requisitos" rows="5" name="requisitos" placeholder="Insira um texto que descreva a vaga que está a anunciar." aria-required="true" required="required"><?= $requirements ?></textarea>
                                        </div>

                                        <!--AREA-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="area">Área <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="area" name="area" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                                <?php
                                                if (mysqli_stmt_prepare($stmt2, $query4)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idareas, $name_interested_area);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($areas_idareas == $idareas) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idareas\" $selected>$name_interested_area</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--WORK JOURNEY-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="jornada">Jornada de trabalho <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="jornada" name="jornada" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idworkday, $workday_name);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($workday_idworkday == $idworkday) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idworkday\" $selected>$workday_name</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!--CAPACITIES-->
                                        <div class="form-group pb-4">
                                            <label class="label-margin pb-2" for="capacity">Selecione cinco (5) capacidades necessárias <span class="asterisk">*</span></label>
                                            <div class="row">
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancy);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idcapacities, $capacity, $capacities_idcapacities);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if (isset($capacity)) {
                                                                $checked = "";
                                                                if ($capacities_idcapacities != null) {
                                                                    $checked = "checked";
                                                                }
                                                                echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                        <input class='form-check-input' type='checkbox' value='$idcapacities' $checked id='flexCheckDefault' name='capacity[]'>
                                                        <label class='form-check-label' for='flexCheckDefault'>
                                                        $capacity
                                                        </label>
                                                    </div>";
                                                            }
                                                        }

                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!--EDUCATION LEVEL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="educ">Nível de educação <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="educ" name="educ" aria-required="true" required="required">
                                                <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $ideduc_lvl, $name_education);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($educ_lvl_ideduc_lvl == $ideduc_lvl) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$ideduc_lvl\" $selected>$name_education</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--COUNTRY-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="pais">País da vaga <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="pais">
                                                <option value="pt">Portugal</option>
                                                <option value="es">Espanha</option>
                                                <option value="be">Bélgica</option>
                                                <option value="ic">Islândia</option>
                                            </select>
                                        </div>

                                        <!--REGION PORTUGAL-->
                                        <div class="form-group pb-4 formulario" id="pt">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecione a região da vaga <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecione uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query6)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancy);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($region_idregion == $idregion) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idregion\" $selected>$name_region</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--REGION SPAIN-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="es">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecione a região da vaga <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecione uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query7)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancy);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($region_idregion == $idregion) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idregion\" $selected>$name_region</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--REGION BELGIUM-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="be">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecione a região da vaga <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecione uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query8)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancy);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($region_idregion == $idregion) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idregion\" $selected>$name_region</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--REGION ICELAND-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="ic">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecione a região da vaga <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecione uma opção</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query9)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idVacancy);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($region_idregion == $idregion) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idregion\" $selected>$name_region</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group text-center mt-4">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize me-4">Guardar</button>

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