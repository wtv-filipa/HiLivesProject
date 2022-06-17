<?php
if (isset($_GET["translate"])) {
    $idexperiences = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT idexperiences, description, description_en, description_es, description_be, description_is
    FROM experiences
    WHERE idexperiences = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idexperiences);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idexperiences, $description, $description_en, $description_es, $description_be, $description_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Story details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected story.</p>
            <div class="card mb-5">
                <form method="post" role="form" id="register-form" action="scripts/translate_story.php?xp=<?= $idexperiences ?>">
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
                            <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize me-4">Save</button>
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