<?php
if (isset($_GET["info"])) {
    $idcourses = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT name_course_en, description_course_en, website_course, facebook_course, instagram_course, course_director, email_course, phone_course, duration_course_en, credits_ects_en, languages_en, course_fee_en, certification_en, target_en, number_vac, stages_en, requirements_en, curriculum_plan_en, vocational_dimension_en, support_en, activities_en, users_idusers, name_regime_en, name_accommodation_en, name_region_en
    FROM courses
    INNER JOIN course_regime ON courses.course_regime_idcourse_regime = course_regime.idcourse_regime
    INNER JOIN accommodation ON courses.accommodation_idaccommodation = accommodation.idaccommodation
    INNER JOIN region ON courses.region_idregion = region.idregion
    WHERE idcourses = ?";

    $query2 = "SELECT name_interested_area_en
    FROM areas
    INNER JOIN courses_has_areas ON areas.idareas = courses_has_areas.areas_idareas
    WHERE courses_has_areas.courses_idcourses = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idcourses);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_course_en, $description_course_en, $website_course, $facebook_course, $instagram_course, $course_director, $email_course, $phone_course, $duration_course_en, $credits_ects_en, $languages_en, $course_fee_en, $certification_en, $target_en, $number_vac, $stages_en, $requirements_en, $curriculum_plan_en, $vocational_dimension_en, $support_en, $activities_en, $users_idusers, $name_regime_en, $name_accommodation_en, $name_region_en);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Course details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the details of the selected course.</p>
            <div class="card text-center mb-5">
                <div class="col-12">
                    <?php
                    if (isset($name_course_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Course name: <span style="font-size: 16px;"><?= $name_course_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Course name: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Region: <span style="font-size: 16px;"><?= $name_region_en ?></span></h5>
                        <hr>
                    </div>

                    <?php
                    if (isset($description_course_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Description: <span style="font-size: 16px;"><?= $description_course_en ?></span></h5>
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
                        <h5 for="nome">Website: <span style="font-size: 16px;"><?= $website_course ?></span></h5>
                        <hr>
                    </div>

                    <?php
                    if (isset($facebook_course)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Facebook: <span style="font-size: 16px;"><?= $facebook_course ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($instagram_course)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Instagram: <span style="font-size: 16px;"><?= $instagram_course ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Course director: <span style="font-size: 16px;"><?= $course_director ?></span></h5>
                        <hr>
                    </div>

                    <div class="text-left">
                        <h5 for="nome">Email: <span style="font-size: 16px;"><?= $email_course ?></span></h5>
                        <hr>
                    </div>

                    <div class="text-left">
                        <h5 for="nome">Phone number: <span style="font-size: 16px;"><?= $phone_course ?></span></h5>
                        <hr>
                    </div>

                    <?php
                    if (isset($duration_course_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Duration: <span style="font-size: 16px;"><?= $duration_course_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Duration: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($credits_ects_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">ECTS: <span style="font-size: 16px;"><?= $credits_ects_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">ECTS: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($languages_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Languages of instruction: <span style="font-size: 16px;"><?= $languages_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Languages of instruction: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($course_fee_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Course fee: <span style="font-size: 16px;"><?= $course_fee_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Course fee: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($certification_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Certification: <span style="font-size: 16px;"><?= $certification_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Certification: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($target_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Target: <span style="font-size: 16px;"><?= $target_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Target: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Vacancies available: <span style="font-size: 16px;"><?= $number_vac ?></span></h5>
                        <hr>
                    </div>

                    <?php
                    if (isset($stages_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Application phases: <span style="font-size: 16px;"><?= $stages_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Application phases: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($requirements_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Requirements: <span style="font-size: 16px;"><?= $requirements_en ?></span></h5>
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

                    <?php
                    if (isset($curriculum_plan_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Type of curricular unit of the curriculum plan: <span style="font-size: 16px;"><?= $curriculum_plan_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Type of curricular unit of the curriculum plan: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($vocational_dimension_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Professional dimension: <span style="font-size: 16px;"><?= $vocational_dimension_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Professional dimension: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($support_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Support: <span style="font-size: 16px;"><?= $support_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Support: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($activities_en)) {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Activities: <span style="font-size: 16px;"><?= $activities_en ?></span></h5>
                            <hr>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-left">
                            <h5 for="nome">Activities: <span class="text_translate" style="font-size: 16px;">Requires translation</span></h5>
                            <hr>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="text-left">
                        <h5 for="nome">Regime: <span style="font-size: 16px;"><?= $name_regime_en ?></span></h5>
                        <hr>
                    </div>

                    <div class="text-left">
                        <h5 for="nome">Accommodation: <span style="font-size: 16px;"><?= $name_accommodation_en ?></span></h5>
                        <hr>
                    </div>

                    <div class='text-left'>
                        <h5 for='nome'>Area(s): </h5>
                        <?php
                        if (mysqli_stmt_prepare($stmt, $query2)) {

                            mysqli_stmt_bind_param($stmt, 'i', $idcourses);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $name_interested_area_en);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo "<ul>
                            <li  style='font-size: 16px; font-family: 'Quicksand', 'Montserrat', sans-serif !important; list-style-type:circle;'>$name_interested_area_en</li>
                            </ul>";
                            }
                        }
                        ?>
                    </div>
                    <hr>


                    <div class="form-group mt-5">
                        <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#deleteCourseHei<?= $idcourses ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Delete course</button></a>
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