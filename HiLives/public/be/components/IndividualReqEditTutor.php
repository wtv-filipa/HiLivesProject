<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["edit"])) {
    $idNavegar = $_SESSION["idUser"];
    $idUser = $_GET["edit"];

    $query = "SELECT name_user, email_user, contact_user, birth_date, status_edit
    FROM users
    WHERE idusers = ?";

    $query2 = "SELECT name_region_be
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE idusers = ?";

    $query3 = "SELECT users_has_courses.users_idusers, users_has_courses.courses_idcourses, courses.idcourses, courses.name_course_be, courses.users_idusers, users.name_user
    FROM users_has_courses
    INNER JOIN courses ON users_has_courses.courses_idcourses = courses.idcourses
    INNER JOIN users ON users.idusers = courses.users_idusers
    WHERE users_has_courses.users_idusers = ?
    ORDER BY id_match_course DESC";

    $query4 = "SELECT id_match_vac, user_young, vacancies_idvacancies, match_perc, vacancy_name_be, company_id, name_user
    FROM users_has_vacancies
    INNER JOIN vacancies ON users_has_vacancies.vacancies_idvacancies = vacancies.idvacancies
    INNER JOIN users ON users.idusers = vacancies.company_id
    WHERE user_young = ?
    ORDER BY id_match_vac DESC";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $birth_date, $status_edit);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                $newDate = date('d-m-Y', strtotime($birth_date))
?>
                <section class="container-fluid bgGreyReq">
                    <div class="container">
                        <!--BREADCRUMBS-->
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="pt-4">
                            <ol class="breadcrumb reqBreadcrumb">
                                <li class="breadcrumb-item"><a href="homeTutor.php" title="Terug naar Startpagina"> Startpagina</a></li>
                                <li class="breadcrumb-item"><a href="editRequestsTutor" title="Terug naar het bewerken van verzoeken">Verzoeken om het profiel te bewerken</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Volgorde van <?= $name_user ?></li>
                            </ol>
                        </nav>

                        <?php
                        if (isset($_SESSION["edit"])) {
                            $msg_show = true;
                            switch ($_SESSION["edit"]) {
                                case 1:
                                    $message = "Profiel succesvol bewerkt!";
                                    $class = "alert-success";
                                    $_SESSION["edit"] = 0;
                                    break;
                                case 2:
                                    $message = "Er is een fout opgetreden bij het verwerken van uw bestelling, probeer het later opnieuw.";
                                    $class = "alert-warning";
                                    $_SESSION["edit"] = 0;
                                    break;
                                case 3:
                                    $message = "Orderstatus succesvol bijgewerkt!";
                                    $class = "alert-success";
                                    $_SESSION["edit"] = 0;
                                    break;
                                case 0:
                                    $msg_show = false;
                                    break;
                                default:
                                    $msg_show = false;
                                    $_SESSION["edit"] = 0;
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

                        <h1 class="pt-4 pb-2">Verzoek om het profiel van</h1>
                        <h3 class="pb-5 textBlue"><?= $name_user ?></h3>
                        <!--PROFILE STAGES BIG-->
                        <div class="row pb-4 bigBg">
                            <div class="col-12 text-center">
                                <div class="imageLearn">
                                    <?php
                                    if ($status_edit == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit1.svg" alt="Bestelling in behandeling" title="Bestelling in behandeling" />
                                    <?php
                                    } else if ($status_edit == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit2.svg" alt="Gepland interview" title="Gepland interview" />
                                    <?php
                                    } else if ($status_edit == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit3.svg" alt="Volledige profiel" title="Volledige profiel" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!--PROFILE STAGES SMALL-->
                        <div class="row pb-4 smallBg">
                            <div class="col-12 text-center">
                                <div class="imageLearn">
                                    <?php
                                    if ($status_edit == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit_small1.svg" alt="Bestelling in behandeling" title="Bestelling in behandeling" />
                                    <?php
                                    } else if ($status_edit == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit_small2.svg" alt="Gepland interview" title="Gepland interview" />
                                    <?php
                                    } else if ($status_edit == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/be/pending_edit_small3.svg" alt="Volledige profiel" title="Volledige profiel" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Info bigger devices-->
                <section class="jumbotron bgCoverSection EditBg bigBg">
                    <div class="bg-white bg-whiteSizeAdjust ps-5 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Informatie over</h1>
                        <h3 class="pb-4 text-center textBlue"><?= $name_user ?></h3>
                        <p><b>E-mail</b>: <?= $email_user ?></p>
                        <p><b>Contact</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Interessante regio's:
                            </b>
                            <?php
                            $first = true;
                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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
                        <p><b>Geboortedatum</b>: <?= $newDate ?> </p>
                        <div class="text-center pt-2">
                            <a href="editProfileTutor.php?edit=<?= $idUser ?>" title="Profiel bewerken">
                                <button class="btn buttonDesign buttonWork buttonRegisterSize m-0">
                                    Profiel bewerken
                                </button>
                            </a>
                        </div>

                        <?php
                        if ($status_edit == 1) {
                        ?>
                            <hr>
                            <div class="text-center textForm">
                                <a class="small linkRequest edit" title="Klik om de bestelstatus bij te werken naar 'Interview gecontroleerd'" href="../../scripts/updateIndividualRequest_be.php?edit=<?= $idUser ?>" title="Orderstatus bijwerken">Heb je het gesprek al ingepland? Klik hier om de bestelstatus bij te werken.</a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </section>

                <!-- Info smaller devices-->
                <section class="smallBg whiteBg">
                    <div class="jumbotron bgCoverSection EditBg smallBg"></div>
                    <div class="bg-white ps-3 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Informação sobre</h1>
                        <h3 class="pb-4 text-center textBlue"><?= $name_user ?></h3>
                        <p><b>E-mail</b>: <?= $email_user ?></p>
                        <p><b>Contact</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Interessante regio's:
                            </b>
                            <?php
                            $first = true;
                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
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
                        <p><b>Geboortedatum</b>: <?= $newDate ?> </p>
                        <div class="text-center pt-2 pb-3">
                            <a href="editProfileTutor.php?edit=<?= $idUser ?>" title="Profiel bewerken">
                                <button class="btn buttonDesign buttonWork buttonRegisterSize m-0">
                                    Profiel bewerken
                                </button>
                            </a>
                        </div>

                        <?php
                        if ($status_edit == 1) {
                        ?>
                            <hr>
                            <div class="text-center textForm pb-4">
                                <a class="small linkRequest edit" title="Klik om de bestelstatus bij te werken naar 'Interview gecontroleerd'" href="../../scripts/updateIndividualRequest_be.php?edit=<?= $idUser ?>" title="Orderstatus bijwerken">Heb je het gesprek al ingepland? Klik hier om de bestelstatus bij te werken.</a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </section>

                <section class="container-fluid bgGreyReq">
                    <div class="container pt-5 pb-5">
                        <h1 class="pb-5">Verbindingen van <?= $name_user ?></h1>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Cursussen
                                    </button>
                                </h3>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-3">
                                            <?php
                                            if (mysqli_stmt_prepare($stmt, $query3)) {

                                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_bind_result($stmt, $users_idusers, $courses_idcourses, $idcourses, $name_course, $users_idusers, $name_user);
                                                mysqli_stmt_store_result($stmt);
                                                if (mysqli_stmt_num_rows($stmt) > 0) {
                                                    while (mysqli_stmt_fetch($stmt)) {
                                            ?>
                                                        <a href="infoCourse.php?course=<?= $courses_idcourses ?>" title="Cursusinformatie weergeven <?= $name_course ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                            <div class="list listStudy text-center">
                                                                <p>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book align-middle" viewBox="0 0 16 16">
                                                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                                                    </svg>
                                                                    <span class="ps-2 align-middle">Studeren</span>
                                                                </p>
                                                                <h4><?= $name_course ?></h4>
                                                                <p><?= $name_user ?></p>
                                                            </div>
                                                        </a>
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
                                                                        Deze persoon heeft nog steeds geen verband met de opleidingen van instellingen voor hoger onderwijs. Kom later terug.
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
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Vacatures
                                    </button>
                                </h3>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row pt-3">
                                            <?php
                                            if (mysqli_stmt_prepare($stmt, $query4)) {

                                                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_bind_result($stmt, $id_match_vac, $user_young, $vacancies_idvacancies, $match_perc, $vacancy_name, $company_id, $name_user);
                                                mysqli_stmt_store_result($stmt);
                                                if (mysqli_stmt_num_rows($stmt) > 0) {
                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($match_perc == 0) {
                                            ?>
                                                            <a href="infoVacancy.php?vac=<?= $vacancies_idvacancies ?>" title="Bekijk vacature informatie <?= $vacancy_name ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                            <?php
                                                        } else if ($match_perc == 1) {
                                                            ?>
                                                                <a href="infoVacancyLearn.php?vac=<?= $vacancies_idvacancies ?>" title="Bekijk vacature informatie <?= $vacancy_name ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                                <?php
                                                            }
                                                                ?>
                                                                <div class="list listWork text-center">
                                                                    <p>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                                        </svg>
                                                                        <span class="ps-2 align-middle">Werk</span>
                                                                    </p>
                                                                    <h4><?= $vacancy_name ?></h4>
                                                                    <p><?= $name_user ?></p>
                                                                </div>
                                                                </a>
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
                                                                                Deze persoon heeft nog steeds geen verband met de vacatures van de bedrijven. Kom later terug.
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
<?php
            }
        }
    }
} else {
    include("404.php");
}

mysqli_close($link);

?>