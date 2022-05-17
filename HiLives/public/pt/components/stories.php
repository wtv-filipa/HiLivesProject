<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"]) && isset($_SESSION["type"])) {
    $id_navegar = $_SESSION["idUser"];
    $User_type = $_SESSION["type"];

    $query = "SELECT experiences.idexperiences, experiences.description, experiences.date, experiences.xp_type, experiences.content_idcontent, content.idContent, content.content_name, users.idusers, users.name_user, users.profile_img, users.user_type_iduser_type
    FROM experiences
    LEFT JOIN content ON experiences.content_idcontent = content.idcontent
    INNER JOIN users ON experiences.users_idusers = users.idusers
    ORDER BY idexperiences DESC";
?>
    <nav class="navbar navbar-light navBgColor sticky-top">
        <div class="container">
            <span class="navbar-text navstories">
                <a href="uploadStory.php" title="Adicionar uma nova história">
                    Criar uma história
                    <i class="fa-solid fa-angle-right arrowRight"></i>
                </a>
            </span>
        </div>
    </nav>

    <div class="container pb-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4 col-md-6">
            <ol class="breadcrumb">
                <?php
                if ($User_type == 7) {
                ?>
                <li class="breadcrumb-item"><a href="homeComp.php" title="Voltar à página inicial">Página Inicial</a></li>
                <?php
                } else if ($User_type == 10) {
                ?>
                <li class="breadcrumb-item"><a href="homePerson.php" title="Voltar à página inicial">Página Inicial</a></li>
                <?php
                } else if ($User_type == 13) {
                ?>
                <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
                <?php
                } else if ($User_type == 16) {
                ?>
                <li class="breadcrumb-item"><a href="homeTutor.php" title="Voltar à página inicial">Página Inicial</a></li>
                <?php
                }
                ?>
                <li class="breadcrumb-item active" aria-current="page">Histórias do HiLives</li>
            </ol>
        </nav>

        <h1 class="pb-2">Histórias do HiLives</h1>
        <?php
        if ($User_type == 10) {
            echo "<p>Aqui, vais encontrar vídeos, fotografias, áudios e textos que demonstram como foram as experiências académicas e profissionais de outros utilizadores da HiLives. Podes também encontrar vídeos que mostram os ambientes das empresas ou universidades. Qualquer pessoa pode publicar a sua história! <a class='linkIcons' href='uploadStory.php' title='Adicionar uma nova história'> Adiciona a tua aqui! </a></p>";
        } else {
            echo "<p>Aqui, vai encontrar vídeos, fotografias, áudios e textos que demonstram como foram as experiências académicas e profissionais de outros utilizadores da HiLives. Pode também encontrar vídeos que mostram os ambientes das empresas ou universidades. Qualquer pessoa pode publicar a sua história! <a class='linkIcons' href='uploadStory.php' title='Adicionar uma nova história'> Adicione a sua aqui!</a></p>";
        }
        ?>

        <!--STORIES-->
        <?php
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $idexperiences, $description, $date, $xp_type, $content_idcontent, $idContent, $content_name, $idusers, $name_user, $profile_img, $iduser_type);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                while (mysqli_stmt_fetch($stmt)) {
                    $data = substr($date, 0, 10);
                    $newDate = date("d-m-Y", strtotime($data));
        ?>

                    <div class="wrapperStory">
                        <header class="cf">
                            <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" title="Perfil de <?= $name_user ?>">
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
                                <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" class="linkStory"><?= $name_user ?> </a>
                            </h5>
                            <p class="cardInfo13"><?= $newDate ?></p>
                        </header>
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
                }
            } else {
                ?>
                <p class="mx-auto mt-5 mb-5" style="font-size: 1rem; padding-bottom: 30%;">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-circle-fill mr-2 mb-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: #2f2f2f;">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.146-3.146a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z" />
                    </svg>
                    Ainda não existe nenhuma experiência publicada.
                </p>
        <?php
            }
        }
        ?>
    </div>
<?php

} else {
    include("404.php");
}

mysqli_close($link);
?>