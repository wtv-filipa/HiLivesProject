<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["create"])) {
    $idNavegar = $_SESSION["idUser"];
    $idUser = $_GET["create"];

    $query = "SELECT ideduc_lvl, name_education
    FROM educ_lvl";

    $query2 = "SELECT idareas, name_interested_area
    FROM areas";

    $query3 = "SELECT idcapacities, capacity
    FROM capacities";

    $query4 = "SELECT idwork_environment, name_environment
    FROM work_environment";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item"><a href="registerRequestsTutor.php" title="Voltar aos pedidos de registo">Pedidos de registo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Criar perfil</li>
            </ol>
        </nav>
        <div class="card o-hidden border-0 shadowCard my-5 paddingForms">
            <div class="card-body p-0">
                <h1 class="text-center">Criar Perfil</h1>
                <hr>
                <form class="ps-3" method="post" role="form" id="register-form" action="../../scripts/createProfileTutor.php?create=<?= $idUser ?>">
                    <p style="font-size: 14px; color: #AE0168 !important;">* Preenchimento
                        obrigatório</p>

                    <!--Escolaridade-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="esc">Escolaridade <span class="asteriskPink">*</span></label>
                        <select class="form-select greyBorder" id="esc" name="esc">
                            <option selected disabled>Selecione uma opção</option>
                            <?php
                            $link = new_db_connection();
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query)) {
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

                    <!--AREAS-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="area">Áreas de interesse (para estudar ou trabalhar) <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idareas, $name_interested_area);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idareas' id='flexCheckDefault' name='area[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
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

                    <!--WORK EXPERIENCE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="exp_t">Experiência de trabalho </label>
                        <textarea class="form-control " id="exp_t" rows="5" name="exp_t" placeholder="Escreva aqui sobre a experiência de trabalho que a Pessoa com DID tem"></textarea>
                    </div>

                    <!--CAPACITIES-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="capacity">As frases que melhor descrevem a Pessoa com DID (selecionar cinco ou mais frases) <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query3)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idcapacities, $capacity);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idcapacities' id='flexCheckDefault' name='capacity[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
                                                            $capacity
                                                     </label>
                                        </div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!--WORK ENVIRONMENT-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="environment">Ambientes de trabalho preferidos <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query4)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idwork_environment, $name_environment);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 col-lg-4 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idwork_environment' id='flexCheckDefault' name='environment[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_environment
                                                     </label>
                                        </div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!--WORK EXPERIENCE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="def">O que mais pode dizer a Pessoa com DID sobre si </label>
                        <textarea class="form-control " id="def" rows="5" name="def" placeholder="Por exemplo: se tiver alguma necessidade pode indicar aqui (como necessidade de elevador e/ou rampas de acesso)."></textarea>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
} else {
    include("404.php");
}
?>