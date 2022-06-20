<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if ($_SESSION["idUser"]) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT users_has_courses.users_idusers, users_has_courses.courses_idcourses, courses.idcourses, courses.name_course_en, courses.users_idusers, users.name_user
    FROM users_has_courses
    INNER JOIN courses ON users_has_courses.courses_idcourses = courses.idcourses
    INNER JOIN users ON users.idusers = courses.users_idusers
    WHERE users_has_courses.users_idusers = ?
    ORDER BY id_match_course DESC";

    $query2 = "SELECT courses.idcourses, courses.name_course_en, courses.users_idusers, users.name_user, users_has_courses.users_idusers, users_has_courses.courses_idcourses
    FROM courses
    LEFT JOIN users_has_courses ON courses.idcourses = users_has_courses.courses_idcourses AND users_has_courses.users_idusers = ?
    INNER JOIN users ON users.idusers = courses.users_idusers
    ORDER BY idcourses DESC";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php" title="Back to homepage">Homepage</a></li>
                <li class="breadcrumb-item active" aria-current="page">I want to study</li>
            </ol>
        </nav>

        <h1 class="pb-2">Main opportunities | Courses at Higher Education Institutions</h1>
        <p class="pb-4">On this page you will find all your connections to Higher Education Institutions and the courses you have a connection with.</p>

        <section class="row">
            <?php
            if (mysqli_stmt_prepare($stmt, $query1)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $users_idusers, $courses_idcourses, $idcourses, $name_course, $users_idusers, $name_user);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while (mysqli_stmt_fetch($stmt)) {
            ?>
                        <a href="infoCourse.php?course=<?= $courses_idcourses ?>" title="View more about the course <?= $name_course ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                            <div class="list listStudy text-center">
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book align-middle" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                    </svg>
                                    <span class="ps-2 align-middle">Study</span>
                                </p>
                                <h4><?= $name_course ?></h4>
                                <p><?= $name_user ?></p>
                                <p class="buttonKnowMoreStudy">Know more</p>
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
                                        You don't have any connections to Higher Education Institutions courses yet. Please come back later.
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
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Other courses that might interest you
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row pt-3">
                                <?php
                                if (mysqli_stmt_prepare($stmt, $query2)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $idUser);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $idcourses, $name_course, $users_idusers, $name_user, $users_idusers, $courses_idcourses);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) > 0) {
                                        while (mysqli_stmt_fetch($stmt)) {
                                            if ($courses_idcourses == NULL) {
                                ?>
                                                <a href="infoCourse.php?course=<?= $idcourses ?>" title="View more about the course <?= $name_course ?>" id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                                                    <div class="list listStudy text-center">
                                                        <p>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book align-middle" viewBox="0 0 16 16">
                                                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                                            </svg>
                                                            <span class="ps-2 align-middle">Study</span>
                                                        </p>
                                                        <h4><?= $name_course ?></h4>
                                                        <p><?= $name_user ?></p>
                                                        <p class="buttonKnowMoreStudy">Know more</p>
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
                                                            There are no other courses published by Higher Education Institutions yet. Please check back later.
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