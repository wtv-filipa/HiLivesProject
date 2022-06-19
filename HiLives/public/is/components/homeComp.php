<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT id_match_vac, user_young, vacancies_idvacancies, match_perc, vacancy_name_is, company_id, name_user
    FROM users_has_vacancies
    INNER JOIN vacancies ON users_has_vacancies.vacancies_idvacancies = vacancies.idvacancies
    INNER JOIN users ON users.idusers = users_has_vacancies.user_young
    WHERE company_id = ?
    ORDER BY id_match_vac DESC
    LIMIT 6";
?>
    <!-- Header -->
    <div class="jumbotron bg-cover text-white startBgPerson">
        <div class="container py-5 text-center">
            <h1 class="fontWhite textBanner">Velkomin á HiLives!</h1>
            <div class="arrow">
                <a class="fa-solid fa-circle-chevron-down" href="#firstSectionComp" title="Fara í fyrsta hlutann"></a>
            </div>
        </div>
    </div>

    <!-- Matchs -->
    <section id="firstSectionComp" class="conatiner-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">Af hverju HiLives?</h2>
            <div class="row">
                <div class="col-12 col-md-6 ps-4 pe-4 marginBottomSmall">
                    <img src="../../img/matchs.svg" alt="Táknmynd einstaklings" class="img-fluid" title="Leita að frambjóðendum">
                    <h3 class="mt-4 pb-2">Við hjálpum þér að finna frambjóðendur</h3>
                    <p>Ef þú ert að leita að mannauði fyrir fyrirtækið þitt, HiLives mun segja þér hvaða frambjóðendur passa best viðeigandi eiginleika.</p>
                    <br>
                    <a href="matchVacancyComp.php" title="Sjá frambjóðendur">
                        <button class="btn buttonDesign buttonWork buttonHomeCompSize m-0">
                            Sjá frambjóðendur
                        </button>
                    </a>
                </div>
                <div class="col-12 col-md-6 ps-4 pe-4">
                    <img src="../../img/work.svg" alt="Tákn vinnubókar" class="img-fluid" title="Kynning á lausum störfum">
                    <h3 class="mt-4 pb-2">Við hjálpum þér að kynna starfsopnun</h3>
                    <p>Ef þú ert með laus störf í boði í fyrirtækinu þínu skaltu bara birta þau á þessum vettvangi og HiLives hjálpar þér við sameiginlega birtingu þína á Fólki með IDD.</p>
                    <br>
                    <a href="uploadVacancy.php" title="Bæta við lausu starfi">
                        <button class="btn buttonDesign buttonWork buttonHomeCompSize m-0">
                            Bæta við lausu starfi
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- HiLives Stories bigger devices-->
    <section class="jumbotron bgCoverSection homePersonBg bigBg">
        <div class="bg-white ps-3 pe-3">
            <h3 class="pt-5 pb-5 text-center">Langar þig að sjá sögur af fólki með?</h3>
            <ul class="ulStories">
                <li class="pb-5">Þú hefur aðgang að sögum í gegnum myndbönd, texta, hljóð og myndir.</li>
                <li class="pb-5">Þú getur deilt sögum fólks með IDD sem vinnur í fyrirtækinu.</li>
            </ul>
            <div class="text-center">
                <a href="stories.php" title="Sjá sögur HiLives">
                    <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                        Skoða HiLives sögur
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- HiLives Stories smaller devices-->
    <section class="smallBg whiteBg">
        <div class="jumbotron bgCoverSection homePersonBg smallBg"></div>
        <div class="bg-white ps-3 pe-3">
            <h3 class="pt-5 pb-5 text-center">Langar þig að sjá sögur af fólki með?</h3>
            <ul class="ulStories">
                <li class="pb-5">Þú hefur aðgang að sögum í gegnum myndbönd, texta, hljóð og myndir.</li>
                <li class="pb-3">Þú getur deilt sögum fólks með IDD sem vinnur í fyrirtækinu.</li>
            </ul>
            <div class="text-center">
                <a href="stories.php" title="Sjá sögur HiLives">
                    <button class="btn buttonDesign buttonWork buttonHomeSize m-0">
                        Skoða HiLives sögur
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Recent connections -->
    <section class="container-fluid greyBg">
        <div class="container text-center pt-5 pb-5">
            <h2 class="pb-4">Nýlegir tenglar á fólk</h2>
            <div class="row">
                <?php

                if (mysqli_stmt_prepare($stmt, $query1)) {

                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_match_vac, $user_young, $vacancies_idvacancies, $match_perc, $vacancy_name, $company_id, $name_user);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        while (mysqli_stmt_fetch($stmt)) {
                ?>
                            <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                <div class="list listWork text-center">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase align-middle" viewBox="0 0 16 16">
                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                        <span class="ps-2 align-middle">Vinna</span>
                                    </p>
                                    <h4><?= $name_user ?></h4>
                                    <p><?= $vacancy_name ?></p>
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
                                            Það er enn engin tenging við laus störf þín.
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