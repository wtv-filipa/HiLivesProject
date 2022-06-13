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

        $query = "SELECT name_user, email_user, contact_user, address, website, profile_img, learning_type_idlearning_type, institution_type_idinstitution_type
        FROM users 
        WHERE idusers =?";

        $query2 = "SELECT idregion, name_region_es, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Portugal'";

        $query3 = "SELECT idregion, name_region_es, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Espanha'";

        $query4 = "SELECT idregion, name_region_es, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Bélgica'";

        $query5 = "SELECT idregion, name_region_es, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Islândia'";

        $query6 = "SELECT idlearning_type, name_learning_es
        FROM learning_type";

        $query7 = "SELECT idinstitution_type, name_institution_type_es
        FROM institution_type";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $address, $website, $profile_img, $learning_type_idlearning_type, $institution_type_idinstitution_type);

            if (mysqli_stmt_fetch($stmt)) {
?>
                <div class="container">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Volver a la página de inicio">Página de inicio</a></li>
                            <li class="breadcrumb-item"><a href="profile.php" title="Volver a mi área">Mi área</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
                        </ol>
                    </nav>

                    <?php
                    if (isset($_SESSION["edit_hei"])) {
                        $msg_show = true;
                        switch ($_SESSION["edit_hei"]) {
                            case 1:
                                $message = "Datos editados con éxito.";
                                $class = "alert-success";
                                $_SESSION["edit_hei"] = 0;
                                break;
                            case 2:
                                $message = "Deben rellenarse todos los campos obligatorios.";
                                $class = "alert-warning";
                                $_SESSION["edit_hei"] = 0;
                                break;
                            case 3:
                                $message = "Se ha producido un error al procesar su solicitud, por favor inténtelo más tarde.";
                                $class = "alert-warning";
                                $_SESSION["edit_hei"] = 0;
                                break;
                            case 0:
                                $msg_show = false;
                                break;
                            default:
                                $msg_show = false;
                                $_SESSION["edit_hei"] = 0;
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
                                                <img id="img_perf" class="image_profile" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="foto de perfil" title="foto de perfil" />
                                            <?php
                                            } else {
                                            ?>
                                                <img id="img_perf" class="image_profile" src="../../img/no_profile_img.png" alt="sin foto de perfil" title="sin foto de perfil" />
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            <span>
                                            Pulsa el botón de la parte superior de la imagen para cambiar la foto.
                                            </span>
                                        </div>
                                        <!----------------------MODAL DE CROP--------------->
                                        <div id="uploadimageModal" class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Importar y recortar la foto de perfil</h4>
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
                                                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Cerrar</button>
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
                                    <form class="ps-3" method="post" role="form" action="../../scripts/editProfileHei_es.php?edit=<?= $idUser ?>">
                                        <p style="font-size: 14px; color: #005E89 !important;">* Obligatorio</p>
                                        <!--NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="username">Nombre <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Escriba aquí el nombre de la Institución de Educación Superior" aria-required="true" required="required" value="<?= $name_user ?>">
                                            </div>
                                        </div>
                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">Correo electrónico <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Escriba aquí el correo electrónico de la Institución de Educación Superior" aria-required="true" required="required" onchange="email_validate(this.value);" value="<?= $email_user ?>">
                                            </div>
                                        </div>

                                        <!--CONTACT-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="phone">Contacto telefónico <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Escriba aquí los datos de contacto telefónico de la Institución de Educación Superior" aria-required="true" required="required" value="<?= $contact_user ?>">
                                            </div>
                                        </div>

                                        <!--WEBSITE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="site">Página web <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="site" name="site" placeholder="Inserte aquí el sitio web de la institución de educación superior" aria-required="true" required="required" value="<?= $website ?>">
                                            </div>
                                        </div>

                                        <!--TIPO DE ENSINO-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="ensino">Seleccione el tipo de educación de la Institución<span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="ensino" name="ensino">
                                                <?php
                                                if (mysqli_stmt_prepare($stmt2, $query6)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idlearning_type, $name_learning);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($learning_type_idlearning_type == $idlearning_type) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idlearning_type\" $selected>$name_learning</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--TIPO DE INSTITUIÇÃO-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="instituicao">Seleccione el tipo de institución<span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="instituicao" name="instituicao">
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query7)) {
                                                    if (mysqli_stmt_execute($stmt2)) {
                                                        mysqli_stmt_bind_result($stmt2, $idinstitution_type, $name_institution_type);
                                                        while (mysqli_stmt_fetch($stmt2)) {
                                                            if ($institution_type_idinstitution_type == $idinstitution_type) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "\n\t\t<option value=\"$idinstitution_type\" $selected>$name_institution_type</option>";
                                                        }
                                                        mysqli_stmt_close($stmt2);
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!--ADDRESS-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="endereco">Dirección de la Institución <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="endereco" name="endereco" placeholder="Inserte aquí la dirección completa de la institución de educación superior" aria-required="true" required="required" value="<?= $address ?>">
                                            </div>
                                        </div>

                                        <!--COUNTRY-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="pais">País de la institución de educación superior <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="pais">
                                                <option value="pt">Portugal</option>
                                                <option value="es">España</option>
                                                <option value="be">Bélgica</option>
                                                <option value="ic">Islandia</option>
                                            </select>
                                        </div>

                                        <!--REGION PORTUGAL-->
                                        <div class="form-group pb-4 formulario" id="pt">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Seleccione la región de la institución de educación superior <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Seleccione una opción</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Seleccione la región de la institución de educación superior <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Seleccione una opción</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Seleccione la región de la institución de educación superior <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Seleccione una opción</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query4)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Seleccione la región de la institución de educación superior <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Seleccione una opción</option>
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link2);
                                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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

                                        <div class="form-group text-center mt-2">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Guardar</button>
                                            </div>
                                        </div>
                                    </form>

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