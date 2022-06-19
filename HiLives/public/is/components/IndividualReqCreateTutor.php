<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["create"])) {
    $idNavegar = $_SESSION["idUser"];
    $idUser = $_GET["create"];

    $query = "SELECT name_user, email_user, contact_user, birth_date, status_create
    FROM users
    WHERE idusers = ?";

    $query2 = "SELECT name_region_is
    FROM region
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion
    INNER JOIN users ON users_has_region.users_idusers = users.idusers
    WHERE idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_user, $email_user, $contact_user, $birth_date, $status_create);
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
                                <li class="breadcrumb-item"><a href="homeTutor.php" title="Aftur heim">Heimasíða</a></li>
                                <li class="breadcrumb-item"><a href="registerRequestsTutor.php" title="Til baka í skráningarumsóknir"> Beiðnir um skráningu</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Beiðni um <?= $name_user ?></li>
                            </ol>
                        </nav>

                        <?php
                        if (isset($_SESSION["create"])) {
                            $msg_show = true;
                            switch ($_SESSION["create"]) {
                                case 1:
                                    $message = "Forstilling var búin til!";
                                    $class = "alert-success";
                                    $_SESSION["create"] = 0;
                                    break;
                                case 2:
                                    $message = "Villa kom upp við vinnslu pöntunarinnar, vinsamlegast reyndu aftur síðar.";
                                    $class = "alert-warning";
                                    $_SESSION["create"] = 0;
                                    break;
                                case 3:
                                    $message = "Pöntunarstaða var uppfærð!";
                                    $class = "alert-success";
                                    $_SESSION["create"] = 0;
                                    break;
                                case 0:
                                    $msg_show = false;
                                    break;
                                default:
                                    $msg_show = false;
                                    $_SESSION["create"] = 0;
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

                        <h1 class="pt-4 pb-2">Beiðni um skráningu á</h1>
                        <h3 class="pb-5 textPink"><?= $name_user ?></h3>
                        <!--PROFILE STAGES BIG-->
                        <div class="row pb-4 bigBg">
                            <div class="col-12 text-center">
                                <div class="imageLearn">
                                    <?php
                                    if ($status_create == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create1.svg" alt="Pöntun í bið" title="Pöntun í bið" />
                                    <?php
                                    } else if ($status_create == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create2.svg" alt="Áætlað viðtal" title="Áætlað viðtal" />
                                    <?php
                                    } else if ($status_create == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create3.svg" alt="Full forstilling" title="Full forstilling" />
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
                                    if ($status_create == 1) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create_small1.svg" alt="Pöntun í bið" title="Pöntun í bið" />
                                    <?php
                                    } else if ($status_create == 2) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create_small2.svg" alt="Áætlað viðtal" title="Áætlað viðtal" />
                                    <?php
                                    } else if ($status_create == 3) {
                                    ?>
                                        <img class="mb-4 img-fluid" src="../../img/status/is/pending_create_small3.svg" alt="Full forstilling" title="Full forstilling" />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Info bigger devices-->
                <section class="jumbotron bgCoverSection CreateBg bigBg">
                    <div class="bg-white bg-whiteSizeAdjust ps-5 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Upplýsingar um</h1>
                        <h3 class="pb-4 text-center textPink"><?= $name_user ?></h3>
                        <p><b>Tölvupóstur</b>: <?= $email_user ?></p>
                        <p><b>Samband</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Áhugaverð svæði:
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
                        <p><b>Fæðingardagur</b>: <?= $newDate ?></p>

                        <div class="text-center pt-2">
                            <a href="createProfileTutor.php?create=<?= $idUser ?>" title="Breyta forstillingu">
                                <button class="btn buttonDesign buttonStudy buttonRegisterSize m-0">
                                    Breyta forstillingu
                                </button>
                            </a>
                        </div>
                        <?php
                        if ($status_create == 1) {
                        ?>
                            <hr>
                            <div class="text-center textForm">
                                <a class="small linkRequest create" title="Smelltu til að uppfæra pöntunarstöðuna í 'Viðtal athugað'" href="../../scripts/updateIndividualRequest.php?create=<?= $idUser ?>" title="Uppfæra stöðu pöntunar">Ertu búinn að skipuleggja viðtalið? Smellt er hér til að uppfæra pöntunarstöðuna.</a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </section>

                <!-- Info smaller devices-->
                <section class="smallBg whiteBg">
                    <div class="jumbotron bgCoverSection CreateBg smallBg"></div>
                    <div class="bg-white ps-3 pe-3">
                        <h1 class="pt-5 pb-2 text-center">Informação sobre</h1>
                        <h3 class="pb-4 text-center textPink"><?= $name_user ?></h3>
                        <p><b>Tölvupóstur</b>: <?= $email_user ?></p>
                        <p><b>Samband</b>: <?= $contact_user ?></p>
                        <p>
                            <b>
                                Áhugaverð svæði:
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
                        <p><b>Fæðingardagur</b>: <?= $newDate ?></p>

                        <div class="text-center pt-2 pb-3">
                            <a href="createProfileTutor.php?create=<?= $idUser ?>" title="Breyta forstillingu">
                                <button class="btn buttonDesign buttonStudy buttonRegisterSize m-0">
                                    Breyta forstillingu
                                </button>
                            </a>
                        </div>

                        <?php
                        if ($status_create == 1) {
                        ?>
                            <div class="text-center textForm pb-4">
                                <a class="small linkRequest create" title="Smelltu til að uppfæra pöntunarstöðuna í 'Viðtal athugað'" href="../../scripts/updateIndividualRequest.php?create=<?= $idUser ?>" title="Uppfæra stöðu pöntunar">Ertu búinn að skipuleggja viðtalið? Smellt er hér til að uppfæra pöntunarstöðuna.</a>
                            </div>
                        <?php
                        }
                        ?>
                        <hr>

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