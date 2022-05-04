<?php
session_start();
require_once "../connections/connection.php";

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);

$query20 = "SELECT educ_lvl_ideduc_lvl FROM vacancies WHERE idvacancies = ?";

$query21 = "SELECT idusers, name_user, users.educ_lvl_ideduc_lvl, users_has_region.region_idregion, users_has_areas.areas_idareas, users_has_capacities.capacities_idcapacities
FROM users
INNER JOIN users_has_region ON users.idusers = users_has_region.users_idusers
INNER JOIN users_has_areas ON users.idusers = users_has_areas.users_idusers
INNER JOIN users_has_capacities ON users.idusers = users_has_capacities.users_idusers
WHERE user_type_iduser_type = 10
AND areas_idareas IN (SELECT areas_idareas FROM vacancies WHERE idvacancies = ?)
AND users_has_region.region_idregion IN (SELECT region_idregion FROM vacancies WHERE idvacancies = ?)
AND capacities IN (SELECT capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idvacancies = ?)
AND users.educ_lvl_ideduc_lvl >= ?";

$query22 = "INSERT INTO user_has_vacancies (User_young, vacancies_idvacancies, match_perc) VALUES (?, ?, ?)";

$query23 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn) VALUES (?, ?)";