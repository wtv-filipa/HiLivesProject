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

        $query = "SELECT name_user, email_user, contact_user, birth_date, description_be, website, facebook, instagram, profile_img
        FROM users 
        WHERE idusers =?";

        $query2 = "SELECT idregion, name_region_be, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Portugal'";

        $query3 = "SELECT idregion, name_region_be, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Espanha'";

        $query4 = "SELECT idregion, name_region_be, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Bélgica'";

        $query5 = "SELECT idregion, name_region_be, region_idregion
        FROM region
        LEFT JOIN users_has_region
        ON  region.idregion = users_has_region.region_idregion AND users_has_region.users_idusers= ?
        INNER JOIN country ON region.country_idcountry = country.idcountry
        WHERE name_country = 'Islândia'";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $idUser);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $birth_date, $description, $website, $facebook, $instagram, $profile_img);

            if (mysqli_stmt_fetch($stmt)) {
?>
                <div class="container">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="homeComp.php" title="Terug naar Startpagina"> Startpagina</a></li>
                            <li class="breadcrumb-item"><a href="profile.php" title="Terug naar mijn profiel">Mijn profiel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profiel bewerken</li>
                        </ol>
                    </nav>

                    <?php
                    if (isset($_SESSION["edit_comp"])) {
                        $msg_show = true;
                        switch ($_SESSION["edit_comp"]) {
                            case 1:
                                $message = "Gegevens met succes bewerkt.";
                                $class = "alert-success";
                                $_SESSION["edit_comp"] = 0;
                                break;
                            case 2:
                                $message = "U moet alle verplichte velden invullen.";
                                $class = "alert-warning";
                                $_SESSION["edit_comp"] = 0;
                                break;
                            case 3:
                                $message = "Er is een fout opgetreden bij het verwerken van uw bestelling, probeer het later opnieuw.";
                                $class = "alert-warning";
                                $_SESSION["edit_comp"] = 0;
                                break;
                            case 0:
                                $msg_show = false;
                                break;
                            default:
                                $msg_show = false;
                                $_SESSION["edit_comp"] = 0;
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
                            <h1 class="text-center">Profiel bewerken</h1>
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
                                                <img id="img_perf" class="image_profile" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="profielfoto" title="profielfoto" />
                                            <?php
                                            } else {
                                            ?>
                                                <img id="img_perf" class="image_profile" src="../../img/no_profile_img.png" alt="geen profielfoto" title="geen profielfoto" />
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            <span>Druk op de knop boven op de afbeelding om uw foto te wijzigen.</span>
                                        </div>
                                        <!----------------------MODAL DE CROP--------------->
                                        <div id="uploadimageModal" class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">De profielfoto importeren en bijsnijden</h4>
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
                                                                <button class="btn buttonDesign buttonWork buttonLoginSize crop_image" value="Upload Image" name="Submit"> Redden </button>
                                                            </div>
                                                            <div class="col-md-4 ms-3">
                                                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Sluiten</button>
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
                                    <form method="post" role="form" id="register-form" action="../../scripts/editProfileComp_be.php?edit=<?= $idUser ?>">
                                        <p style="font-size: 14px; color: #005E89 !important;">* Verplicht</p>
                                        <!--NAME-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="username">Naam <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Schrijf hier de bedrijfsnaam" aria-required="true" required="required" value="<?= $name_user ?>">
                                            </div>
                                        </div>
                                        <!--EMAIL-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="email">E-mail <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Schrijf hier de e-mail van het bedrijf" aria-required="true" required="required" onchange="email_validate(this.value);" value="<?= $email_user ?>">
                                            </div>
                                        </div>

                                        <!--DATE OF BIRTH-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="data_nasc">Datum van oprichting <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="Datum van oprichting" aria-required="true" required="required" value="<?= $birth_date ?>">
                                            </div>
                                        </div>

                                        <!--MOBILE PHONE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="phone">Roepen <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Schrijf hier uw mobiele nummer" aria-required="true" required="required" value="<?= $contact_user ?>">
                                            </div>
                                        </div>

                                        <!--COUNTRY-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="pais">Land van het bedrijf <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="pais">
                                                <option value="pt">Portugal</option>
                                                <option value="es">Spanje</option>
                                                <option value="be">België</option>
                                                <option value="ic">IJsland</option>
                                            </select>
                                        </div>

                                        <!--REGION PORTUGAL-->
                                        <div class="form-group pb-4 formulario" id="pt">
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecteer een optie</option>
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecteer een optie</option>
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecteer een optie</option>
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
                                            <label class="boldFont mt-3 pb-2" for="regiao">Selecteer de bedrijfsregio <span class="asterisk">*</span></label>
                                            <select class="form-select greyBorder" id="regiao" name="regiao">
                                                <option selected disabled>Selecteer een optie</option>
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

                                        <!--WEBSITE-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="site">Website <span class="asterisk">*</span></label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="site" name="site" placeholder="Ga hier naar de website van het bedrijf" aria-required="true" required="required" value="<?= $website ?>">
                                            </div>
                                        </div>

                                        <!--FACEBOOK-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="face">Facebook </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="face" name="face" placeholder="Voer hier de Facebook van het bedrijf in" value="<?= $facebook ?>">
                                            </div>
                                        </div>

                                        <!--INSTAGRAM-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="insta">Instagram </label>
                                            <div class="p-0 m-0">
                                                <input type="text" class="form-control greyBorder" id="insta" name="insta" placeholder="Plaats hier de Instagram van het bedrijf" value="<?= $instagram ?>">
                                            </div>
                                        </div>

                                        <!--DESCRIÇÃO-->
                                        <div class="form-group pb-4">
                                            <label class="boldFont mt-3 pb-2" for="desc">Beschrijving <span class="asterisk">*</span></label>
                                            <textarea class="form-control " id="exp_t" rows="5" name="desc" placeholder="Schrijf hier een beschrijving" aria-required="true" required="required"> <?= $description ?> </textarea>
                                        </div>

                                        <div class="form-group text-center mt-2">
                                            <div class="mx-auto col-sm-10 pb-3 pt-2">
                                                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Redden</button>
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