<?php
if (isset($_GET["edit"])) {
    $idUser = $_GET["edit"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idusers, name_user, email_user, contact_user, birth_date, profile_img
    FROM users
    WHERE idusers = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser, $name_user, $email_user, $contact_user, $birth_date, $profile_img);
?>
        <div class="w-75 mx-auto">
            <?php
            if (isset($_SESSION["erro"])) {
                $msg_show = true;
                switch ($_SESSION["erro"]) {
                    case 1:
                        $message = "An error has occurred while processing your request, please try again later.";
                        $class = "alert-warning";
                        $_SESSION["erro"] = 0;
                        break;
                    case 2:
                        $message = "You must have all mandatory fields filled in.";
                        $class = "alert-warning";
                        $_SESSION["erro"] = 0;
                        break;
                    case 3:
                        $message = "Profile successfully edited!";
                        $class = "alert-success";
                        $_SESSION["erro"] = 0;
                        break;
                    case 0:
                        $msg_show = false;
                        break;
                    default:
                        $msg_show = false;
                        $_SESSION["erro"] = 0;
                }

                if ($msg_show == true) {
                    echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
                    echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                }
            }
            ?>
            <div class="card text-center mb-5">
                <h4>Edit Profile</h4>
                <hr>
                <?php
                while (mysqli_stmt_fetch($stmt)) {
                ?>

                    <div class="row">
                        <div class="col-xs-12 col-md-4">

                            <div class="text-center">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                        <label class="label" for="fileToUpload"><i class="fas fa-edit mx-auto my-auto  text-align-center"></i></label>
                                        <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                                    </div>
                                    <?php
                                    if (isset($profile_img)) {
                                    ?>
                                        <img id="img_perf" class="image_profile" src="../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" />
                                    <?php
                                    } else {
                                    ?>
                                        <img id="img_perf" class="image_profile" src="img/no_profile_img.png" alt="sem imagem de perfil" />

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="alert alert-warning mt-3" role="alert">
                                    <span>Click on the button above the image to change your image.</span>
                                </div>
                                <!----------------------MODAL DE CROP--------------->
                                <div id="uploadimageModal" class="modal" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Import and crop the profile picture</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                    <div class="col-md-4">
                                                        <button class="buttonCustomise btn btn-primary crop_image" value="Upload Image" name="Submit"> Save</button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!------------------->
                            </div>
                        </div>


                        <!-- edit form column -->
                        <div class="col-xs-12 col-md-8">
                            <form class="form-horizontal" role="form" method="post" action="scripts/update_profile.php?id=<?= $idUser ?>">
                                <p class="text-left" style="font-size: 12px; color: #005E89 !important;">* Mandatory</p>

                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="nome">Name <span style="color: #005E89; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="text" id="nome" name="nome" placeholder="Type your name here" required="required" class="form-control" value="<?= $name_user ?>">
                                </div>

                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="email">Email <span style="color: #005E89; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="text" id="email" name="email" placeholder="Type your email here" required="required" class="form-control" value="<?= $email_user ?>">
                                </div>

                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="born">Birth date <span style="color: #005E89; font-weight: bold; font-size: 20px">*</span></label>
                                    <input type="date" id="born" name="data_nasc" placeholder="Birth date" required="required" class="form-control" value="<?= $birth_date ?>">
                                </div>

                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="tlm">Phone number</label>
                                    <input type="text" id="tlm" name="phone" placeholder="Type your phone number here" class="form-control" value="<?= $contact_user ?>">
                                </div>

                                <div class="form-group text-left">
                                    <label class="negrito mt-3" for="pais">Select your country
                                        <span style="color: #005E89; font-weight: bold; font-size: 20px">*</span></label>
                                    <select class="form-control" id="pais" required="required">
                                        <option value="pt">Portugal</option>
                                        <option value="es">Spain</option>
                                        <option value="be">Belgium</option>
                                        <option value="ic">Iceland</option>
                                    </select>
                                </div>
                                <!------------REGIÕES DE PORTUGAL------------>
                                <div class="form-group formulario" id="pt">
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="regiao_pt">Region
                                            <span style="color: #005E89; font-weight: bold; font-size: 20px">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_pt" name="regiao">
                                            <option selected disabled>Select an option</option>
                                            <?php
                                            $query2 = "SELECT idregion, name_region_en, region_idregion 
                                            FROM region 
                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                            LEFT JOIN users_has_region ON  region.idregion= users_has_region.region_idregion AND users_has_region.users_idusers= ?
                                            WHERE name_country = 'Portugal'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($Region_idRegion == $idRegion) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group formulario" style="display:none;" id="es">
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="regiao_es">Region
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_es" name="regiao">
                                            <option selected disabled>Select an option</option>
                                            <?php
                                            $query2 = "SELECT idregion, name_region_en, region_idregion 
                                            FROM region 
                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                            LEFT JOIN users_has_region ON  region.idregion= users_has_region.region_idregion AND users_has_region.users_idusers= ?
                                            WHERE name_country = 'Espanha'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                                if (mysqli_stmt_execute($stmt)) {
                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($Region_idRegion == $idRegion) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }

                                                        echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group formulario" style="display:none;" id="be">
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="regiao_be">Region
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_be" name="regiao">
                                            <option selected disabled>Select an option</option>
                                            <?php
                                            $query2 = "SELECT idregion, name_region_en, region_idregion 
                                            FROM region 
                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                            LEFT JOIN users_has_region ON  region.idregion= users_has_region.region_idregion AND users_has_region.users_idusers= ?
                                            WHERE name_country = 'Bélgica'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                                if (mysqli_stmt_execute($stmt)) {

                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($Region_idRegion == $idRegion) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!------------REGIÕES DE ISLÂNDIA------------>
                                <div class="form-group formulario" style="display:none;" id="ic">
                                    <div class="form-group text-left">
                                        <label class="negrito mt-3" for="regiao_ic">Region
                                            <span class="asterisco">*</span>
                                        </label>
                                        <select class="form-control" id="regiao_ic" name="regiao">
                                            <option selected disabled>Select an option</option>
                                            <?php
                                            $query2 = "SELECT idregion, name_region_en, region_idregion 
                                            FROM region 
                                            INNER JOIN country ON region.country_idcountry = country.idcountry
                                            LEFT JOIN users_has_region ON  region.idregion= users_has_region.region_idregion AND users_has_region.users_idusers= ?
                                            WHERE name_country = 'Islândia'";

                                            if (mysqli_stmt_prepare($stmt, $query2)) {

                                                if (mysqli_stmt_execute($stmt)) {

                                                    mysqli_stmt_bind_result($stmt, $idRegion, $name_region, $Region_idRegion);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($Region_idRegion == $idRegion) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "\n\t\t<option value=\"$idRegion\" $selected>$name_region</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!----------------------->
                                <div class="form-group">
                                    <label class="col-md-3 control-label label-margin"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn guardar_btn" value="Save">
                                        <span></span>
                                        <input type="reset" class="btn cancel_btn" value="Cancel">
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
            <?php

                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($link);
            ?>
            </div>
        </div>

    <?php

} else {
    include("404.php");
}
    ?>