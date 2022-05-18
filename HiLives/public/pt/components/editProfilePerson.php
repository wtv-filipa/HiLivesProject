<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["edit"])) {
    $idUser = $_GET["edit"];
    $id_navegar = $_SESSION["idUser"];

    if ($idUser == $id_navegar) {

        $query = "SELECT name_user, email_user, contact_user, birth_date, profile_img
        FROM users 
        WHERE idusers =?";

        $query2 = "SELECT idregion, name_region, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Portugal'";

        $query3 = "SELECT idregion, name_region, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Espanha'";

        $query4 = "SELECT idregion, name_region, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Bélgica'";

        $query5 = "SELECT idregion, name_region, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Islândia'";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $birth_date, $profile_img);

            if (mysqli_stmt_fetch($stmt)) {
?>
                <div class="container">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                            <li class="breadcrumb-item"><a href="profile.php" title="Voltar à minha área">A minha área</a></li>
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
                                $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                                $class = "alert-warning";
                                $_SESSION["edit_jovem"] = 0;
                                break;
                            case 4:
                                $message = "O teu pedido de edição foi submetido com sucesso. Aguarda pelo contacto de um Tutor!";
                                $class = "alert-success";
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
                            <div class="row">
                                <!--PROFILE PICTURE-->
                                <div class="col-xs-12 col-md-4 text-center">
                                    <div class="pe-3">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                                <label class="label" for="fileToUpload"><i class="fas fa-edit alignEditBtn"></i></label>
                                                <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                                            </div>
                                            <?php

                                            if (isset($profile_img)) {
                                            ?>
                                                <img id="img_perf" class="image_profile" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="imagem de perfil" title="imagem de perfil" />
                                            <?php
                                            } else {
                                            ?>
                                                <img id="img_perf" class="image_profile" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="sem imagem de perfil" />
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            <span>Carrega no botão que está em cima da imagem para alterar a tua fotografia.</span>
                                        </div>
                                        <!----------------------MODAL DE CROP--------------->
                                        <div id="uploadimageModal" class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Importar e cortar a imagem de perfil</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar" aria-hidden=true></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mx-auto">
                                                            <div class="col-12 text-center">
                                                                <div id="image_demo" style="display:block; margin:auto;"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row">
                                                            <div class="col-md-4 me-3">
                                                                <button class="btn buttonDesign buttonWork buttonLoginSize crop_image" value="Upload Image" name="Submit"> Guardar </button>
                                                            </div>
                                                            <div class="col-md-4 ms-3">
                                                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Fechar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!--OTHER INFOS-->
                                <div class="col-xs-12 col-md-8">
                                    <form class="ps-3" method="post" role="form" id="register-form" action="../../scripts/editProfilePerson.php?id=<?= $idUser ?>">
                                        <p style="font-size: 14px; color: #005E89 !important;">* Preenchimento
                                            obrigatório</p>
                                        <!--NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="username">Nome <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Escreve aqui o teu nome" aria-required="true" required="required" value="<?= $name_user ?>">
                                            </div>
                                        </div>
                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">Email <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escreve aqui o teu email" aria-required="true" required="required" onchange="email_validate(this.value);" value="<?= $email_user ?>">
                                            </div>
                                        </div>

                                        <!--DATE OF BIRTH-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="data_nasc">Data de nascimento <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="data de nascimento" aria-required="true" required="required" value="<?= $birth_date ?>">
                                            </div>
                                        </div>

                                        <!--MOBILE PHONE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="phone">Número de telemóvel <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Escreve aqui o teu número de telemóvel" aria-required="true" required="required" value="<?= $contact_user ?>">
                                            </div>
                                        </div>

                                        <!--COUNTRY-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="pais">País onde quero estudar <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="pais">
                                                <option value="pt">Portugal</option>
                                                <option value="es">Espanha</option>
                                                <option value="be">Bélgica</option>
                                                <option value="ic">Islândia</option>
                                            </select>
                                        </div>

                                        <!--REGION PORTUGAL-->
                                        <div class="form-group pb-4 formulario" id="pt">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                    trabalhar <span class="asterisk">*</span></label>
                                                <?php
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($region_idregion != null) {
                                                                $checked = "checked";
                                                            }

                                                            echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idregion' $checked id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                        }

                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!--REGION SPAIN-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="es">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                    trabalhar <span class="asterisk">*</span></label>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($region_idregion != null) {
                                                                $checked = "checked";
                                                            }

                                                            echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idregion' $checked id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                        }

                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!--REGION BELGIUM-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="be">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                    trabalhar <span class="asterisk">*</span></label>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query4)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($region_idregion != null) {
                                                                $checked = "checked";
                                                            }

                                                            echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idregion' $checked id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                        }

                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!--REGION ICELAND-->
                                        <div class="form-group pb-4 formulario" style="display:none;" id="ic">
                                            <div class="row">
                                                <label class="boldFont mt-3 pb-2" for="regiao">Região onde quero estudar ou
                                                    trabalhar <span class="asterisk">*</span></label>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idregion, $name_region, $region_idregion);

                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            $checked = "";
                                                            if ($region_idregion != null) {
                                                                $checked = "checked";
                                                            }

                                                            echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                            <input class='form-check-input' type='checkbox' value='$idregion' $checked id='flexCheckDefault' name='regiao[]'>
                                                            <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_region
                                                            </label>
                                                        </div>";
                                                        }

                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center textForm">
                                        <a class="small" title="Clica para recuperares a tua palavra-passe" href="../../scripts/editPersonRequest.php?req=<?= $idUser ?>" title="Pedir entrevista com um Tutor">Precisas de alterar outros dados? Pede uma entrevista com um tutor.</a>
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
} else {
    include("404.php");
}

?>