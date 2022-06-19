<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT users_has_courses.users_idusers, users_has_courses.courses_idcourses, courses.idcourses, courses.name_course_be, courses.users_idusers, users.name_user
    FROM users_has_courses
    INNER JOIN courses ON users_has_courses.courses_idcourses = courses.idcourses
    INNER JOIN users ON users.idusers = users_has_courses.users_idusers
    WHERE courses.users_idusers = ?
    ORDER BY id_match_course DESC
    LIMIT 6";
?>
    <!-- Header -->
    <div class="jumbotron bg-cover text-white startBgPerson">
        <div class="container py-5 text-center">
            <h1 class="fontWhite textBanner">Welkom bij HiLives!</h1>
            <div class="arrow">
                <a class="fa-solid fa-circle-chevron-down" href="#firstSectionHei" title="Ga naar het eerste gedeelte"></a>
            </div>
        </div>
    </div>

    <!-- Matchs -->
    <section id="firstSectionHei" class="conatiner-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">Waarom HiLives?</h2>
            <div class="row">
                <div class="col-12 col-md-6 ps-4 pe-4 marginBottomSmall">
                    <img src="../../img/matchs.svg" alt="Icoon van een persoon" class="img-fluid" title="Contact met mensen met intellectuele en ontwikkelingsvaardigheden">
                    <h3 class="mt-4 pb-2">Contact met mensen met intellectuele en ontwikkelingsvaardigheden</h3>
                    <p>Als u een cursus heeft die geschikt is voor mensen met intellectuele en ontwikkelingsmoeilijkheden, zal HiLives u vertellen welke kandidaten het beste passen bij de cursuskenmerken.</p>
                    <br>
                    <a href="matchCourseHeis.php" title="Bekijk kandidaten">
                        <button class="btn buttonDesign buttonWork buttonHomeCompSize m-0">
                            Bekijk kandidaten
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-6 ps-4 pe-4">
                    <img src="../../img/courses.svg" alt="Icoon van een boek" class="img-fluid" title="Promotie van cursussen">
                    <h3 class="mt-4 pb-2">Wij helpen u bij het promoten van cursussen</h3>
                    <p>Als je cursussen beschikbaar hebt bij je instelling, publiceer ze dan gewoon op dit platform en HiLives helpt je bij je gezamenlijke verspreiding van mensen met intellectuele en ontwikkelingsmoeilijkheden.</p>
                    <br>
                    <a href="uploadCourseHei.php" title="Een cursus toevoegen">
                        <button class="btn buttonDesign buttonWork buttonHomeCompSize m-0">
                            Cursus toevoegen
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- HiLives Stories bigger devices-->
    <section class="jumbotron bgCoverSection homePersonBg bigBg">
        <div class="bg-white ps-3 pe-3">
            <h3 class="pt-5 pb-5 text-center">Wil je verhalen zien van mensen met intellectuele en ontwikkelingsmoeilijkheden?</h3>
            <ul class="ulStories">
                <li class="pb-5">Je hebt toegang tot verhalen via video's, teksten, audio en beeld.</li>
                <li class="pb-5">U kunt de verhalen delen van mensen met DIS die uw instelling bezoeken.</li>
            </ul>
            <div class="text-center">
                <a href="stories.php" title="Bekijk HiLives-verhalen">
                    <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                        Bekijk HiLives Stories
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- HiLives Stories smaller devices-->
    <section class="smallBg whiteBg">
        <div class="jumbotron bgCoverSection homePersonBg smallBg"></div>
        <div class="bg-white ps-3 pe-3">
            <h3 class="pt-5 pb-5 text-center">Wil je verhalen zien van mensen met intellectuele en ontwikkelingsmoeilijkheden?</h3>
            <ul class="ulStories">
                <li class="pb-5">Je hebt toegang tot verhalen via video's, teksten, audio en beeld.</li>
                <li class="pb-3">U kunt de verhalen delen van mensen met DIS die uw instelling bezoeken.</li>
            </ul>
            <div class="text-center">
                <a href="stories.php" title="Bekijk HiLives-verhalen">
                    <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                        Bekijk HiLives Stories
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent connections -->
    <section class="container-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">Recente links naar mensen</h2>
            <div class="row">
                <?php

                if (mysqli_stmt_prepare($stmt, $query1)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $users_idusers, $courses_idcourses, $idcourses, $name_course, $users_idusers, $name_user);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        while (mysqli_stmt_fetch($stmt)) {
                ?>
                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                <div class="list listStudy text-center">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book align-middle" viewBox="0 0 16 16">
                                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                        </svg>
                                        <span class="ps-2 align-middle">Studeren</span>
                                    </p>
                                    <h4><?= $name_user ?></h4>
                                    <p><?= $name_course ?></p>
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
                                            Er is nog steeds geen verband met je cursussen.
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
} else {
    include("404.php");
}

mysqli_close($link);

?>