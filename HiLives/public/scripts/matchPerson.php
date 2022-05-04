<?php
$linkComp = new_db_connection();
$stmtComp = mysqli_stmt_init($linkComp);

$linkComp2 = new_db_connection();
$stmtComp2 = mysqli_stmt_init($linkComp2);

$linkComp3 = new_db_connection();
$stmtComp3 = mysqli_stmt_init($linkComp3);

$linkComp4 = new_db_connection();
$stmtComp4 = mysqli_stmt_init($linkComp4);

$linkComp5 = new_db_connection();
$stmtComp5 = mysqli_stmt_init($linkComp5);

$idUser = $_SESSION["idUser"];

//MATCH WITH COMPANIES VACANCIES
$queryMatchComp = "SELECT educ_lvl_ideduc_lvl FROM users WHERE idusers = ?";

$queryMatchComp2 = "SELECT vacancies.idvacancies, vacancies.region_idregion, vacancies.company_id, vacancies.educ_lvl_ideduc_lvl, vacancies.areas_idareas, vacancies_has_capacities.capacities_idcapacities
FROM vacancies
INNER JOIN users ON vacancies.company_id = users.idusers
INNER JOIN users_has_region ON vacancies.company_id = users_has_region.users_idusers
INNER JOIN areas ON vacancies.areas_idareas = areas.idareas
INNER JOIN region ON vacancies.region_idregion = region.idregion
INNER JOIN educ_lvl ON vacancies.educ_lvl_ideduc_lvl = educ_lvl.ideduc_lvl
INNER JOIN vacancies_has_capacities ON vacancies.idvacancies = vacancies_has_capacities.vacancies_idvacancies
WHERE user_type_iduser_type = 7
AND vacancies.areas_idareas IN (SELECT users_has_areas.areas_idareas FROM users_has_areas WHERE users_has_areas.users_idusers = ?)
AND vacancies.region_idregion IN (SELECT users_has_region.region_idregion FROM users_has_region WHERE users_has_region.users_idusers = ?)
AND vacancies_has_capacities.capacities_idcapacities IN (SELECT users_has_capacities.capacities_idcapacities FROM users_has_capacities WHERE users_has_capacities.users_idusers = ?)
AND vacancies.educ_lvl_ideduc_lvl <= ?";

$capacidades_match = [];
$capacidades_pessoa = array();

if (mysqli_stmt_prepare($stmtComp, $queryMatchComp)) {
    mysqli_stmt_bind_param($stmtComp, 'i', $idUser);
    mysqli_stmt_execute($stmtComp);
    mysqli_stmt_bind_result($stmtComp, $ideduc_lvl_person);
    if (mysqli_stmt_fetch($stmtComp)) {

        if (mysqli_stmt_prepare($stmtComp2, $queryMatchComp2)) {
            mysqli_stmt_bind_param($stmtComp2, 'iiii', $idUser, $idUser, $idUser, $ideduc_lvl_person);
            mysqli_stmt_execute($stmtComp2);
            mysqli_stmt_bind_result($stmtComp2, $idvacancies, $region_idregion, $company_id, $educ_lvl_vacancie, $idareas_vacancie, $idcapacities_vacancie);
            while (mysqli_stmt_fetch($stmtComp2)) {
                if (!in_array($idcapacities_vacancie, $capacidades_pessoa)) {
                    array_push($capacidades_pessoa, $idcapacities_vacancie);
                }

                $queryMatchComp6 = "SELECT vacancies_idvacancies, capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_idvacancies = ?";
                if (mysqli_stmt_prepare($stmtComp3, $queryMatchComp6)) {
                    mysqli_stmt_bind_param($stmtComp3, 'i', $idvacancies);
                    mysqli_stmt_execute($stmtComp3);
                    mysqli_stmt_bind_result($stmtComp3, $idvacancies_capacities, $idcapacities_comp);
                    while (mysqli_stmt_fetch($stmtComp3)) {
                        if ($capacidades_match[$idvacancies] === NULL) {
                            $capacidades_match[$idvacancies] = [];
                        }
                        if (!in_array($idcapacities_comp, $capacidades_match[$idvacancies])) {
                            array_push($capacidades_match[$idvacancies], $idcapacities_comp);
                        }
                    }
                }
            }
        }
    }
}

// echo "capacidades match </br>";
// print_r($capacidades_match);
// echo "</br>capacidades pessoa </br>";
// print_r($capacidades_pessoa);

$queryMatchComp3 = "INSERT INTO users_has_vacancies (user_young, vacancies_idvacancies, match_perc)
VALUES (?,?,?)";

$queryMatchComp4 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn)
VALUES (?,?)";

$queryMatchComp5 = "SELECT user_young, vacancies_idvacancies FROM users_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies = ?";

$capacidades_final = $capacidades_match;
foreach ($capacidades_match as $vaga => $capacidades) {
    $capacidades_final[$vaga] = array_diff($capacidades, $capacidades_pessoa);
    // print_r($capacidades_final[$vaga]);

    if (count($capacidades_final[$vaga]) <= 1) {
        //At least 4 capacities are equal to the vacancies capacities aka match
        // echo "</br>É um match completo";

        if (mysqli_stmt_prepare($stmtComp4, $queryMatchComp5)) {
            mysqli_stmt_bind_param($stmtComp4, 'ii', $idUser, $vaga);

            mysqli_stmt_execute($stmtComp4);
            mysqli_stmt_bind_result($stmtComp4, $user_young, $fk_idVacancies);
            if (mysqli_stmt_fetch($stmtComp4)) {
            } else {
                $match_vac = 1;

                //INSERT ON MATCH TABLE
                if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp3)) {
                    mysqli_stmt_bind_param($stmtComp5, 'iii', $idUser, $vaga, $match_vac);
                    if (!mysqli_stmt_execute($stmtComp5)) {
                    }
                }
            }
        }
    } else if (count($capacidades_final[$vaga]) == 2 || count($capacidades_final[$vaga]) == 3) {
        //At least 2 or 3 capacities are equal to the vacancies capacities aka recomendation path
        // echo "</br>É um match para percurso";
        if (mysqli_stmt_prepare($stmtComp4, $queryMatchComp5)) {
            mysqli_stmt_bind_param($stmtComp4, 'ii', $idUser, $vaga);

            mysqli_stmt_execute($stmtComp4);
            mysqli_stmt_bind_result($stmtComp4, $user_young, $fk_idVacancies);
            if (mysqli_stmt_fetch($stmtComp4)) {
            } else {
                $percurso = 0;

                //INSERT ON MATCH TABLE
                if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp3)) {
                    mysqli_stmt_bind_param($stmtComp5, 'iii', $idUser, $vaga, $percurso);

                    if (!mysqli_stmt_execute($stmtComp5)) {
                    } else {
                        $id_percurso = mysqli_insert_id($linkComp5);
                    }
                }
                //INSERT ON RECOMMENDATION TABLE
                if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp4)) {
                    mysqli_stmt_bind_param($stmtComp5, 'ii', $id_percurso, $id_capacidades);

                    foreach ($capacidades_final[$vaga] as $id_capacidades) {
                        if (!mysqli_stmt_execute($stmtComp5)) {
                        }
                    }
                }
            }
        }
    } else if (count($capacidades_final[$vaga]) >= 4) {
        //Less than 2 capacities are equal to the vacancies capacities aka no match
        // echo "</br>Não é match";
    }
}
/*********************************************************************************************************************************/
//MATCH HEIS COURSES
$linkHei = new_db_connection();
$stmtHei = mysqli_stmt_init($linkHei);

$linkHei2 = new_db_connection();
$stmtHei2 = mysqli_stmt_init($linkHei2);

$linkHei3 = new_db_connection();
$stmtHei3 = mysqli_stmt_init($linkHei3);

$queryMatchHei = "SELECT courses.idcourses, courses.users_idusers, courses.region_idregion, courses_has_areas.areas_idareas
FROM courses
INNER JOIN users ON courses.users_idusers = users.idusers
INNER JOIN users_has_region ON courses.users_idusers = users_has_region.users_idusers
INNER JOIN courses_has_areas ON courses.idcourses = courses_has_areas.courses_idcourses
INNER JOIN areas ON courses_has_areas.areas_idareas = areas.idareas
INNER JOIN region ON courses.region_idregion = region.idregion
WHERE user_type_iduser_type = 13
AND courses_has_areas.areas_idareas IN (SELECT users_has_areas.areas_idareas FROM users_has_areas WHERE users_has_areas.users_idusers = ?)
AND courses.region_idregion IN (SELECT users_has_region.region_idregion FROM users_has_region WHERE users_has_region.users_idusers = ?)";

$queryMatchHei2 = "SELECT users_idusers, courses_idcourses FROM users_has_courses WHERE users_idusers = ? AND courses_idcourses = ?";

$queryMatchHei3 = "INSERT INTO users_has_courses (users_idusers, courses_idcourses)
VALUES (?,?)";

if (mysqli_stmt_prepare($stmtHei, $queryMatchHei)) {
    mysqli_stmt_bind_param($stmtHei, 'ii', $idUser, $idUser);
    mysqli_stmt_execute($stmtHei);
    mysqli_stmt_bind_result($stmtHei, $idCourse, $idHei, $regionCourse, $areaCourse);
    while (mysqli_stmt_fetch($stmtHei)) {

        // echo "We've got a match </br>";
        // echo "user: $idUser </br>";
        // echo "Curso: $idCourse </br>";
        if (mysqli_stmt_prepare($stmtHei2, $queryMatchHei2)) {
            mysqli_stmt_bind_param($stmtHei2, 'ii', $idUser, $idCourse);

            mysqli_stmt_execute($stmtHei2);
            mysqli_stmt_bind_result($stmtHei2, $users_person, $fk_course);
            if (mysqli_stmt_fetch($stmtHei2)) {
            } else {
                //INSERT ON MATCH TABLE
                if (mysqli_stmt_prepare($stmtHei3, $queryMatchHei3)) {
                    mysqli_stmt_bind_param($stmtHei3, 'ii', $idUser, $idCourse);
                    if (!mysqli_stmt_execute($stmtHei3)) {
                    }
                }
            }
        }
    }
}
