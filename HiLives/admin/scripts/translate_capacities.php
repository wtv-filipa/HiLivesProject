<?php
require_once "../connections/connection.php";
session_start();

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$idcapacities = $_GET["cap"];

$query = "UPDATE capacities
SET capacity = ?, capacity_en = ?, capacity_es = ?, capacity_be = ?, capacity_is = ?, capacity_comp = ?, capacity_comp_en = ?, capacity_comp_es = ?, capacity_comp_be = ?, capacity_comp_is = ?
WHERE idcapacities = ?";

if (isset($_GET["cap"])) {

    $idcapacities = $_GET["cap"];

    $capacity = $_POST["name"];
    $capacity_en = $_POST["name_en"];
    $capacity_es = $_POST["name_es"];
    $capacity_be = $_POST["name_be"];
    $capacity_is = $_POST["name_is"];

    $capacity_comp = $_POST["name_comp"];
    $capacity_comp_en = $_POST["name_comp_en"];
    $capacity_comp_es = $_POST["name_comp_es"];
    $capacity_comp_be = $_POST["name_comp_be"];
    $capacity_comp_is = $_POST["name_comp_is"];


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $capacity, $capacity_en, $capacity_es, $capacity_be, $capacity_is, $capacity_comp, $capacity_comp_en, $capacity_comp_es, $capacity_comp_be, $capacity_comp_is, $idcapacities);
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../capacities_t.php");
            $_SESSION["cap"] = 2;
        } else {
            header("Location: ../capacities_t.php");
            $_SESSION["cap"] = 1;
            mysqli_stmt_close($stmt);
        }
    } else {
        header("Location: ../capacities_t.php");
        $_SESSION["cap"] = 2;
    }
    mysqli_close($link);
} else {
    header("Location: ../capacities_t.php");
    $_SESSION["cap"] = 2;
}
