<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["course"]) && isset($_SESSION["type"])) {
    $idUser = $_SESSION["idUser"];
    $idcourse = $_GET["course"];
    $User_type = $_SESSION["type"];

    $query = "SELECT name_course, description_course, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course, credits_ects, languages, course_fee, certification, target, number_vac, stages, requirements, curriculum_plan, vocational_dimension, support, activities, users_idusers, name_regime, name_accommodation, name_region
    FROM courses
    INNER JOIN course_regime ON courses.course_regime_idcourse_regime = course_regime.idcourse_regime
    INNER JOIN accommodation ON courses.accommodation_idaccommodation = accommodation.idaccommodation
    INNER JOIN region ON courses.region_idregion = region.idregion
    WHERE idcourses = ?";

    $query2 = "SELECT name_interested_area
    FROM areas
    INNER JOIN courses_has_areas ON areas.idareas = courses_has_areas.areas_idareas
    WHERE courses_has_areas.courses_idcourses = ?";

    $query3 = "SELECT name_learning
    FROM learning_type
    INNER JOIN users ON learning_type.idlearning_type = users.learning_type_idlearning_type
    WHERE users.idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idcourse);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_course, $description_course, $website_course, $facebook_course, $instagram_course, $course_director, $email_course, $phone_course, $duration_course, $credits_ects, $languages, $course_fee, $certification, $target, $number_vac, $stages, $requirements, $curriculum_plan, $vocational_dimension, $support, $activities, $users_idusers, $name_regime, $name_accommodation, $name_region);

        if (mysqli_stmt_fetch($stmt)) {
?>
            <section class="container-fluid bgGreyInfo">
                <div class="container">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="pt-4">
                        <ol class="breadcrumb infosbreadcrumb">
                            <?php
                            if ($User_type == 10) {
                            ?>
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                            <li class="breadcrumb-item"><a href="matchCourse.php" title="Voltar às minhas ligações">Eu quero estudar</a></li>
                            <?php
                            } else if ($User_type == 13) {
                            ?>
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                            <li class="breadcrumb-item"><a href="allCoursesHeis.php" title="Voltar aos meus cursos">Cursos</a></li>
                            <?php
                            } else if ($User_type == 16) {
                            ?>
                            <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                            <li class="breadcrumb-item"><a href="IndividualReqEditTutor.php" title="Voltar ao pedido de edição">Pedido de edição</a></li>
                            <?php
                            }
                            ?>
                            <li class="breadcrumb-item active" aria-current="page">Informações sobre o curso</li>
                        </ol>
                    </nav>
                </div>
            </section>

            <!-- Info bigger devices-->
            <section class="jumbotron bgCoverSectionInfo CourseBg bigBg">
                <div class="bg-whiteInfo ps-3 pe-3">
                    <h1 class="pt-5 pb-2 text-center">Informação sobre o curso</h1>
                    <h3 class="pb-4 text-center textPink"><?= $name_course ?></h3>
                    <p><?= $description_course ?>.</p>
                </div>
            </section>

            <!-- Info smaller devices-->
            <section class="smallBg whiteBg">
                <div class="jumbotron bgCoverSectionInfo CourseBg smallBg"></div>
                <div class="bg-whiteInfo ps-3 pe-3">
                    <h1 class="pt-5 pb-2 text-center">Informação sobre o curso</h1>
                    <h3 class="pb-4 text-center textPink"><?= $name_course ?></h3>
                    <p><?= $description_course ?></p>
                </div>
            </section>

            <!--Geral-->
            <section class="container-fluid bgGreyInfo pt-5">
                <div class="container">
                    <div class="row">
                        <!--Duration-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/duration.svg" alt="Ícone de um calendário" title="Ícone de um calendário" />
                            <h3>Duração</h3>
                            <p><?= $duration_course ?></p>
                        </div>

                        <!--Regime-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/regime.svg" alt="Ícone de um relógio" title="Ícone de um relógio" />
                            <h3>Regime</h3>
                            <p><?= $name_regime ?></p>
                        </div>

                        <!--Language-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/language.svg" alt="Ícone de um globo" title="Ícone de um globo" />
                            <h3>Lingua(s) de instrução</h3>
                            <p><?= $languages ?></p>
                        </div>

                        <!--Area-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/area.svg" alt="Ícone de um livro" title="Ícone de um livro" />
                            <h3>Áreas Científicas</h3>
                            <p>
                                <?php
                                $first = true;
                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idcourse);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $name_interested_area);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        if (!$first) {
                                            echo ",";
                                        }
                                        $first = false;
                                        echo " $name_interested_area";
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </p>
                        </div>

                        <!--Subsystem-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/subsystem.svg" alt="Ícone de um chapéu" title="Ícone de um chapéu" />
                            <h3>Subsistema</h3>
                            <p>
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $users_idusers);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $name_learning);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        echo " $name_learning";
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </p>
                        </div>

                        <!--Ects-->
                        <div class="col-md-4 text-center pb-5">
                            <img class="mb-4 img-fluid" src="../../img/course/ects.svg" alt="Ícone de um certificado" title="Ícone de um certificado" />
                            <h3>ECTS</h3>
                            <p><?= $credits_ects ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!--All info-->
            <section class="container pt-5 pb-5">
                <h1 class="pb-5">Todas as informações do Curso</h1>
                <ul class="nav nav-tabs nav-fill infoTabs infoCourse" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle align-middle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Informação</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="requirements-tab" data-bs-toggle="tab" data-bs-target="#requirements" type="button" role="tab" aria-controls="requirements" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle align-middle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Requisitos</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="curricular-tab" data-bs-toggle="tab" data-bs-target="#curricular" type="button" role="tab" aria-controls="curricular" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul align-middle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Plano Curricular</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat align-middle" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z" />
                            </svg>
                            <span class="ps-2 align-middle textHideSmall">Contactos</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!--INFORMATION-->
                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="pt-4">
                            <h4 class="textPink">Destinatários</h4>
                            <p><?= $target ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Vagas</h4>
                            <p><?= $number_vac ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Região</h4>
                            <p><?= $name_region ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Fases de aplicação</h4>
                            <p><?= $stages ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Apoio</h4>
                            <p><?= $support ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Alojamento</h4>
                            <p><?= $name_accommodation ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Certificação do curso</h4>
                            <p><?= $certification ?></p>
                        </div>

                    </div>

                    <!--REQUIREMENTS-->
                    <div class="tab-pane fade" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
                        <div class="pt-4">
                            <h4 class="textPink">Requisitos</h4>
                            <p><?= $requirements ?></p>
                        </div>
                    </div>

                    <!--CURRICULUM PLAN-->
                    <div class="tab-pane fade" id="curricular" role="tabpanel" aria-labelledby="curricular-tab">
                        <div class="pt-4">
                            <h4 class="textPink">Tipo de unidade curricular do plano curricular</h4>
                            <p><?= $curriculum_plan ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Dimensão profissional</h4>
                            <p><?= $vocational_dimension ?></p>
                        </div>

                        <div class="text-center pt-4">
                            <a href="https://<?= $website_course ?>" title="Ir para o Website informativo do curso">
                                <button class="btn buttonDesign buttonStudy buttonHomeCompSize m-0">Ver mais</button>
                            </a>
                        </div>
                    </div>

                    <!--CONTACTS-->
                    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div class="pt-4">
                            <h4 class="textPink">Diretor do curso</h4>
                            <p><?= $course_director ?></p>
                        </div>

                        <div class="pt-4">
                            <h4 class="textPink">Contactos</h4>
                            <div class="row pt-4">
                                <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                    <div class="infos itemsInfosCourses infosSmaller">
                                        <p class="mb-0">
                                            <i class="fa-solid fa-at align-middle"></i>
                                            <b class="ps-2 align-middle">Email : </b>
                                            <a class="linkContacts align-middle" title="Clicar para enviar e-mail para <?= $email_course ?>" href="mailto:<?= $email_course ?>"><?= $email_course ?></a>
                                        </p>
                                    </div>
                                </div>

                                <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                    <div class="infos itemsInfosCourses infosSmaller">
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone align-middle" viewBox="0 0 16 16">
                                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                            <b class="ps-2 align-middle">Telefone : </b>
                                            <a class="linkContacts align-middle" title="Clicar para telefonar para <?= $phone_course ?>" href="tel:<?= $phone_course ?>"><?= $phone_course ?></a>
                                        </p>
                                    </div>
                                </div>

                                <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                    <div class="infos itemsInfosCourses infosSmaller">
                                        <p class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe align-middle" viewBox="0 0 16 16">
                                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                                            </svg>
                                            <b class="ps-2 align-middle">Website : </b>
                                            <a class="linkContacts align-middle" title="Clicar para visitar o website" href="https://<?= $website_course ?>" target="_blank"><?= $website_course ?></a>
                                        </p>
                                    </div>
                                </div>

                                <?php
                                if ($facebook_course != NULL) {
                                ?>
                                    <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                        <div class="infos itemsInfosCourses infosSmaller">
                                            <p class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook align-middle" viewBox="0 0 16 16">
                                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                </svg>
                                                <b class="ps-2 align-middle">Facebook : </b>
                                                <a class="linkContacts align-middle" title="Clicar para visitar o Facebook" href="https://www.facebook.com/<?= $facebook_course ?>/"> <?= $facebook_course ?></a>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($instagram_course != NULL) {
                                ?>

                                    <div id="cardInfos" class="col-12 col-md-6 col-lg-4 pb-3">
                                        <div class="infos itemsInfosCourses infosSmaller">
                                            <p class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram align-middle" viewBox="0 0 16 16">
                                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                </svg>
                                                <b class="ps-2 align-middle">Instagram : </b>
                                                <a class="linkContacts align-middle" title="Clicar para visitar o Instagram" href="https://www.instagram.com/<?= $instagram_course ?>/"> <? $instagram_course ?></a>
                                            </p>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
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

?>