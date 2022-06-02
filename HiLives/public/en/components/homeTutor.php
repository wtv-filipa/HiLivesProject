<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query = "SELECT idusers, name_user, email_user
    FROM users
    WHERE user_type_iduser_type = 10 AND active_person = 0
    ORDER BY idusers DESC
    LIMIT 6";

    $query2 = "SELECT name_region_en
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE users.user_type_iduser_type = 10 AND users.active_person = 0 AND idusers = ?";
?>
    <!-- Header -->
    <div class="jumbotron bg-cover text-white startBgPerson">
        <div class="container py-5 text-center">
            <h1 class="fontWhite textBanner">Welcome to HiLives!</h1>
            <div class="arrow">
                <a class="fa-solid fa-circle-chevron-down" href="#firstSectionTutor" title="Go to the first section"></a>
            </div>
        </div>
    </div>

    <!-- Matchs -->
    <section id="firstSectionTutor" class="conatiner-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">What is the role of a tutor?</h2>
            <div class="row">
                <div class="col-12 col-md-6 ps-4 pe-4 marginBottomSmall">
                    <img src="../../img/add.svg" alt="Icon of a person" class="img-fluid" title="Icon of a person">
                    <h3 class="mt-4 pb-2">Facilitating the registration of People with IDD</h3>
                    <p>The tutor will have to conduct an interview with the People with IDD so that they can complete their registration in an easier way.</p>
                    <br>
                    <a href="registerRequestsTutor.php" title="View registration requests">
                        <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                            View registration requests
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-6 ps-4 pe-4">
                    <img src="../../img/edit.svg" alt="Pencil icon" class="img-fluid" title="Pencil icon">
                    <h3 class="mt-4 pb-2">Facilitating the updating of the profile of PwD</h3>
                    <p class="heightEqual">If there is a person with DID who needs to update specific fields in their profile, they will request an interview with the tutor and the tutor will help them with the update.</p>
                    <br>
                    <a href="editRequestsTutor.php" title="View Editing requests">
                        <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                            View editing requests
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- HiLives Stories-->
    <section class="container pt-5 pb-5">
        <h2 class="pb-4 text-center">Latest applications</h2>
        <div class="row">
            <?php

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idusers, $name_user, $email_user);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while (mysqli_stmt_fetch($stmt)) {
            ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card text-center shadowCard o-hidden border-0">
                                <div class="card-body">
                                    <img class="imgProfilePerson mb-4" src="../../img/no_profile_img.png" alt="no profile picture" title="no profile picture" />
                                    <h4 class="pb-2"><?= $name_user ?></h4>
                                    <p class="pb-0"><?= $email_user ?></p>
                                    <p>Regions of interest:
                                        <?php
                                        $first = true;
                                        if (mysqli_stmt_prepare($stmt2, $query2)) {
                                            mysqli_stmt_bind_param($stmt2, 'i', $idusers);
                                            mysqli_stmt_execute($stmt2);
                                            mysqli_stmt_bind_result($stmt2, $name_region);
                                            while (mysqli_stmt_fetch($stmt2)) {
                                                if (!$first) {
                                                    echo ",";
                                                }
                                                $first = false;
                                                echo " $name_region";
                                            }
                                        }
                                        ?>
                                    </p>
                                    <a href="IndividualReqCreateTutor.php?create=<?= $idusers ?>" title="See request of <?= $name_user ?>">
                                        <button class="btn buttonDesign buttonStudy buttonLoginSize m-0 mb-3">
                                            View request
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <section class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="card text-center shadowCard o-hidden border-0">
                                <div class="card-body  pt-5 pb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-x-circle mb-3" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                    <p class="mx-auto" style="font-size: 1rem;">
                                        At this moment there is no pending registration request. Please come back later.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php
                }
            }
            ?>
        </div>
    </section>
<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>