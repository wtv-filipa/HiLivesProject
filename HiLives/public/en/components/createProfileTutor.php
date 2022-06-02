<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

if (isset($_SESSION["idUser"]) && isset($_GET["create"])) {
    $idNavegar = $_SESSION["idUser"];
    $idUser = $_GET["create"];

    $query = "SELECT ideduc_lvl, name_education_en
    FROM educ_lvl";

    $query2 = "SELECT idareas, name_interested_area_en
    FROM areas";

    $query3 = "SELECT idcapacities, capacity_en
    FROM capacities";

    $query4 = "SELECT idwork_environment, name_environment_en
    FROM work_environment";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeTutor.php" title="Back to homepage">Homepage</a></li>
                <li class="breadcrumb-item"><a href="registerRequestsTutor.php" title="Back to registration requests">Registration requests</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Profile</li>
            </ol>
        </nav>

        <?php
        if (isset($_SESSION["create"])) {
            $msg_show = true;
            switch ($_SESSION["create"]) {
                case 1:
                    $message = "An error has occurred while processing your request, please try again later.";
                    $class = "alert-success";
                    $_SESSION["create"] = 0;
                    break;
                case 2:
                    $message = "All mandatory fields must be filled in.";
                    $class = "alert-warning";
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

        <div class="card o-hidden border-0 shadowCard my-5 paddingForms">
            <div class="card-body p-0">
                <h1 class="text-center">Create Profile</h1>
                <hr>
                <form class="ps-3" method="post" role="form" id="tutor-form" action="../../scripts/createProfileTutor_en.php?create=<?= $idUser ?>">
                    <p style="font-size: 14px; color: #AE0168 !important;">* Mandatory</p>

                    <!--Escolaridade-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="esc">Education <span class="asteriskPink">*</span></label>
                        <select class="form-select greyBorder" id="esc" name="esc" aria-required="true" required="required">
                            <option selected disabled>Select an option</option>
                            <?php
                            $link = new_db_connection();
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $ideduc_lvl, $name_education);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "\n\t\t<option value=\"$ideduc_lvl\">$name_education</option>";
                                    }
                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!--AREAS-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="area">Areas of interest (to study or work) <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query2)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idareas, $name_interested_area);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idareas' id='flexCheckDefault' name='area[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_interested_area
                                                     </label>
                                        </div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!--WORK EXPERIENCE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="exp_t">Work experience <span class="asteriskPink">*</span></label>
                        <textarea class="form-control " id="exp_t" rows="5" name="exp_t" placeholder="Type here the work experience that the Person with IDD has" aria-required="true" required="required"></textarea>
                    </div>

                    <!--CAPACITIES-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="capacity">The sentences that best describe the Person with IDD (select five or more sentences) <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query3)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idcapacities, $capacity);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idcapacities' id='flexCheckDefault' name='capacity[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
                                                            $capacity
                                                     </label>
                                        </div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!--WORK ENVIRONMENT-->
                    <div class="form-group pb-4">
                        <div class="row">
                            <label class="boldFont mt-3 pb-2" for="environment">Favorite work environments <span class="asteriskPink">*</span></label>
                            <?php
                            $stmt = mysqli_stmt_init($link);
                            if (mysqli_stmt_prepare($stmt, $query4)) {
                                if (mysqli_stmt_execute($stmt)) {
                                    mysqli_stmt_bind_result($stmt, $idwork_environment, $name_environment);
                                    while (mysqli_stmt_fetch($stmt)) {

                                        echo "<div class='form-check col-xs-12 col-md-6 col-lg-4 paddingCheck'>
                                                <input class='form-check-input' type='checkbox' value='$idwork_environment' id='flexCheckDefault' name='environment[]'>
                                                    <label class='form-check-label' for='flexCheckDefault'>
                                                            $name_environment
                                                     </label>
                                        </div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!--WORK EXPERIENCE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="def">What else can the Person with IDD say about himself <span class="asteriskPink">*</span></label>
                        <textarea class="form-control " id="def" rows="5" name="def" placeholder="For example: if she/he has any needs she/he can indicate here (such as the need for a lift and/or access ramps)." aria-required="true" required="required"></textarea>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
} else {
    include("404.php");
}
?>