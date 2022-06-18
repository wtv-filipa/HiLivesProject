<?php
if (isset($_GET["translate"])) {
    $idregion = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT name_region, name_region_en, name_region_es, name_region_be, name_region_is
    FROM region
    WHERE idregion = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idregion);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $name_region, $name_region_en, $name_region_es, $name_region_be, $name_region_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Region details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected region.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_region.php?region=<?= $idregion ?>">
                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name">Name of the region in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name" name="name" placeholder="Type here the name of the region in portuguese" value="<?= $name_region ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_en">Name of the region in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_en" name="name_en" placeholder="Type here the name of the region in english" value="<?= $name_region_en ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_es">Name of the region in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_es" name="name_es" placeholder="Type here the name of the region in spanish" value="<?= $name_region_es ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_be">Name of the region in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_be" name="name_be" placeholder="Type here the name of the region in flemish" value="<?= $name_region_be ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_is">Name of the region in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_is" name="name_is" placeholder="Type here the name of the region in icelandic" value="<?= $name_region_is ?>">
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