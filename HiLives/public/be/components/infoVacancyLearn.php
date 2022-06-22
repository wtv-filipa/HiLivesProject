<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["vac"]) && isset($_SESSION["type"])) {
    $idUser = $_SESSION["idUser"];
    $idvacancy = $_GET["vac"];
    $User_type = $_SESSION["type"];

    $query = "SELECT vacancies.vacancy_name_be, vacancies.description_vac_be, vacancies.free_vac, vacancies.requirements_be, vacancies.date_vac, vacancies.company_id, region.name_region_be, workday.workday_name_be, educ_lvl.name_education_be, areas.name_interested_area_be, users.name_user, users.email_user, users.contact_user, users.website, users.facebook, users.instagram, users.profile_img, users.user_type_iduser_type
    FROM vacancies
    INNER JOIN users ON vacancies.company_id = users.idusers
    INNER JOIN region ON vacancies.region_idregion = region.idregion
    INNER JOIN workday ON vacancies.workday_idworkday = workday.idworkday
    INNER JOIN educ_lvl ON vacancies.educ_lvl_ideduc_lvl = educ_lvl.ideduc_lvl
    INNER JOIN areas ON vacancies.areas_idareas = areas.idareas
    WHERE idvacancies = ?";

    $query2 = "SELECT content_idcontent, content_name, date_content
    FROM vacancies 
    INNER JOIN content ON vacancies.content_idcontent = content.idcontent
    WHERE idvacancies = ?";

    $query3 = "SELECT capacity_comp_be
    FROM vacancies
    INNER JOIN vacancies_has_capacities ON vacancies.idvacancies = vacancies_has_capacities.vacancies_idvacancies
    INNER JOIN capacities ON vacancies_has_capacities.capacities_idcapacities = capacities.idcapacities
    WHERE idvacancies = ?";

    $query4 = "SELECT missing_learn, capacity_comp 
    FROM learning_path_capacities
    INNER JOIN capacities ON learning_path_capacities.missing_learn = capacities.idcapacities
    INNER JOIN users_has_vacancies ON learning_path_capacities.fk_match_vac = users_has_vacancies.id_match_vac
    WHERE users_has_vacancies.vacancies_idvacancies = ? AND users_has_vacancies.user_young = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idvacancy);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $vacancy_name, $description_vac, $free_vac, $requirements, $date_vac, $company_id, $name_region, $workday_name, $name_education, $name_interested_area, $name_user, $email_user, $contact_user, $website, $facebook, $instagram, $profile_img, $iduser_type);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <section class="container-fluid bgGreyInfo">
                <div class="container">
                    <!--BREADCRUMBS-->
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="pt-4">
                        <ol class="breadcrumb infosbreadcrumb">
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Terug naar Startpagina"> Startpagina</a></li>
                            <li class="breadcrumb-item"><a href="matchVacancy.php" title="Terug naar connecties met vacatures">Ik wil werken</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vacature informatie</li>
                        </ol>
                    </nav>

                    <h1 class="pt-4 pb-2">Aanbevolen leertraject voor</h1>
                    <h3 class="pb-5 textBlue"><?= $vacancy_name ?></h3>
                    <!--VANCANCY LEARNING PATH-->
                    <div class="row pb-4">
                        <div class="col-12 col-md-4 text-center">
                            <div class="imageLearn">
                                <img class="mb-4 img-fluid" src="../../img/vacancy/step1.svg" alt="Pictogram van een map" title="Pictogram van een map" />
                            </div>
                            <h4>1º: Vacature voor: <?= $vacancy_name ?></h4>
                            <p>Hieronder vind je alle informatie over de vacature.</p>
                        </div>

                        <div class="col-12 col-md-4 text-center">
                            <div class="imageLearn">
                                <img class="mb-4 img-fluid" src="../../img/vacancy/step2.svg" alt="Icoon van een boek" title="Icoon van een boek" />
                            </div>
                            <h4>2º: Of wat je mist</h4>
                            <p>Om te solliciteren naar deze functie moet je ook aan deze vaardigheden voldoen:</p>
                            <ul class="ulLearn" style="list-style-type: circle;">
                                <?php
                                if (mysqli_stmt_prepare($stmt2, $query4)) {

                                    mysqli_stmt_bind_param($stmt2, 'ii', $idvacancy, $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $missing_learn, $capacity_comp);

                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <li class="boldFont pb-2"><?= $capacity_comp ?></li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="col-12 col-md-4 text-center">
                            <div class="imageLearn">
                                <img class="mb-4 img-fluid" src="../../img/vacancy/step3.svg" alt="Ícone de um telefone" title="Ícone de um telefone" />
                            </div>
                            <h4>3º: Contact <?= $name_user ?></h4>
                            <p>Als u geïnteresseerd bent in de vacature, moet u contact opnemen met het bedrijf zodat u zich kunt informeren.</p>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Info bigger devices-->
            <section class="jumbotron bgCoverSectionInfo VacancyBg bigBg">
                <div class="bg-whiteInfo ps-3 pe-3">
                    <h1 class="pt-5 pb-2 text-center">Vacature informatie</h1>
                    <p><?= $name_region ?></p>
                </div>
            </section>

            <!-- Info smaller devices-->
            <section class="smallBg whiteBg">
                <div class="jumbotron bgCoverSectionInfo VacancyBg smallBg"></div>
                <div class="bg-whiteInfo ps-3 pe-3">
                    <h1 class="pt-5 pb-2 text-center">Vacature informatie</h1>
                    <p><?= $name_region ?></p>
                </div>
            </section>

            <!--Geral-->
            <section class="container-fluid bgGreyInfo pt-5">
                <div class="container">
                    <div class="row">
                        <!--Duration-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/company.svg" alt="Pictogram van een map" title="Pictogram van een map" />
                            <h3>Onderneming</h3>
                            <p><?= $name_user ?></p>
                        </div>

                        <!--Regime-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/region.svg" alt="Locatiepictogram" title="Locatiepictogram" />
                            <h3>Regio</h3>
                            <p><?= $name_region ?></p>
                        </div>

                        <!--Language-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/positions.svg" alt="Locatiepictogram" title="Locatiepictogram" />
                            <h3>Beschikbare posities</h3>
                            <p><?= $free_vac ?></p>
                        </div>

                        <!--Area-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/hours.svg" alt="Pictogram van een horloge" title="Pictogram van een horloge" />
                            <h3>Werkuren</h3>
                            <p><?= $workday_name ?></p>
                        </div>

                        <!--Subsystem-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/qualifications.svg" alt="Icoon van een hoed" title="Icoon van een hoed" />
                            <h3>Onderwijs</h3>
                            <p><?= $name_education ?></p>
                        </div>

                        <!--Ects-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/vacancy/areas.svg" alt="Icoon van een boek" title="Icoon van een boek" />
                            <h3>Gebied</h3>
                            <p><?= $name_interested_area ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!--All info-->
            <section class="container pt-5 pb-5">
                <h1 class="pb-5">Alle vacature informatie</h1>
                <ul class="nav nav-tabs nav-fill infoTabs infoVac" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="requirements-tab" data-bs-toggle="tab" data-bs-target="#requirements" type="button" role="tab" aria-controls="requirements" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle align-middle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Eisen</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat align-middle" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Contactpersonen</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="stories-tab" data-bs-toggle="tab" data-bs-target="#stories" type="button" role="tab" aria-controls="stories" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video align-middle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Verhalen</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!--REQUIREMENTS-->
                    <div class="tab-pane fade show active" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
                        <div class="pt-4">
                            <h4 class="textBlue">Vereiste mogelijkheden</h4>

                            <div class="row pt-4">
                                <?php
                                if (mysqli_stmt_prepare($stmt2, $query3)) {

                                    mysqli_stmt_bind_param($stmt2, 'i', $idvacancy);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $capacity_comp);

                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <div id="cardInfos" class="col-12 col-lg-6 pb-3">
                                            <div class="infos itemsInfosWork infosSmaller">
                                                <p class="mb-0">
                                                    <?= $capacity_comp ?>
                                                </p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                mysqli_stmt_close($stmt2);
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--CONTACTS-->
                    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div class="row pt-4">
                            <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                <div class="infos itemsInfosWork infosSmaller">
                                    <p class="mb-0">
                                        <i class="fa-solid fa-at align-middle"></i>
                                        <b class="ps-2 align-middle">E-mail :</b>
                                        <a class="linkContactsBlue align-middle" title="Klik om e-mail te verzenden naar <?= $email_user ?>" href="mailto:<?= $email_user ?>"><?= $email_user ?></a>
                                    </p>
                                </div>
                            </div>

                            <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                <div class="infos itemsInfosWork infosSmaller">
                                    <p class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone align-middle" viewBox="0 0 16 16">
                                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>
                                        <b class="ps-2 align-middle">Telefoon :</b>
                                        <a class="linkContactsBlue align-middle" title="Klik om te bellen naar <?= $contact_user ?>" href="tel: <?= $contact_user ?>"><?= $contact_user ?></a>
                                    </p>
                                </div>
                            </div>

                            <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                <div class="infos itemsInfosWork infosSmaller">
                                    <p class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe align-middle" viewBox="0 0 16 16">
                                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                                        </svg>
                                        <b class="ps-2 align-middle">Website :</b>
                                        <a class="linkContactsBlue align-middle" title="Klik om de website te bezoeken" href="https://<?= $website ?>" target="_blank"><?= $website ?></a>
                                    </p>
                                </div>
                            </div>
                            <?php
                            if ($facebook != NULL) {
                            ?>
                                <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                    <div class="infos itemsInfosWork infosSmaller">
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook align-middle" viewBox="0 0 16 16">
                                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                            <b class="ps-2 align-middle">Facebook :</b>
                                            <a class="linkContactsBlue align-middle" title="Klik om Facebook te bezoeken" href="https://www.facebook.com/<?= $facebook ?>"> <?= $facebook ?></a>
                                        </p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($instagram != NULL) {
                            ?>
                                <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                    <div class="infos itemsInfosWork infosSmaller">
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram align-middle" viewBox="0 0 16 16">
                                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                            </svg>
                                            <b class="ps-2 align-middle">Instagram :</b>
                                            <a class="linkContactsBlue align-middle" title="Klik om Instagram te bezoeken" href="https://www.instagram.com/<?= $instagram ?>"> <?= $instagram ?></a>
                                        </p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!--STORIES-->
                    <div class="tab-pane fade" id="stories" role="tabpanel" aria-labelledby="stories-tab">
                        <!--Video-->
                        <?php
                        $stmt2 = mysqli_stmt_init($link2);
                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                            mysqli_stmt_bind_param($stmt2, 'i', $idvacancy);

                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $content_idcontent, $content_name, $date_content);
                            mysqli_stmt_store_result($stmt2);

                            if (mysqli_stmt_num_rows($stmt2) > 0) {

                                if (mysqli_stmt_fetch($stmt2)) {
                                    $data = substr($date_content, 0, 10);
                                    $newDate = date("d-m-Y", strtotime($data));
                        ?>
                                    <div class="wrapperStory">
                                        <header class="cf">
                                            <a href="viewProfile.php?user=<?= $company_id ?>&userType=<?= $iduser_type ?>" title="Ir para a área de <?= $name_user ?>">
                                                <?php
                                                if (isset($profile_img)) {
                                                ?>
                                                    <img class="profile-pic" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" title="Profielfoto van <?= $name_user ?>" />
                                                <?php
                                                } else {
                                                ?>
                                                    <img class="profile-pic" src="../../img/no_profile_img.png" alt="geen profielfoto" title="geen profielfoto" />
                                                <?php
                                                }
                                                ?>
                                            </a>
                                            <h5 class="name">
                                                <a href="viewProfile.php?user=<?= $company_id ?>&userType=<?= $iduser_type ?>" title="Ga naar de <?= $name_user ?>" class="linkStory"><?= $name_user ?></a>
                                            </h5>
                                            <p class="cardInfo13"><?= $newDate ?></p>
                                        </header>
                                        <div class="text-center videoStory">
                                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5 videoSize">
                                                <video class="embed-responsive-item" src="../../../admin/uploads/vid_vac/<?= $content_name ?>" controls="controls"></video>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <section class="row justify-content-center mt-5">
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <div class="card text-center shadowCard o-hidden border-0">
                                            <div class="card-body  pt-5 pb-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-x-circle mb-3" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                                <p class="mx-auto" style="font-size: 1rem;">
                                                    Deze vacature heeft geen bijbehorende geschiedenis.
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
            </section>
<?php
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    include("404.php");
}
