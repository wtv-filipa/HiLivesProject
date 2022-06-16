<?php
if (isset($_GET["info"])) {
    $idVacancies = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idvacancies, vacancy_name_en, description_vac_en, free_vac, requirements_en, date_vac, name_region_en, name_user, content_idcontent, workday_name_en, name_education_en, name_interested_area_en 
    FROM vacancies 
    INNER JOIN region ON vacancies.region_idregion  = region.idregion 
    INNER JOIN users ON vacancies.company_id = users.idusers 
    INNER JOIN workday ON vacancies.workday_idworkday = workday.idworkday 
    INNER JOIN educ_lvl ON vacancies.educ_lvl_ideduc_lvl = educ_lvl.ideduc_lvl 
    INNER JOIN areas ON vacancies.areas_idareas = areas.idareas 
    WHERE idvacancies = ?";

    $query2 = "SELECT content_name 
    FROM content 
    INNER JOIN vacancies ON content.idcontent = vacancies.content_idcontent 
    WHERE idvacancies = ?";

    $query3 = "SELECT capacity_comp_en 
    FROM capacities 
    INNER JOIN vacancies_has_capacities ON capacities.idcapacities = vacancies_has_capacities.capacities_idcapacities 
    WHERE vacancies_idvacancies = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idVacancies, $vacancie_name, $description_vac, $number_free_vanc, $requirements, $date_vacancies, $name_region, $name_user, $Content_idContent, $Workday_name, $name_education, $name_interested_area);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Vacancy details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the details of the selected vacancy.</p>
            <div class="card text-center mb-5">
                <div class="col-12">
                    <?php
                    if (isset($vacancie_name)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Vacancy position: <span style="font-size: 16px;"><?= $vacancie_name ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Vacancy position: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($description_vac)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Description: <span style="font-size: 16px;"><?= $description_vac ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Description: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Number of positions available: <span style="font-size: 16px;"><?= $number_free_vanc ?></span></h5>
                    </div>
                    <hr>

                    <?php
                    if (isset($requirements)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Requirements: <span style="font-size: 16px;"><?= $requirements ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Requirements: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Publication date: <span style="font-size: 16px;"><?= $date_vacancies ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Region: <span style="font-size: 16px;"><?= $name_region ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Working hours: <span style="font-size: 16px;"><?= $Workday_name ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Level of education: <span style="font-size: 16px;"><?= $name_education ?></span></h5>
                    </div>
                    <hr>

                    <div class="text-left">
                        <h5 for="nome">Vacancy area(s): <span style="font-size: 16px;">

                                <?php
                                if (!$primeiro) {
                                    echo ",";
                                }
                                $primeiro = false;
                                echo " $name_interested_area";
                                ?>
                            </span></h5>
                    </div>
                    <hr>

                    <div class='text-left'>
                        <h5 for='nome'>Capacities required: </h5>
                        <?php
                        if (mysqli_stmt_prepare($stmt, $query3)) {

                            mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $capacity_comp);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<ul>
                            <li  style='font-size: 16px; font-family: 'Quicksand', 'Montserrat', sans-serif !important; list-style-type:circle;'>$capacity_comp</li>
                            </ul>";
                            }
                        }
                        ?>
                    </div>
                    <hr>

                    <?php
                    if (mysqli_stmt_prepare($stmt, $query2)) {

                        mysqli_stmt_bind_param($stmt, 'i', $idVacancies);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $content_name);
                        while (mysqli_stmt_fetch($stmt)) {
                    ?>
                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5">
                                <video class="embed-responsive-item" src="../admin/uploads/vid_vac/<?= $content_name ?>" controls="controls"></video>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="form-group mt-5">
                        <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#deletevac<?= $idVacancies ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Delete vacancy</button></a>
                        <span></span>
                    </div>

                </div>
            </div>

<?php
            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>