<?php
session_start();
if (isset($_GET["apaga"])) {
    $idUser = $_GET["apaga"];
    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);

    $link3 = new_db_connection();
    $stmt3 = mysqli_stmt_init($link3);

    $link4 = new_db_connection();
    $stmt4 = mysqli_stmt_init($link4);


    $query = "SELECT type_user 
    FROM user_type 
    INNER JOIN users ON user_type.iduser_type = users.user_type_iduser_type 
    WHERE idusers = ?";

    $query2 = "DELETE FROM users 
    WHERE idusers = ?";

    $query3 = "DELETE FROM content 
    WHERE users_idusers = ?";

    $query4 = "DELETE FROM users_has_region 
    WHERE users_idusers = ?";

    $query5 = "DELETE FROM users_has_areas
    WHERE users_idusers = ?";

    $query6 = "SELECT profile_img 
    FROM users 
    WHERE idusers = ?";

    $query7 = "SELECT content_name 
    FROM content 
    WHERE users_idusers = ?";

    $query20 = "DELETE FROM learning_path_capacities 
    WHERE fk_match_vac = ?";

    /**********************************************************/

    $query8 = "DELETE FROM users_has_capacities 
    WHERE users_idusers = ?";

    $query9 = "DELETE FROM done_cu 
    WHERE users_idusers = ?";

    $query10 = "DELETE FROM experiences 
    WHERE users_idusers = ?";

    $query11 = "DELETE FROM users_has_vacancies 
    WHERE user_young = ?";

    $query12 = "DELETE FROM users_has_work_environment 
    WHERE users_idusers = ?";

    $query13 = "DELETE FROM users_has_courses 
    WHERE users_idusers = ?";

    $query19 = "SELECT id_match_vac 
    FROM users_has_vacancies 
    WHERE user_young = ?";
    /**********************************************************/

    $query14 = "DELETE FROM vacancies 
    WHERE company_id = ?";

    $query15 = "SELECT idvacancies 
    FROM vacancies 
    WHERE company_id = ?";

    $query16 = "DELETE FROM vacancies_has_capacities 
    WHERE vacancies_idvacancies = ?";

    $query17 = "DELETE FROM users_has_vacancies 
    WHERE vacancies_idvacancies = ?";

    $query21 = "SELECT id_match_vac 
    FROM users_has_vacancies 
    WHERE vacancies_idvacancies = ?";
    /**********************************************************/

    $query18 = "DELETE FROM courses 
    WHERE users_idusers = ?";

    $query22 = "SELECT idcourses 
    FROM courses 
    WHERE users_idusers = ?";

    $query23 = "DELETE FROM courses_has_areas 
    WHERE courses_idcourses = ?";

    $query24 = "DELETE FROM users_has_courses 
    WHERE courses_idcourses = ?";
    /**********************************************************/
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $type_user);
        while (mysqli_stmt_fetch($stmt)) {

            if ($type_user == "Pessoa") {

                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query5)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../uploads/experiences/" . $content_name;
                        if (!unlink($xp)) {
                            header("Location: ../users_jovem.php");
                            $_SESSION["jovem"] = 2;
                        } else {

                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);
                                if (!mysqli_stmt_execute($stmt3)) {
                                    header("Location: ../users_jovem.php");
                                    $_SESSION["jovem"] = 2;
                                }
                            } else {
                                header("Location: ../users_jovem.php");
                                $_SESSION["jovem"] = 2;
                            }
                        }
                    }
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            if (!unlink($img)) {
                                header("Location: ../users_jovem.php");
                                $_SESSION["jovem"] = 2;
                            }
                        }
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query8)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query9)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query19)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $id_match_vac);
                    while (mysqli_stmt_fetch($stmt2)) {

                        if (mysqli_stmt_prepare($stmt3, $query20)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $id_match_vac);

                            if (!mysqli_stmt_execute($stmt3)) {
                                header("Location: ../users_jovem.php");
                                $_SESSION["jovem"] = 2;
                            }
                        } else {
                            header("Location: ../users_jovem.php");
                            $_SESSION["jovem"] = 2;
                        }
                        /**********************************************************/

                        if (mysqli_stmt_prepare($stmt3, $query11)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idUser);

                            if (!mysqli_stmt_execute($stmt3)) {
                                header("Location: ../users_jovem.php");
                                $_SESSION["jovem"] = 2;
                            }
                        } else {
                            header("Location: ../users_jovem.php");
                            $_SESSION["jovem"] = 2;
                        }
                        /**********************************************************/
                    }
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query12)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query13)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_jovem.php");
                        $_SESSION["jovem"] = 2;
                    }
                } else {
                    header("Location: ../users_jovem.php");
                    $_SESSION["jovem"] = 2;
                }
                //SUCESS
                header("Location: ../users_jovem.php");
                $_SESSION["jovem"] = 4;
                /**********************************************************/
            } else if ($type_user == "Empresa") {

                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_emp.php");
                        $_SESSION["emp"] = 2;
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            if (!unlink($img)) {
                                header("Location: ../users_emp.php");
                                $_SESSION["emp"] = 2;
                            }
                        }
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
                /**********************************************************/
                if (mysqli_stmt_prepare($stmt2, $query15)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $idVacancies);
                    while (mysqli_stmt_fetch($stmt2)) {
                        //APAGAR capacidades
                        if (mysqli_stmt_prepare($stmt3, $query16)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                header("Location: ../users_emp.php");
                                $_SESSION["emp"] = 2;
                            }
                        } else {
                            header("Location: ../users_emp.php");
                            $_SESSION["emp"] = 2;
                        }
                        /*****/

                        if (mysqli_stmt_prepare($stmt3, $query21)) {

                            mysqli_stmt_bind_param($stmt3, 'i', $idVacancies);
                            mysqli_stmt_execute($stmt3);
                            mysqli_stmt_bind_result($stmt3, $id_match_vac);
                            while (mysqli_stmt_fetch($stmt3)) {

                                if (mysqli_stmt_prepare($stmt4, $query20)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $id_match_vac);

                                    if (!mysqli_stmt_execute($stmt4)) {
                                        header("Location: ../users_emp.php");
                                        $_SESSION["emp"] = 2;
                                    }
                                } else {
                                    header("Location: ../users_emp.php");
                                    $_SESSION["emp"] = 2;
                                }
                                /*****/
                                if (mysqli_stmt_prepare($stmt4, $query17)) {
                                    mysqli_stmt_bind_param($stmt4, 'i', $idVacancies);

                                    if (!mysqli_stmt_execute($stmt4)) {
                                        header("Location: ../users_emp.php");
                                        $_SESSION["emp"] = 2;
                                    }
                                } else {
                                    header("Location: ../users_emp.php");
                                    $_SESSION["emp"] = 2;
                                }
                                /*****/
                            }
                        }
                        /***********************************/
                    }
                }

                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../uploads/experiences/" . $content_name;
                        if (!unlink($xp)) {
                            header("Location: ../users_emp.php");
                            $_SESSION["emp"] = 2;
                        } else {

                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);

                                if (!mysqli_stmt_execute($stmt3)) {
                                    header("Location: ../users_emp.php");
                                    $_SESSION["emp"] = 2;
                                }
                            } else {
                                header("Location: ../users_emp.php");
                                $_SESSION["emp"] = 2;
                            }
                        }
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_emp.php");
                        $_SESSION["emp"] = 2;
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt3, $query14)) {
                    mysqli_stmt_bind_param($stmt3, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt3)) {
                        header("Location: ../users_emp.php");
                        $_SESSION["emp"] = 2;
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_emp.php");
                        $_SESSION["emp"] = 2;
                    }
                } else {
                    header("Location: ../users_emp.php");
                    $_SESSION["emp"] = 2;
                }

                header("Location: ../users_emp.php");
                $_SESSION["emp"] = 4;
                /**********************************************************/
            } else if ($type_user == "Universidade") {

                echo "apagar Universidade <br>";

                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_uni.php");
                        $_SESSION["uni"] = 2;
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query7)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $content_name);
                    while (mysqli_stmt_fetch($stmt2)) {
                        $xp = "../uploads/experiences/" . $content_name;
                        if (!unlink($xp)) {
                            header("Location: ../users_uni.php");
                            $_SESSION["uni"] = 2;
                        } else {

                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'i', $idUser);

                                if (!mysqli_stmt_execute($stmt3)) {
                                    header("Location: ../users_uni.php");
                                    $_SESSION["uni"] = 2;
                                }
                            } else {
                                header("Location: ../users_uni.php");
                                $_SESSION["uni"] = 2;
                            }
                        }
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query10)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_uni.php");
                        $_SESSION["uni"] = 2;
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query6)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $profile_img);
                    while (mysqli_stmt_fetch($stmt2)) {
                        if (isset($profile_img)) {
                            $img = "../uploads/img_perfil/" . $profile_img;
                            if (!unlink($img)) {
                                header("Location: ../users_uni.php");
                                $_SESSION["uni"] = 2;
                            }
                        }
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }
                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query22)) {

                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $idcourses);
                    while (mysqli_stmt_fetch($stmt2)) {
                        //APAGAR capacidades
                        if (mysqli_stmt_prepare($stmt3, $query23)) {
                            mysqli_stmt_bind_param($stmt3, 'i', $idcourses);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                header("Location: ../users_uni.php");
                                $_SESSION["uni"] = 2;
                            }
                        } else {
                            header("Location: ../users_uni.php");
                            $_SESSION["uni"] = 2;
                        }
                        /*****/

                        if (mysqli_stmt_prepare($stmt3, $query24)) {

                            mysqli_stmt_bind_param($stmt3, 'i', $idcourses);
                            // VALIDAÇÃO DO RESULTADO DO EXECUTE
                            if (!mysqli_stmt_execute($stmt3)) {
                                header("Location: ../users_uni.php");
                                $_SESSION["uni"] = 2;
                            }
                        } else {
                            header("Location: ../users_uni.php");
                            $_SESSION["uni"] = 2;
                        }
                        /***********************************/
                    }
                }

                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query18)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_uni.php");
                        $_SESSION["uni"] = 2;
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }

                /**********************************************************/

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_uni.php");
                        $_SESSION["uni"] = 2;
                    }
                } else {
                    header("Location: ../users_uni.php");
                    $_SESSION["uni"] = 2;
                }

                header("Location: ../users_uni.php");
                $_SESSION["uni"] = 4;
                /**********************************************************/
            } else if ($type_user == "Tutor") {
                if (mysqli_stmt_prepare($stmt2, $query4)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_tutor.php");
                        $_SESSION["tutor"] = 2;
                    }
                } else {
                    header("Location: ../users_tutor.php");
                    $_SESSION["tutor"] = 2;
                }

                /***************************************/

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);

                    if (!mysqli_stmt_execute($stmt2)) {
                        header("Location: ../users_tutor.php");
                        $_SESSION["tutor"] = 2;
                    }
                } else {
                    header("Location: ../users_tutor.php");
                    $_SESSION["tutor"] = 2;
                }
                //SUCESS
                header("Location: ../users_tutor.php");
                $_SESSION["tutor"] = 4;
            }
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
            mysqli_close($link);
            mysqli_close($link2);
            mysqli_close($link3);
        }
    }
} else {
    header("Location: ../index.php");
    $_SESSION["cont_emp"] = 1;
}
