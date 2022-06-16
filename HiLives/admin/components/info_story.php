<?php
if (isset($_GET["info"])) {
    $idexperiences = $_GET["info"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT experiences.idexperiences, experiences.description, experiences.description_en, experiences.date, experiences.xp_type, experiences.content_idcontent, content.idContent, content.content_name, users.idusers, users.name_user, users.profile_img
    FROM experiences
    LEFT JOIN content ON experiences.content_idcontent = content.idcontent
    INNER JOIN users ON experiences.users_idusers = users.idusers
    WHERE idexperiences = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $idexperiences);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idexperiences, $description, $description_en, $date, $xp_type, $content_idcontent, $idContent, $content_name, $idusers, $name_user, $profile_img);

        while (mysqli_stmt_fetch($stmt)) {
            $data = substr($date, 0, 10);
            $newDate = date("d-m-Y", strtotime($data));
?>
            <h1 class="h3 mb-2">HiLives story details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the details of the selected story.</p>

            <div class="wrapperStory mb-5">
                <header class="cf">
                    <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" title="Profile of <?= $name_user ?>">
                        <?php
                        if (isset($profile_img)) {
                        ?>
                            <img class="profile-pic" src="uploads/img_perfil/<?= $profile_img ?>" alt="<?= $profile_img ?>" title="Profile image of <?= $name_user ?>" />
                        <?php
                        } else {
                        ?>
                            <img class="profile-pic" src="img/no_profile_img.png" alt="without profile image" title="without profile image" />
                        <?php
                        }
                        ?>
                    </a>
                    <h5 class="name">
                        <a href="ViewProfile.php?user=<?= $idusers ?>&userType=<?= $iduser_type ?>" title="Profile of <?= $name_user ?>" class="linkStory"><?= $name_user ?> </a>
                    </h5>
                    <p class="cardInfo13"><?= $newDate ?></p>
                </header>
                <?php
                //VIDEO
                if ($xp_type == "video") {
                    if (isset($description) && isset($description_en)) {
                ?>
                        <p class="status"><?= $description_en ?></p>
                    <?php
                    } else if (isset($description) && !isset($description_en)) {
                    ?>
                        <p class="status text_translate">Requires translation</p>
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
                    if (isset($description) && isset($description_en)) {
                    ?>
                        <p class="status"><?= $description_en ?></p>
                    <?php
                    } else if (isset($description) && !isset($description_en)) {
                    ?>
                        <p class="status text_translate">Requires translation</p>
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
                    if (isset($description) && isset($description_en)) {
                    ?>
                        <p class="status"><?= $description_en ?></p>
                    <?php
                    } else if (isset($description) && !isset($description_en)) {
                    ?>
                        <p class="status text_translate">Requires translation</p>
                    <?php
                    }
                    ?>
                    <div class="text-center videoSize">
                        <img class="img-content img-fluid" alt="<?= $content_name ?>" title="<?= $content_name ?>" src="../../../admin/uploads/experiences/<?= $content_name ?>" />
                    </div>
                    <?php
                } else if ($xp_type == "text") {
                    if (isset($description) && isset($description_en)) {
                    ?>
                        <p class="status"><?= $description_en ?></p>
                    <?php
                    } else if (isset($description) && !isset($description_en)) {
                    ?>
                        <p class="status text_translate">Requires translation</p>
                <?php
                    }
                }
                ?>

                <div class="form-group mt-5 text-center">
                    <a class="col-xs-12 col-md-12" href="#" data-toggle="modal" data-target="#deletexp<?= $idexperiences ?>"> <button class="btn cancel_btn"><i class="fas fa-trash"></i> Delete Story</button></a>
                    <span></span>
                </div>
            </div>
<?php
            include('components/delete_modal.php');
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>