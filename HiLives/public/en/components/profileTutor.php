<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);

if (isset($_GET["user"]) && $_SESSION["idUser"]) {
    $idUser = $_GET["user"];
    $id_navegar = $_SESSION["idUser"];

    //General infos users
    $query = "SELECT users.idusers, users.name_user, users.email_user, users.contact_user, users.profile_img
    FROM users
    WHERE idusers = ?";

    //Regions
    $query2 = "SELECT name_region_en 
    FROM region 
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion 
    WHERE users_has_region.users_idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idusers, $name_user, $email_user, $contact_user, $profile_img);
        while (mysqli_stmt_fetch($stmt)) {
?>
            <div class="container">

                <div class="row">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="homeTutor.php" title="Back to homepage">Homepage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My area</li>
                        </ol>
                    </nav>

                    <a class="marginButtonProfile col-md-6 text-sm-start text-md-end buttonEdit" href="../../scripts/logout_en.php" title="Logout from HiLives">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right align-middle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        <span class="ps-1 align-middle textEdit">Logout</span>
                    </a>
                </div>

                <?php
                if (isset($_SESSION["edit_tutor"])) {
                    $msg_show = true;
                    switch ($_SESSION["edit_tutor"]) {
                        case 1:
                            $message = "Data edited successfully.";
                            $class = "alert-success";
                            $_SESSION["edit_tutor"] = 0;
                            break;
                        case 2:
                            $message = "All mandatory fields must be filled in.";
                            $class = "alert-warning";
                            $_SESSION["edit_tutor"] = 0;
                            break;
                        case 3:
                            $message = "An error has occurred while processing your request, please try again later.";
                            $class = "alert-warning";
                            $_SESSION["edit_tutor"] = 0;
                            break;
                        case 0:
                            $msg_show = false;
                            break;
                        default:
                            $msg_show = false;
                            $_SESSION["edit_tutor"] = 0;
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

                <section class="text-center pt-5 pb-3">
                    <div class="col-12">
                        <div class="pe-3">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input style="display: none" type="file" id="fileToUpload" name="fileToUpload image" accept=".png, .jpg, .jpeg" />
                                    <label class="label labelTutor" for="fileToUpload"><i class="fas fa-edit alignEditBtn"></i></label>
                                    <input id="userIDhidden" value="<?= $idUser ?>" style="display: none;"></input>
                                </div>
                                <?php

                                if (isset($profile_img)) {
                                ?>
                                    <img id="img_perf" class="image_profile mb-4" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="profile image" title="profile image" />
                                <?php
                                } else {
                                ?>
                                    <img id="img_perf" class="image_profile mb-4" src="../../img/no_profile_img.png" alt="sem without profile image" title="without profile image" />
                                <?php
                                }
                                ?>
                            </div>
                            <!----------------------MODAL DE CROP--------------->
                            <div id="uploadimageModal" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Import and crop the profile picture</h4>
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
                                                    <button class="btn buttonDesign buttonWork buttonLoginSize crop_image" value="Upload Image" name="Submit"> Save </button>
                                                </div>
                                                <div class="col-md-4 ms-3">
                                                    <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <h1 class="pb-2"><?= $name_user ?></h1>
                    <p>Region:
                        <?php
                        if (mysqli_stmt_prepare($stmt2, $query2)) {
                            mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $name_region);
                            while (mysqli_stmt_fetch($stmt2)) {
                                echo " $name_region";
                            }
                            mysqli_stmt_close($stmt2);
                        }
                        ?>
                    </p>
                </section>

                <section class="pb-5">
                    <ul class="nav nav-tabs nav-fill profileTabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infos" type="button" role="tab" aria-controls="infos" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle align-middle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Information</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="edit" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Edit profile</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!--INFORMATIONS-->
                        <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="infos-tab">
                            <div class="row pt-4">
                                <div id="cardInfo" class="col-12 col-md-6 pb-3">
                                    <div class="items itemsStudy itemsSmaller">
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone align-middle" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                            <b class="ps-2 align-middle">Contact :</b>
                                            <a class="linkContacts align-middle" title="Click to call <?= $contact_user ?>" href="tel:<?= $contact_user ?>"><?= $contact_user ?></a>
                                        </p>
                                    </div>
                                </div>

                                <div id="cardInfo" class="col-12 col-md-6 pb-3">
                                    <div class="items itemsStudy itemsSmaller">
                                        <p class="mb-0">
                                            <i class="fa-solid fa-at align-middle"></i>
                                            <b class="ps-2 align-middle">Email :</b>
                                            <a class="linkContacts align-middle" title="Click to send e-mail to <?= $email_user ?>" href="mailto:<?= $email_user ?>"><?= $email_user ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--EDIT PROFILE-->
                        <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                            <form method="post" role="form" id="register-form" action="../../scripts/editProfileTutor_en.php?edit=<?= $idUser ?>">

                                <!--NAME-->
                                <div class="form-group pb-4">
                                    <label class="boldFont mt-3 pb-2" for="username">Name <span class="asterisk">*</span></label>
                                    <div class="p-0 m-0">
                                        <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Type your name here" aria-required="true" required="required" value="<?= $name_user ?>">
                                    </div>
                                </div>
                                <!--EMAIL-->
                                <div class="form-group pb-4">
                                    <label class="boldFont mt-3 pb-2" for="email">Email <span class="asterisk">*</span></label>
                                    <div class="p-0 m-0">
                                        <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Type your email here" aria-required="true" required="required" onchange="email_validate(this.value);" value="<?= $email_user ?>">
                                    </div>
                                </div>
                                <!--MOBILE PHONE-->
                                <div class="form-group pb-4">
                                    <label class="boldFont mt-3 pb-2" for="phone">Phone number <span class="asterisk">*</span></label>
                                    <div class="p-0 m-0">
                                        <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Type your phone number here" aria-required="true" required="required" value="<?= $contact_user ?>">
                                    </div>
                                </div>

                                <div class="form-group text-center mt-2">
                                    <div class="mx-auto col-sm-10 pb-3 pt-2">
                                        <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize me-4">Save</button>
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center textForm">
                                    <a class="small" title="Click to recover your password" href="#" title="Pedir entrevista com um Tutor">Need to change your password? Click here.</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </section>

            </div>
<?php
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    mysqli_close($link2);
} else {
    include("404.php");
}
