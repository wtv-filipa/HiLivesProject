<?php
//MATCH PERSONS WITH VACANCIES
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

$queryMatchComp = "SELECT idvacancies, educ_lvl_ideduc_lvl FROM vacancies
WHERE company_id = ?";

$queryMatchComp2 = "SELECT users.idusers, users.educ_lvl_ideduc_lvl, users_has_region.region_idregion, users_has_areas.areas_idareas, users_has_capacities.capacities_idcapacities
FROM users
INNER JOIN users_has_region ON users.idusers = users_has_region.users_idusers
INNER JOIN users_has_areas ON users.idusers = users_has_areas.users_idusers
INNER JOIN areas ON users_has_areas.areas_idareas = areas.idareas
INNER JOIN region ON users_has_region.region_idregion = region.idregion
INNER JOIN educ_lvl ON users.educ_lvl_ideduc_lvl = educ_lvl.ideduc_lvl
INNER JOIN users_has_capacities ON users.idusers = users_has_capacities.users_idusers
WHERE  user_type_iduser_type = 10
AND users_has_areas.areas_idareas IN (SELECT vacancies.areas_idareas FROM vacancies WHERE vacancies.idvacancies = ?)
AND users_has_region.region_idregion IN (SELECT vacancies.region_idregion FROM vacancies WHERE vacancies.idvacancies = ?)
AND users_has_capacities.capacities_idcapacities IN (SELECT vacancies_has_capacities.capacities_idcapacities FROM vacancies_has_capacities WHERE vacancies_has_capacities.vacancies_idvacancies = ?)
AND users.educ_lvl_ideduc_lvl >= ?";

$capacidades_pessoas = [];
$capacidades_vaga = [];

if (mysqli_stmt_prepare($stmtComp, $queryMatchComp)) {
    mysqli_stmt_bind_param($stmtComp, 'i', $idUser);
    mysqli_stmt_execute($stmtComp);
    mysqli_stmt_bind_result($stmtComp, $idvacanciesComp, $ideduc_lvl_company);
    if (mysqli_stmt_fetch($stmtComp)) {

        if (mysqli_stmt_prepare($stmtComp2, $queryMatchComp2)) {
            mysqli_stmt_bind_param($stmtComp2, 'iiii', $idvacanciesComp, $idvacanciesComp, $idvacanciesComp, $ideduc_lvl_company);
            mysqli_stmt_execute($stmtComp2);
            mysqli_stmt_bind_result($stmtComp2, $idUserPerson, $educ_lvl_person, $idregionPerson, $idareas_person, $idcapacities_person);
            while (mysqli_stmt_fetch($stmtComp2)) {
                if ($capacidades_pessoas[$idUserPerson] === NULL) {
                    $capacidades_pessoas[$idUserPerson] = [];
                }
                if (!in_array($idcapacities_person, $capacidades_pessoas[$idUserPerson])) {
                    array_push($capacidades_pessoas[$idUserPerson], $idcapacities_person);
                }
                // if (!in_array($idcapacities_person, $capacidades_comp)) {
                //     array_push($capacidades_comp, $idcapacities_person);
                // }

                // $queryMatchComp6 = "SELECT users_idusers, capacities_idcapacities FROM users_has_capacities WHERE users_idusers = ?";
                // if (mysqli_stmt_prepare($stmtComp3, $queryMatchComp6)) {
                //     mysqli_stmt_bind_param($stmtComp3, 'i', $idUserPerson);
                //     mysqli_stmt_execute($stmtComp3);
                //     mysqli_stmt_bind_result($stmtComp3, $idperson_capacities, $idcapacities_person);
                //     while (mysqli_stmt_fetch($stmtComp3)) {
                //         if ($capacidades_match[$idUserPerson] === NULL) {
                //             $capacidades_match[$idUserPerson] = [];
                //         }
                //         if (!in_array($idcapacities_person, $capacidades_match[$idUserPerson])) {
                //             array_push($capacidades_match[$idUserPerson], $idcapacities_person);
                //         }
                //     }
                // }
            }
        }
    }
}

$queryMatchComp6 = "SELECT vacancies_idvacancies, capacities_idcapacities 
FROM vacancies_has_capacities 
WHERE vacancies_idvacancies = ?";

if (mysqli_stmt_prepare($stmtComp3, $queryMatchComp6)) {
    mysqli_stmt_bind_param($stmtComp3, 'i', $idvacanciesComp);
    mysqli_stmt_execute($stmtComp3);
    mysqli_stmt_bind_result($stmtComp3, $idVagas, $capacities_comp);
    while (mysqli_stmt_fetch($stmtComp3)) {
        if ($capacidades_vaga[$idVagas] === NULL) {
            $capacidades_vaga[$idVagas] = [];
        }
        if (!in_array($capacities_comp, $capacidades_vaga[$idVagas])) {
            array_push($capacidades_vaga[$idVagas], $capacities_comp);
        }
    }
}

echo "capacidades match </br>";
print_r($capacidades_pessoas);
echo "</br>capacidades vaga </br>";
print_r($capacidades_vaga);

$queryMatchComp3 = "INSERT INTO users_has_vacancies (user_young, vacancies_idvacancies, match_perc)
VALUES (?,?,?)";

$queryMatchComp4 = "INSERT INTO learning_path_capacities (fk_match_vac, missing_learn)
VALUES (?,?)";

$queryMatchComp5 = "SELECT user_young, vacancies_idvacancies FROM users_has_vacancies WHERE User_young = ? AND Vacancies_idVacancies = ?";

$capacidades_final = $capacidades_pessoas;
foreach ($capacidades_vaga as $vaga => $capacidades) {
    foreach ($capacidades_pessoas as $pessoa => $capacidades_pessoa) {
        $capacidades_final[$pessoa] = array_diff($capacidades, $capacidades_pessoa);
        // echo "</br>";
        // echo "</br> Capacidades final: ";
        // print_r($capacidades_final);
        // echo "</br>";

        if (count($capacidades_final[$pessoa]) <= 1) {
            //At least 4 capacities are equal to the vacancies capacities aka match
            echo "</br>É um match completo ";
            echo " com a vaga: $idvacanciesComp e a pessoa: $pessoa";

            if (mysqli_stmt_prepare($stmtComp4, $queryMatchComp5)) {
                mysqli_stmt_bind_param($stmtComp4, 'ii', $pessoa, $idvacanciesComp);

                mysqli_stmt_execute($stmtComp4);
                mysqli_stmt_bind_result($stmtComp4, $user_young, $fk_idVacancies);
                if (mysqli_stmt_fetch($stmtComp4)) {
                } else {
                    $match_vac = 0;

                    //INSERT ON MATCH TABLE
                    if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp3)) {
                        mysqli_stmt_bind_param($stmtComp5, 'iii', $pessoa, $idvacanciesComp, $match_vac);
                        if (!mysqli_stmt_execute($stmtComp5)) {
                        }
                    }
                }
            }
        } else if (count($capacidades_final[$pessoa]) == 2 || count($capacidades_final[$pessoa]) == 3) {
            //At least 2 or 3 capacities are equal to the vacancies capacities aka recomendation path
            echo "</br>É um match para percurso";
            echo " com a vaga: $idvacanciesComp e a pessoa: $pessoa";
            if (mysqli_stmt_prepare($stmtComp4, $queryMatchComp5)) {
                mysqli_stmt_bind_param($stmtComp4, 'ii', $pessoa, $idvacanciesComp);

                mysqli_stmt_execute($stmtComp4);
                mysqli_stmt_bind_result($stmtComp4, $user_young, $fk_idVacancies);
                if (mysqli_stmt_fetch($stmtComp4)) {
                } else {
                    $percurso = 1;

                    //INSERT ON MATCH TABLE
                    if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp3)) {
                        mysqli_stmt_bind_param($stmtComp5, 'iii', $pessoa, $idvacanciesComp, $percurso);

                        if (!mysqli_stmt_execute($stmtComp5)) {
                        } else {
                            $id_percurso = mysqli_insert_id($linkComp5);
                        }
                    }
                    //INSERT ON RECOMMENDATION TABLE
                    if (mysqli_stmt_prepare($stmtComp5, $queryMatchComp4)) {
                        mysqli_stmt_bind_param($stmtComp5, 'ii', $id_percurso, $id_capacidades);

                        foreach ($capacidades_final[$pessoa] as $id_capacidades) {
                            if (!mysqli_stmt_execute($stmtComp5)) {
                            }
                        }
                    }
                }
            }
        } else if (count($capacidades_final[$pessoa]) >= 4) {
            //Less than 2 capacities are equal to the vacancies capacities aka no match
            echo "</br>Não é match";
            echo " com a pessoa: $pessoa";
        }
    }
}
