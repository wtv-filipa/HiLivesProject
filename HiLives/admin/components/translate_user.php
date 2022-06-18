<?php
if (isset($_GET["translate"])) {
    $idusers = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idusers, description, description_en, description_es, description_be, description_is, work_xp, work_xp_en, work_xp_es, work_xp_be, work_xp_is, type_user
    FROM users 
    INNER JOIN user_type ON users.user_type_iduser_type= user_type.iduser_type
    WHERE idusers = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idusers);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idusers, $description, $description_en, $description_es, $description_be, $description_is, $work_xp, $work_xp_en, $work_xp_es, $work_xp_be, $work_xp_is, $type_user);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">User details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected user.</p>
            <div class="card mb-5">
                <form method="post" role="form" id="register-form" action="scripts/translate_user.php?user=<?= $idusers ?>&type=<?= $type_user ?>">

                    <?php
                    if ($type_user == "Pessoa") {
                    ?>
                        <!--WORK EXPERIENCE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="exp_t">Work experience in portuguese </label>
                            <textarea class="form-control " id="exp_t" rows="5" name="exp_t" placeholder="Write here about the work experience that the Person with DID has in portuguese"><?= $work_xp ?></textarea>
                        </div>

                        <!--WORK EXPERIENCE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="exp_t_en">Work experience in english </label>
                            <textarea class="form-control " id="exp_t_en" rows="5" name="exp_t_en" placeholder="Write here about the work experience that the Person with DID has in english"><?= $work_xp_en ?></textarea>
                        </div>

                         <!--WORK EXPERIENCE-->
                         <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="exp_t_es">Work experience in spanish </label>
                            <textarea class="form-control " id="exp_t_es" rows="5" name="exp_t_es" placeholder="Write here about the work experience that the Person with DID has in spanish"><?= $work_xp_es ?></textarea>
                        </div>

                        <!--WORK EXPERIENCE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="exp_t_be">Work experience in flemish </label>
                            <textarea class="form-control " id="exp_t_be" rows="5" name="exp_t_be" placeholder="Write here about the work experience that the Person with DID has in flemish"><?= $work_xp_be ?></textarea>
                        </div>

                        <!--WORK EXPERIENCE-->
                        <div class="form-group pb-4">
                            <label class="boldFont mt-3 pb-2" for="exp_t_is">Work experience in icelandic </label>
                            <textarea class="form-control " id="exp_t_is" rows="5" name="exp_t_is" placeholder="Write here about the work experience that the Person with DID has in icelandic"><?= $work_xp_is ?></textarea>
                        </div>
                    <?php
                    }
                    ?>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao">Description in portuguese </label>
                        <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Type here the story description in portuguese"><?= $description ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_en">Description in english </label>
                        <textarea class="form-control " id="descricao_en" rows="5" name="descricao_en" placeholder="Type here the story description in english"><?= $description_en ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_es">Description in spanish </label>
                        <textarea class="form-control " id="descricao_es" rows="5" name="descricao_es" placeholder="Type here the story description in spanish"><?= $description_es ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_be">Description in flemish </label>
                        <textarea class="form-control " id="descricao_be" rows="5" name="descricao_be" placeholder="Type here the story description in flemish"><?= $description_be ?></textarea>
                    </div>

                    <!--DESCRIPTION-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="descricao_is">Description in icelandic </label>
                        <textarea class="form-control " id="descricao_is" rows="5" name="descricao_is" placeholder="Type here the story description in icelandic"><?= $description_is ?></textarea>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize mr-4">Save</button>
                            <a href="stories_t.php" title="Leave translations edition">
                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

<?php
        }
    }
    mysqli_close($link);
} else {
    include("404.php");
}
?>