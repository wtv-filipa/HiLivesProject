<?php
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
