<?php
if (isset($_GET["translate"])) {
    $idinstitution_type = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT name_institution_type, name_institution_type_en, name_institution_type_es, name_institution_type_be, name_institution_type_is
    FROM institution_type
    WHERE idinstitution_type = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idinstitution_type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_institution_type, $name_institution_type_en, $name_institution_type_es, $name_institution_type_be, $name_institution_type_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Institution type details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected institution type.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_institution.php?institution=<?= $idinstitution_type ?>">
                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name">Name of the institution type in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name" name="name" placeholder="Type here the name of the institution type in portuguese" value="<?= $name_institution_type ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_en">Name of the institution type in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_en" name="name_en" placeholder="Type here the name of the institution type in english" value="<?= $name_institution_type_en ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_es">Name of the institution type in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_es" name="name_es" placeholder="Type here the name of the institution type in spanish" value="<?= $name_institution_type_es ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_be">Name of the institution type in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_be" name="name_be" placeholder="Type here the name of the institution type in flemish" value="<?= $name_institution_type_be ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_is">Name of the institution type in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_is" name="name_is" placeholder="Type here the name of the institution type in icelandic" value="<?= $name_institution_type_is ?>">
                        </div>
                    </div>


                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize mr-4">Save</button>
                            <a href="courses_t.php" title="Leave translations edition">
                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

<?php
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    include("404.php");
}
?>