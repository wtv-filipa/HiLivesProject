<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$link2 = new_db_connection();
$stmt2 = mysqli_stmt_init($link2);

$link3 = new_db_connection();
$stmt3 = mysqli_stmt_init($link3);

if (isset($_GET["user"]) && $_SESSION["idUser"]) {
    $idUser = $_GET["user"];
    $id_navegar = $_SESSION["idUser"];

    //General infos users
    $query = "SELECT users.idusers, users.name_user, users.email_user, users.contact_user, users.birth_date, users.work_xp, users.profile_img, user_type.type_user, educ_lvl.name_education
    FROM users 
    INNER JOIN user_type ON users.user_type_iduser_type = user_type.iduser_type
    INNER JOIN educ_lvl ON users.educ_lvl_ideduc_lvl = educ_lvl.ideduc_lvl
    WHERE idusers = ?";

    //Areas
    $query2 = "SELECT users_has_areas.areas_idareas, areas.name_interested_area
    FROM users_has_areas 
    INNER JOIN areas ON users_has_areas.areas_idareas = areas.idareas
    WHERE users_idusers = ?";

    //Done courses
    $query3 = "SELECT iddone_cu, cu_name, university_name, date_cu
    FROM done_cu 
    WHERE users_idusers = ? 
    ORDER BY date_cu DESC";

    //Regions
    $query4 = "SELECT name_region 
    FROM region 
    INNER JOIN users_has_region ON region.idregion = users_has_region.region_idregion 
    WHERE users_has_region.users_idusers = ?";

    //Capacities
    $query5 = "SELECT capacities_idcapacities, users_idusers, capacity 
    FROM users_has_capacities 
    INNER JOIN capacities ON users_has_capacities.capacities_idcapacities= capacities.idcapacities
    WHERE users_idusers = ?";

    //Experiences
    $query6 = "SELECT idexperiences, description, date, xp_type, content_idcontent, idContent, content_name
    FROM experiences
    LEFT JOIN content ON experiences.content_idcontent = content.idcontent
    WHERE experiences.users_idusers = ?
    ORDER BY idexperiences DESC";

    //Environments
    $query8 = "SELECT work_environment_idwork_environment, name_environment 
    FROM users_has_work_environment
    INNER JOIN work_environment ON users_has_work_environment.work_environment_idwork_environment = work_environment.idwork_environment
    WHERE users_has_work_environment.users_idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idusers, $name_user, $email_user, $contact_user, $birth_date, $work_xp, $profile_img, $type_user, $name_education);
        while (mysqli_stmt_fetch($stmt)) {
            $dob = $birth_date;
            $age = (date('Y') - date('Y', strtotime($dob)));
?>
            <div class="container">

                <div class="row">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="homePerson.php">Página Inicial</a></li>
                            <li class="breadcrumb-item active" aria-current="page">A minha área</li>
                        </ol>
                    </nav>

                    <div class="marginButtonProfile col-12 col-md-6 text-sm-start text-md-end">
                        <a class="buttonEdit" href="editProfile.php?edit=<?= $idUser ?>" title="Ir para a edição do dados do perfil">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square align-middle" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            <span class="ps-2 pe-3 align-middle textEdit">Editar Perfil </span>
                        </a>
                        <a class="buttonEdit" href="../../scripts/logout.php" title="Terminar sessão">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right align-middle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            <span class="ps-1 align-middle textEdit">Terminar sessão</span>
                        </a>
                    </div>
                </div>

                <?php
                if (isset($_SESSION["profile"])) {
                    $msg_show = true;
                    switch ($_SESSION["profile"]) {
                        case 1:
                            $message = "Curso/Unidade Curricular editado com sucesso";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 2:
                            $message = "Carregamento da história concluído!";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 3:
                            $message = "Carregamento do Curso/Unidade Curricula concluído!";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 4:
                            $message = "História editada com sucesso!";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 5:
                            $message = "Ocorreu um erro a processar o teu pedido, por favor tenta novamente mais tarde.";
                            $class = "alert-warning";
                            $_SESSION["profile"] = 0;
                            break;
                        case 6:
                            $message = "Curso/Unidade Curricular eliminado com sucesso!";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 7:
                            $message = "História eliminada com sucesso!";
                            $class = "alert-success";
                            $_SESSION["profile"] = 0;
                            break;
                        case 0:
                            $msg_show = false;
                            break;
                        default:
                            $msg_show = false;
                            $_SESSION["profile"] = 0;
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

                <section class="text-center pt-5 pb-3">
                    <?php
                    if (isset($profile_img)) {
                    ?>
                        <img class="imgProfile mb-4" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" title="Imagem de perfil de <?= $name_user ?>" />
                    <?php
                    } else {
                    ?>
                        <img class="imgProfile mb-4" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem de perfil padrão" />
                    <?php
                    }
                    ?>
                    <h1 class="pb-2"><?= $name_user ?> | <?= $age ?> anos</h1>
                    <p>Regiões de interesse:
                        <?php
                        $first = true;
                        if (mysqli_stmt_prepare($stmt2, $query4)) {
                            mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $name_region);
                            while (mysqli_stmt_fetch($stmt2)) {
                                if (!$first) {
                                    echo ",";
                                }
                                $first = false;
                                echo " $name_region";
                            }
                            mysqli_stmt_close($stmt2);
                        }
                        ?>
                    </p>
                </section>

                <section class="pb-5">
                    <ul class="nav nav-tabs nav-fill profileTabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="studies-tab" data-bs-toggle="tab" data-bs-target="#studies" type="button" role="tab" aria-controls="studies" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard align-middle" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Estudos</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="areas-tab" data-bs-toggle="tab" data-bs-target="#areas" type="button" role="tab" aria-controls="areas" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal align-middle" viewBox="0 0 16 16">
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Áreas</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab" aria-controls="skills" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check align-middle" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Competências</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="env-tab" data-bs-toggle="tab" data-bs-target="#env" type="button" role="tab" aria-controls="env" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building align-middle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Ambientes</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="stories-tab" data-bs-toggle="tab" data-bs-target="#stories" type="button" role="tab" aria-controls="stories" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video align-middle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z" />
                                </svg>
                                <span class="ps-2 align-middle textHideSmall">Histórias</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!--STUDY-->
                        <div class="tab-pane fade show active" id="studies" role="tabpanel" aria-labelledby="studies-tab">
                            <div class="pt-4">
                                <h4>Nível de estudos</h4>
                                <p><?= $name_education ?></p>
                            </div>
                            <div class="row pt-3">
                                <h4 class="pb-3">Cursos/ Unidades curriculares feitos</h4>
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query3)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $iddone_cu, $cu_name, $university_name, $date_cu);
                                    mysqli_stmt_store_result($stmt2);
                                    if (mysqli_stmt_num_rows($stmt2) > 0) {
                                        while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                            <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                                                <div class="items itemsStudy itemsBigger">
                                                    <h5><?= $cu_name ?></h5>
                                                    <p class="cardInfo14 mb-2"><?= $university_name ?></p>
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <p class="cardInfo13 mb-0"><?= $date_cu ?></p>
                                                        </div>
                                                        <div class="col-4 text-end">
                                                            <a href="editCourse.php?uc=<?= $iddone_cu ?>" class="linkIconsStudy" title="Editar o curso/UC <?= $cu_name ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-3" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                                </svg>
                                                            </a>

                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCourse<?= $iddone_cu ?>" class="linkIconsStudy" title="Eliminar o curso/UC <?= $cu_name ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            include('../components/deleteModal.php');
                                        }
                                    } else {
                                        ?>
                                        <section class="row justify-content-center">
                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                <div class="card text-center shadowCard o-hidden border-0">
                                                    <div class="card-body  pt-5 pb-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-x-circle mb-3" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                        <p class="mx-auto" style="font-size: 1rem;">
                                                            Neste momento não tens nenhum Curso/ Unidade Curricular adicionado.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </div>

                            <div class="text-center pt-4">
                                <a href="uploadCourse.php" title="Adicionar um curso ou unidade curricular">
                                    <button class="btn buttonDesign buttonStudy buttonRegisterSizeHEI m-0">Adicionar novos estudos</button>
                                </a>
                            </div>

                        </div>

                        <!--AREAS-->
                        <div class="tab-pane fade" id="areas" role="tabpanel" aria-labelledby="areas-tab">
                            <div class="row pt-4">
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $areas_idareas, $name_interested_area);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                                            <div class="items itemsStudy itemsSmaller">
                                                <p class="mb-0"><?= $name_interested_area ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </div>
                        </div>

                        <!--SKILLS-->
                        <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
                            <div class="row pt-4">
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query5)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $capacities_idcapacities, $users_idusers, $capacity);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                                            <div class="items itemsWork itemsSmaller">
                                                <p class="mb-0"><?= $capacity ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </div>
                        </div>

                        <!--ENVIRONMENTS-->
                        <div class="tab-pane fade" id="env" role="tabpanel" aria-labelledby="env-tab">
                            <div class="row pt-4">
                                <?php
                                $stmt2 = mysqli_stmt_init($link2);
                                if (mysqli_stmt_prepare($stmt2, $query8)) {
                                    mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $work_environment_idwork_environment, $name_environment);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                        <div id="cardInfo" class="col-12 col-md-6 col-lg-4 pb-3">
                                            <div class="items itemsWork itemsSmaller">
                                                <p class="mb-0"><?= $name_environment ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                    mysqli_stmt_close($stmt2);
                                }
                                ?>
                            </div>
                        </div>

                        <!--STORIES-->
                        <div class="tab-pane fade" id="stories" role="tabpanel" aria-labelledby="stories-tab">
                            <div class="text-center pt-4">
                                <a href="uploadStory.php" title="Adicionar uma nova história à HiLives">
                                    <button class="btn buttonDesign buttonWork buttonRegisterSizeHEI m-0">Adicionar uma história</button>
                                </a>
                            </div>
                            <?php
                            $stmt2 = mysqli_stmt_init($link2);
                            if (mysqli_stmt_prepare($stmt2, $query6)) {
                                mysqli_stmt_bind_param($stmt2, 'i', $idUser);
                                mysqli_stmt_execute($stmt2);
                                mysqli_stmt_bind_result($stmt2, $idexperiences, $description, $date, $xp_type, $content_idcontent, $idContent, $content_name);
                                mysqli_stmt_store_result($stmt2);
                                if (mysqli_stmt_num_rows($stmt2) > 0) {
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        $data = substr($date, 0, 10);
                                        $newDate = date("d-m-Y", strtotime($data));
                            ?>

                                        <div class="wrapperStory">
                                            <div class="row">
                                                <header class="cf col-10">
                                                    <a href="profile.php?user=<?= $idUser ?>" title="Perfil de <?= $name_user ?>">
                                                        <?php
                                                        if (isset($profile_img)) {
                                                        ?>
                                                            <img class="profile-pic" src="../../../admin/uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" title="Imagem de perfil de <?= $name_user ?>" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img class="profile-pic" src="../../img/no_profile_img.png" alt="sem imagem de perfil" title="Imagem de perfil padrão" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </a>
                                                    <h5 class="name">
                                                        <a href="profile.php?user=<?= $idUser ?>" class="linkStory"><?= $name_user ?> </a>
                                                    </h5>
                                                    <p class="cardInfo13"><?= $newDate ?></p>
                                                </header>

                                                <div class="col-2 text-end">
                                                    <a href="editStory.php?edit=<?= $idexperiences ?>" class="linkIcons" title="Editar história">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-3" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                    </a>

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteStory<?= $idexperiences ?>" class="linkIcons" title="Eliminar a história">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            //VIDEO
                                            if ($xp_type == "video") {
                                                if (isset($description)) {
                                            ?>
                                                    <p class="status"><?= $description ?></p>
                                                <?php
                                                }
                                                ?>
                                                <div class="text-center videoStory">
                                                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half p-0 mt-5 videoSize">
                                                        <video class="embed-responsive-item" src="../../../admin/uploads/experiences/<?= $content_name ?>" controls="controls"></video>
                                                    </div>
                                                </div>
                                                <?php
                                                //AUDIO
                                            } else if ($xp_type == "audio") {
                                                if (isset($description)) {
                                                ?>
                                                    <p class="status"><?= $description ?></p>
                                                <?php
                                                }
                                                ?>
                                                <div class="text-center">
                                                    <audio controls>
                                                        <source src="../../../admin/uploads/experiences/<?= $content_name ?>" type="audio/ogg">
                                                        <source src="../../../admin/uploads/experiences/<?= $content_name ?>" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                                <?php
                                                //IMAGE
                                            } else if ($xp_type == "image") {
                                                if (isset($description)) {
                                                ?>
                                                    <p class="status"><?= $description ?></p>
                                                <?php
                                                }
                                                ?>
                                                <div class="text-center videoSize">
                                                    <img class="img-content img-fluid" src="../../../admin/uploads/experiences/<?= $content_name ?>" />
                                                </div>
                                            <?php
                                            } else if ($xp_type == "text" && isset($description)) {
                                            ?>
                                                <p class="status"><?= $description ?></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                        include('../components/deleteModal.php');
                                    }
                                } else {
                                    ?>
                                    <section class="row justify-content-center mt-4">
                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <div class="card text-center shadowCard o-hidden border-0">
                                                <div class="card-body  pt-5 pb-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-x-circle mb-3" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg>
                                                    <p class="mx-auto" style="font-size: 1rem;">
                                                        Neste momento não tens nenhuma história adicionada.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </section>

            </div>
<?php
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    mysqli_close($link2);
} else {
    include("404.php");
}
