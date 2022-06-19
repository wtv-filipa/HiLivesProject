<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    $id_navegar = $_SESSION["idUser"];
    $User_type = $_SESSION["type"];

    $query = "SELECT experiences.idexperiences, experiences.description_is, experiences.date, experiences.xp_type, experiences.content_idcontent, content.idContent, content.content_name, users.idusers, users.name_user, users.profile_img, users.user_type_iduser_type
    FROM experiences
    LEFT JOIN content ON experiences.content_idcontent = content.idcontent
    INNER JOIN users ON experiences.users_idusers = users.idusers
    ORDER BY idexperiences DESC";
?>
    <?php
    if ($User_type != 16) {
    ?>
        <nav class="navbar navbar-light navBgColor sticky-top">
            <div class="container">
                <span class="navbar-text navstories">
                    <a href="uploadStory.php" title="Bæta við nýrri sögu">
                        Búa til sögu
                        <i class="fa-solid fa-angle-right arrowRight"></i>
                    </a>
                </span>
            </div>
        </nav>
    <?php
    }
    ?>

    <div class="container pb-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
            <ol class="breadcrumb">
                <?php
                if ($User_type == 7) {
                ?>
                    <li class="breadcrumb-item"><a href="homeComp.php" title="Aftur heim">Heimasíða</a></li>
                <?php
                } else if ($User_type == 10) {
                ?>
                    <li class="breadcrumb-item"><a href="homePerson.php" title="Aftur heim">Heimasíða</a></li>
                <?php
                } else if ($User_type == 13) {
                ?>
                    <li class="breadcrumb-item"><a href="homeHei.php" title="Aftur heim">Heimasíða</a></li>
                <?php
                } else if ($User_type == 16) {
                ?>
                    <li class="breadcrumb-item"><a href="homeTutor.php" title="Aftur heim">Heimasíða</a></li>
                <?php
                }
                ?>
                <li class="breadcrumb-item active" aria-current="page">HiLives sögur</li>
            </ol>
        </nav>

        <h1 class="pb-2">HiLives sögur</h1>
        <?php
        if ($User_type == 10) {
            echo "<p>Hér finnur þú myndbönd, myndir, hljómflutnings-og texta sem sýna fram á fræðilega og faglega reynslu annarra HiLives notenda. Þú getur líka fundið myndbönd sem sýna umhverfi fyrirtækja eða háskóla. Hver sem er getur birt þína sögu! <a class='linkIcons' href='uploadStory.php' title='Bæta við nýrri sögu'> Bættu við þínu hér! </a></p>";
        } else {
            echo "<p>Hér finnur þú myndbönd, myndir, hljómflutnings-og texta sem sýna fram á fræðilega og faglega reynslu annarra HiLives notenda. Þú getur líka fundið myndbönd sem sýna umhverfi fyrirtækja eða háskóla. Hver sem er getur birt þína sögu! <a class='linkIcons' href='uploadStory.php' title='Bæta við nýrri sögu'> Bættu við þínu hér!</a></p>";
        }
        ?>

        <!--STORIES-->
        <?php
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idexperiences, $description, $date, $xp_type, $content_idcontent, $idContent, $content_name, $idusers, $name_user, $profile_img, $iduser_type);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                while (mysqli_stmt_fetch($stmt)) {
                    $data = substr($date, 0, 10);
                    $newDate = date("d-m-Y", strtotime($data));
        ?>

                    <div class="wrapperStory">
                        <header class="cf">
                            <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" title="Forstilling á <?= $name_user ?>">
                                <?php
                                if (isset($profile_img)) {
                                ?>
                                    <img class="profile-pic" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" title="Prófílmynd af <?= $name_user ?>" />
                                <?php
                                } else {
                                ?>
                                    <img class="profile-pic" src="../../img/no_profile_img.png" alt="engin prófílmynd" title="engin prófílmynd" />
                                <?php
                                }
                                ?>
                            </a>
                            <h5 class="name">
                                <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" class="linkStory"><?= $name_user ?> </a>
                            </h5>
                            <p class="cardInfo13"><?= $newDate ?></p>
                        </header>
                        <?php
                        //VIDEO
                        if ($xp_type == "video") {
                            if (isset($description)) {
                        ?>
                                <p class="status"><?= $description ?></p>
                            <?php
                            }
                            ?>
                            <div class="text-center videoStory">
                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5 videoSize">
                                    <video class="embed-responsive-item" src="../../../admin/uploads/experiences/<?= $content_name ?>" controls="controls"></video>
                                </div>
                            </div>
                            <?php
                            //AUDIO
                        } else if ($xp_type == "audio") {
                            if (isset($description)) {
                            ?>
                                <p class="status"><?= $description ?></p>
                            <?php
                            }
                            ?>
                            <div class="text-center">
                                <audio controls>
                                    <source src="../../../admin/uploads/experiences/<?= $content_name ?>" type="audio/ogg">
                                    <source src="../../../admin/uploads/experiences/<?= $content_name ?>" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <?php
                            //IMAGE
                        } else if ($xp_type == "image") {
                            if (isset($description)) {
                            ?>
                                <p class="status"><?= $description ?></p>
                            <?php
                            }
                            ?>
                            <div class="text-center videoSize">
                                <img class="img-content img-fluid" src="../../../admin/uploads/experiences/<?= $content_name ?>" />
                            </div>
                        <?php
                        } else if ($xp_type == "text" && isset($description)) {
                        ?>
                            <p class="status"><?= $description ?></p>
                        <?php
                        }
                        ?>
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
                                    Í augnablikinu er engin útgefin frétt. Vinsamlega komið aftur síðar.
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
<?php

} else {
    include("404.php");
}

mysqli_close($link);
?>