<?php
if (isset($_GET["info"])) {
    $idUser = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $queryGeral = "SELECT idusers, name_user, email_user, contact_user, birth_date, description_en, work_xp_en, address, website, facebook, instagram, profile_img, active, user_type_iduser_type, educ_lvl_ideduc_lvl, learning_type_idlearning_type, institution_type_idinstitution_type
    FROM users
    WHERE idusers = ?";

    $queryPerson = "SELECT name_education_en 
    FROM educ_lvl 
    INNER JOIN users ON educ_lvl.ideduc_lvl = users.educ_lvl_ideduc_lvl 
    WHERE idusers = ?";

    $queryPerson2 = "SELECT name_interested_area_en 
    FROM areas 
    INNER JOIN users_has_areas ON  areas.idareas = users_has_areas.areas_idareas 
    INNER JOIN users ON users_has_areas.users_idusers = users.idusers 
    WHERE idusers=?";

    $queryPerson3 = "SELECT name_region_en 
    FROM region 
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion 
    INNER JOIN users ON users_has_region.users_idusers = users.idusers 
    WHERE idusers=?";

    $queryPerson4 = "SELECT capacity_en 
    FROM capacities 
    INNER JOIN users_has_capacities ON capacities.idcapacities = users_has_capacities.capacities_idcapacities 
    WHERE users_idusers = ?";

    $queryPerson5 = "SELECT name_environment_en 
    FROM work_environment 
    INNER JOIN users_has_work_environment ON work_environment.idwork_environment = users_has_work_environment.work_environment_idwork_environment 
    WHERE users_idusers = ?";

    $queryHei = "SELECT name_institution_type_en 
    FROM institution_type 
    INNER JOIN users ON institution_type.idinstitution_type = users.institution_type_idinstitution_type 
    WHERE idusers = ?";

    $queryHei2 = "SELECT name_learning_en 
    FROM learning_type 
    INNER JOIN users ON learning_type.idlearning_type = users.learning_type_idlearning_type 
    WHERE idusers = ?";

    if (mysqli_stmt_prepare($stmt, $queryGeral)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idusers, $name_user, $email_user, $contact_user, $birth_date, $description_en, $work_xp_en, $address, $website, $facebook, $instagram, $profile_img, $active, $user_type_iduser_type, $educ_lvl_ideduc_lvl, $learning_type_idlearning_type, $institution_type_idinstitution_type);
        while (mysqli_stmt_fetch($stmt)) {
            $dob = $birth_date;
            $age = (date('Y') - date('Y', strtotime($dob)));
?>
            <h1 class="h3 mb-2"><?= $name_user ?> details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the details of the selected user.</p>

            <div class="card text-center mb-5">

                <form class="mt-3 form-horizontal row" role="form">

                    <div class="col-md-4">
                        <div class="text-center">
                            <?php
                            if (isset($profile_img)) {
                            ?>
                                <img class="image_profile" src="uploads/img_perfil/<?= $profile_img; ?>" alt="<?= $profile_img ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="image_profile" src="img/no_profile_img.png" alt="without profile image" />
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="col-md-8">

                        <div class="text-left">
                            <h5 for="nome">Name: <span style="font-size: 16px;"><?= $name_user ?></span></h5>
                            <hr>
                        </div>

                        <div class="text-left">
                            <h5 for="nome">Email: <span style="font-size: 16px;"><?= $email_user ?></span></h5>
                            <hr>
                        </div>

                        <?php
                        //Company
                        if ($user_type_iduser_type == 7) {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Founding date: <span style="font-size: 16px;"><?= $birth_date ?></span></h5>
                                <hr>
                            </div>

                            <div class="text-left">
                                <h5 for="nome">Phone number: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                                <hr>
                            </div>

                            <?php
                            if (isset($website)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Website: <span style="font-size: 16px;"><?= $website ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (isset($facebook)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Facebook: <span style="font-size: 16px;"><?= $facebook ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (isset($instagram)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Instagram: <span style="font-size: 16px;"><?= $instagram ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (mysqli_stmt_prepare($stmt, $queryPerson3)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $name_region);

                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <div class="text-left">
                                            <h5 for="nome">Company region: <span style="font-size: 16px;"><?= $name_region ?></span></h5>
                                            <hr>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>

                            <?php
                            if (isset($description_en)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Company details: <span style="font-size: 16px;"><?= $description_en ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Company details: <span style="font-size: 16px;" class="text_translate">Requires translation</span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                        <?php
                            //Person
                        } else if ($user_type_iduser_type == 10) {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Age: <span style="font-size: 16px;"><?= $age ?></span></h5>
                                <hr>
                            </div>

                            <div class="text-left">
                                <h5 for="nome">Phone number: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                                <hr>
                            </div>

                            <?php
                            if (isset($description_en)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Person details: <span style="font-size: 16px;"><?= $description_en ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Person details: <span style="font-size: 16px;" class="text_translate">Requires translation</span></h5>
                                    <hr>
                                </div>
                            <?php
                            }

                            if (mysqli_stmt_prepare($stmt, $queryPerson)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                if (mysqli_stmt_execute($stmt)) {

                                    mysqli_stmt_bind_result($stmt, $name_education);

                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo " <div class='text-left'>
                                           <h5 for='nome'>Education: <span style='font-size: 16px;'>$name_education</span></h5>
                                       </div>
                                       <hr>";
                                    }
                                }
                            }
                            ?>

                            <div class='text-left'>
                                <h5 for='nome'>Areas of interest: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $queryPerson2)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $name_interested_area);

                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<ul>
                                            <li  style='font-size: 16px; font-family: Quicksand, Montserrat, sans-serif !important; list-style-type:circle;'>$name_interested_area</li>
                                            </ul>";
                                        }
                                    }
                                }
                                ?>
                                <hr>
                            </div>

                            <div class='text-left'>
                                <h5 for='nome'>Regions of interest: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $queryPerson3)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                    if (mysqli_stmt_execute($stmt)) {
                                        mysqli_stmt_bind_result($stmt, $name_region);

                                        while (mysqli_stmt_fetch($stmt)) {
                                            echo "<ul>
                                            <li  style='font-size: 16px;   font-family: 'Quicksand', 'Montserrat', sans-serif !important; list-style-type:circle;'>$name_region</li>
                                            </ul>";
                                        }
                                    }
                                }
                                ?>
                                <hr>
                            </div>


                            <div class='text-left'>
                                <h5 for='nome'>Capacities: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $queryPerson4)) {

                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $capacity);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<ul>
                                            <li  style='font-size: 16px; font-family: 'Quicksand'; list-style-type:circle;'>$capacity</li>
                                            </ul>";
                                    }
                                }
                                ?>
                                <hr>
                            </div>

                            <div class='text-left'>
                                <h5 for='nome'>Favorite work environments: </h5>
                                <?php
                                if (mysqli_stmt_prepare($stmt, $queryPerson5)) {

                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $name_environment);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<ul>
                                            <li  style='font-size: 16px;   font-family: 'Quicksand', 'Montserrat', sans-serif !important; list-style-type:circle;'>$name_environment</li>
                                            </ul>";
                                    }
                                }
                                ?>
                                <hr>
                            </div>

                            <?php
                            if (isset($work_xp_en)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Work experience: <span style="font-size: 16px;"><?= $work_xp_en ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Work experience: <span style="font-size: 16px;" class="text_translate">Requires translation</span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                        <?php
                            //HEI
                        } else if ($user_type_iduser_type == 13) {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Phone number: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                                <hr>
                            </div>

                            <?php
                            if (isset($website)) {
                            ?>
                                <div class="text-left">
                                    <h5 for="nome">Website: <span style="font-size: 16px;"><?= $website ?></span></h5>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if (mysqli_stmt_prepare($stmt, $queryPerson3)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $name_region);

                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <div class="text-left">
                                            <h5 for="nome">Region: <span style="font-size: 16px;"><?= $name_region ?></span></h5>
                                            <hr>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>

                            <?php
                            if (mysqli_stmt_prepare($stmt, $queryHei)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $name_institution);

                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <div class="text-left">
                                            <h5 for="nome">Type of institution: <span style="font-size: 16px;"><?= $name_institution ?></span></h5>
                                            <hr>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>

                            <?php
                            if (mysqli_stmt_prepare($stmt, $queryHei2)) {
                                mysqli_stmt_bind_param($stmt, 'i', $idUser);

                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $name_learning);

                                    while (mysqli_stmt_fetch($stmt)) {
                            ?>
                                        <div class="text-left">
                                            <h5 for="nome">Type of education: <span style="font-size: 16px;"><?= $name_learning ?></span></h5>
                                            <hr>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>

                        <?php
                            //Tutor
                        } else if ($user_type_iduser_type == 16) {
                        ?>
                            <div class="text-left">
                                <h5 for="nome">Age: <span style="font-size: 16px;"><?= $age ?></span></h5>
                                <hr>
                            </div>

                            <div class="text-left">
                                <h5 for="nome">Phone number: <span style="font-size: 16px;"><?= $contact_user ?></span></h5>
                                <hr>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="form-group mt-5">
                            <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#deleteModal<?= $idUser ?>"> <button class="btn cancel_btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg> Delete user</button></a>
                            <span></span>
                            <?php
                            if ($active == 1) {
                            ?>
                                <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#activeModal<?= $idUser ?>">
                                    <button class="btn cancel_btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x mr-2" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                        Block user</button>
                                </a>
                            <?php
                            } else {
                            ?>
                                <a class="col-xs-12 col-md-6" href="#" data-toggle="modal" data-target="#inactiveModal<?= $idUser ?>">
                                    <button class="btn cancel_btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x mr-2" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                        Unlock user</button>
                                </a>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </form>
            </div>
<?php
            include('components/active_modal.php');

            include('components/delete_modal.php');
        }
    }
}
