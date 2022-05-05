<?php
//MATCH PERSONS WITH COURSES
$linkHei = new_db_connection();
$stmtHei = mysqli_stmt_init($linkHei);

$linkHei2 = new_db_connection();
$stmtHei2 = mysqli_stmt_init($linkHei2);

$linkHei3 = new_db_connection();
$stmtHei3 = mysqli_stmt_init($linkHei3);

$linkHei4 = new_db_connection();
$stmtHei4 = mysqli_stmt_init($linkHei4);

$idUser = $_SESSION["idUser"];

$queryMatchHei = "SELECT users.idusers, users_has_region.region_idregion, users_has_areas.areas_idareas
FROM users
INNER JOIN users_has_region ON users.idusers = users_has_region.users_idusers
INNER JOIN users_has_areas ON users.idusers = users_has_areas.users_idusers
INNER JOIN areas ON users_has_areas.areas_idareas = areas.idareas
INNER JOIN region ON users_has_region.region_idregion = region.idregion
WHERE user_type_iduser_type = 10
AND users_has_areas.areas_idareas IN (SELECT courses_has_areas.areas_idareas FROM courses_has_areas WHERE courses_has_areas.courses_idcourses = ?)
AND users_has_region.region_idregion IN (SELECT courses.region_idregion FROM courses WHERE courses.idcourses = ?)";

$queryMatchHei2 = "SELECT users_idusers, courses_idcourses FROM users_has_courses WHERE users_idusers = ? AND courses_idcourses = ?";

$queryMatchHei3 = "INSERT INTO users_has_courses (users_idusers, courses_idcourses)
VALUES (?,?)";

$queryMatchHei4 = "SELECT idcourses FROM courses WHERE users_idusers = ?";

//FIRST WE SELECT THE COURSES SO QUE CAN HAVE DE ID'S
if (mysqli_stmt_prepare($stmtHei4, $queryMatchHei4)) {
    mysqli_stmt_bind_param($stmtHei4, 'i', $idUser);
    mysqli_stmt_execute($stmtHei4);
    mysqli_stmt_bind_result($stmtHei4, $idCoursesHei);
    while (mysqli_stmt_fetch($stmtHei4)) {
        //THEN WE PROCEED TO THE MATCH LOGIC
        // echo "uni I'm here </br>";
        if (mysqli_stmt_prepare($stmtHei, $queryMatchHei)) {
            mysqli_stmt_bind_param($stmtHei, 'ii', $idCoursesHei, $idCoursesHei);
            mysqli_stmt_execute($stmtHei);
            mysqli_stmt_bind_result($stmtHei, $idPerson, $regionPerson, $areaPerson);
            while (mysqli_stmt_fetch($stmtHei)) {

                // echo "We've got a match </br>";
                // echo "user: $idPerson </br>";
                // echo "Curso: $idCoursesHei </br>";
                if (mysqli_stmt_prepare($stmtHei2, $queryMatchHei2)) {
                    mysqli_stmt_bind_param($stmtHei2, 'ii', $idPerson, $idCoursesHei);

                    mysqli_stmt_execute($stmtHei2);
                    mysqli_stmt_bind_result($stmtHei2, $users_person, $fk_course);
                    if (mysqli_stmt_fetch($stmtHei2)) {
                    } else {
                        //INSERT ON MATCH TABLE
                        if (mysqli_stmt_prepare($stmtHei3, $queryMatchHei3)) {
                            mysqli_stmt_bind_param($stmtHei3, 'ii', $idPerson, $idCoursesHei);
                            if (!mysqli_stmt_execute($stmtHei3)) {
                            }
                        }
                    }
                }
            }
        }
    }
}
