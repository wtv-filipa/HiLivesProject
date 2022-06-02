<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["edit"])) {
    $idUser = $_GET["edit"];

    $query = "SELECT work_xp, description, educ_lvl_ideduc_lvl
    FROM users 
    WHERE idusers =?";

    $query2 = "SELECT ideduc_lvl, name_education 
    FROM educ_lvl";

    $query3 = "SELECT idareas, name_interested_area, areas_idareas
    FROM areas
    LEFT JOIN users_has_areas
    ON  areas.idareas = users_has_areas.areas_idareas AND users_has_areas.users_idusers = ?";

    $query4 = "SELECT idcapacities, capacity, capacities_idcapacities
    FROM capacities
    LEFT JOIN users_has_capacities
    ON  capacities.idcapacities = users_has_capacities.capacities_idcapacities AND users_has_capacities.users_idusers = ?";

    $query5 = "SELECT idwork_environment, name_environment, work_environment_idwork_environment
    FROM work_environment
    LEFT JOIN users_has_work_environment
    ON  work_environment.idwork_environment = users_has_work_environment.work_environment_idwork_environment AND users_has_work_environment.users_idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $work_xp, $description, $educ_lvl_ideduc_lvl);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                        <li class="breadcrumb-item"><a href="editRequestsTutor.php" title="Voltar aos pedidos para editar perfil">Pedidos para editar perfil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
                    </ol>
                </nav>

                <?php
                if (isset($_SESSION["edit_jovem"])) {
                    $msg_show = true;
                    switch ($_SESSION["edit_jovem"]) {
                        case 1:
                            $message = "Dados editados com sucesso.";
                            $class = "alert-success";
                            $_SESSION["edit_jovem"] = 0;
                            break;
                        case 2:
                            $message = "É necessário preencher todos os campos obrigatórios.";
                            $class = "alert-warning";
                            $_SESSION["edit_jovem"] = 0;
                            break;
                        case 3:
                            $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["edit_jovem"] = 0;
                            break;
                        case 0:
                            $msg_show = false;
                            break;
                        default:
                            $msg_show = false;
                            $_SESSION["edit_jovem"] = 0;
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

                <div class="card o-hidden border-0 shadowCard my-5 paddingForms">
                    <div class="card-body p-0">
                        <h1 class="text-center">Editar Perfil</h1>
                        <hr>
                        <form class="ps-3" method="post" role="form" id="tutor-form" action="../../scripts/EditProfileOfPerson.php?person=<?= $idUser ?>">
                            <p style="font-size: 14px; color: #005E89 !important;">* Preenchimento
                                obrigatório</p>

                            <!--Escolaridade-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="esc">Escolaridade <span class="asterisk">*</span></label>
                                <select class="form-select greyBorder" id="esc" name="esc" aria-required="true" required="required">
                                    <option value="" selected disabled aria-disabled="true">Selecionar uma opção</option>
                                    <?php
                                    if (mysqli_stmt_prepare($stmt2, $query2)) {
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

                            <!--AREAS-->
                            <div class="form-group pb-4">
                                <div class="row">
                                    <label class="boldFont mt-3 pb-2" for="area">Áreas de interesse (para estudar ou trabalhar) <span class="asterisk">*</span></label>
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query3)) {
                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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

                            <!--WORK EXPERIENCE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="exp_t">Experiência de trabalho </label>
                                <textarea class="form-control " id="exp_t" rows="5" name="exp_t" placeholder="Escreva aqui sobre a experiência de trabalho que a Pessoa com DID tem"><?= $work_xp ?></textarea>
                            </div>

                            <!--CAPACITIES-->
                            <div class="form-group pb-4">
                                <div class="row">
                                    <label class="boldFont mt-3 pb-2" for="capacity">As frases que melhor descrevem a Pessoa com DID (selecionar cinco ou mais frases) <span class="asterisk">*</span></label>
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query4)) {
                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        if (mysqli_stmt_execute($stmt2)) {
                                            mysqli_stmt_bind_result($stmt2, $idcapacities, $capacity, $capacities_idcapacities);

                                            while (mysqli_stmt_fetch($stmt2)) {
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

                                            mysqli_stmt_close($stmt2);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!--WORK ENVIRONMENT-->
                            <div class="form-group pb-4">
                                <div class="row">
                                    <label class="boldFont mt-3 pb-2" for="environment">Ambientes de trabalho preferidos <span class="asterisk">*</span></label>
                                    <?php
                                    $stmt2 = mysqli_stmt_init($link2);
                                    if (mysqli_stmt_prepare($stmt2, $query5)) {
                                        mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                        if (mysqli_stmt_execute($stmt2)) {
                                            mysqli_stmt_bind_result($stmt2, $idwork_environment, $name_environment, $work_environment_idwork_environment);

                                            while (mysqli_stmt_fetch($stmt2)) {
                                                $checked = "";
                                                if ($work_environment_idwork_environment != null) {
                                                    $checked = "checked";
                                                }
                                                echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                        <input class='form-check-input' type='checkbox' value='$idwork_environment' $checked id='flexCheckDefault' name='environment[]'>
                                                        <label class='form-check-label' for='flexCheckDefault'>
                                                        $name_environment
                                                        </label>
                                                    </div>";
                                            }

                                            mysqli_stmt_close($stmt2);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!--WORK EXPERIENCE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="def">O que mais pode dizer a Pessoa com DID sobre si </label>
                                <textarea class="form-control " id="def" rows="5" name="def" placeholder="Por exemplo: se tiver alguma necessidade pode indicar aqui (como necessidade de elevador e/ou rampas de acesso)."><?= $description ?></textarea>
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
<?php
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    include("404.php");
}

?>