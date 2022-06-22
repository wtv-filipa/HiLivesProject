<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT id_match_vac, user_young, vacancies_idvacancies, match_perc, vacancy_name_be, company_id, name_user
    FROM users_has_vacancies
    INNER JOIN vacancies ON users_has_vacancies.vacancies_idvacancies = vacancies.idvacancies
    INNER JOIN users ON users.idusers = vacancies.company_id
    WHERE user_young = ?
    ORDER BY id_match_vac DESC";

    $query2 = "SELECT idvacancies, vacancy_name_be, company_id, name_user, user_young, vacancies_idvacancies
    FROM vacancies
    LEFT JOIN users_has_vacancies ON vacancies.idvacancies = users_has_vacancies.vacancies_idvacancies AND users_has_vacancies.user_young = ?
    INNER JOIN users ON users.idusers = vacancies.company_id
    ORDER BY idvacancies DESC";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php" title="Terug naar Startpagina"> Startpagina</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ik wil werken</li>
            </ol>
        </nav>

        <h1 class="pb-2">Belangrijkste kansen | Vacatures op de arbeidsmarkt</h1>
        <p class="pb-4">Op deze pagina vindt u al uw links naar vacatures gepubliceerd door bedrijven. Wees voorzichtig dat sommige van hen kunnen wijzen op enkele van de kwaliteiten die je mist, maar die je op de een of andere manier kunt krijgen!</p>

        <section class="row">
            <?php
            if (mysqli_stmt_prepare($stmt, $query1)) {

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
                                    <p class="buttonKnowMore">Meer informatie</p>
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
                                                Je hebt nog steeds geen verband met bedrijfsvacatures. Kom later terug.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    <?php
                    }
                }
                    ?>
        </section>

        <section class="pt-4 pb-5">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Andere vacatures die u mogelijk interesseren
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row pt-3">
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $idvacancies, $vacancy_name, $company_id, $name_user, $user_young, $vacancies_idvacancies);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) > 0) {
                                        while (mysqli_stmt_fetch($stmt)) {
                                            if ($vacancies_idvacancies == NULL) {
                                ?>
                                                <a href="infoVacancy.php?vac=<?= $idvacancies ?>" title="Bekijk vacature informatie <?= $vacancy_name ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                    <div class="list listWork text-center">
                                                        <p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                            </svg>
                                                            <span class="ps-2 align-middle">Werk</span>
                                                        </p>
                                                        <h4><?= $vacancy_name ?></h4>
                                                        <p><?= $name_user ?></p>
                                                        <p class="buttonKnowMore">Meer informatie</p>
                                                    </div>
                                                </a>
                                        <?php
                                            }
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
                                                            Er zijn nog geen andere vacatures gepubliceerd door bedrijven. Kom later terug.
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
        </section>

    </div>
<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>