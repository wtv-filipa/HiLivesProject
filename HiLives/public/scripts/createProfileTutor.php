<?php
require_once("../../connections/connection.php");
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idDone_CU = $_GET["create"];

$query = "INSERT INTO users_has_areas (description, work_xp, educ_lvl_ideduc_lvl) VALUES (?,?,?)";

$query2 = "INSERT INTO users_has_areas (users_idusers, areas_idareas) VALUES (?,?)";

$query3 = "INSERT INTO users_has_capacities (users_idusers, capacities_idcapacities) VALUES (?,?)";

$query4 = "INSERT INTO users_has_work_environment (users_idusers, work_environment_idwork_environment) VALUES (?,?)";

if (isset($_GET["create"]) && !empty($_POST["esc"]) && !empty($_POST["area"]) && !empty($_POST["exp_t"]) && !empty($_POST["capacity"]) && !empty($_POST["environment"]) && !empty($_POST["def"])) {

    $idDone_CU = $_GET["create"];
    $description = $_POST["def"];
    $work_xp = $_POST["exp_t"];
    $educ_lvl_ideduc_lvl = $_POST["esc"];
} else {
    header("Location: ../pt/pages/editCourse.php?uc=$idDone_CU");
    $_SESSION["doneCU"] = 2;
}
