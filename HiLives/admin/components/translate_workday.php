<?php
if (isset($_GET["translate"])) {
    $idworkday = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT workday_name, workday_name_en, workday_name_es, workday_name_be, workday_name_is
    FROM workday
    WHERE idworkday = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idworkday);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $workday_name, $workday_name_en, $workday_name_es, $workday_name_be, $workday_name_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Workday details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected workday.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_workday.php?work=<?= $idworkday ?>">
                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name">Name of the workday in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name" name="name" placeholder="Type here the name of the workday in portuguese" value="<?= $workday_name ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_en">Name of the workday in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_en" name="name_en" placeholder="Type here the name of the workday in english" value="<?= $workday_name_en ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_es">Name of the workday in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_es" name="name_es" placeholder="Type here the name of the workday in spanish" value="<?= $workday_name_es ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_be">Name of the workday in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_be" name="name_be" placeholder="Type here the name of the workday in flemish" value="<?= $workday_name_be ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_is">Name of the workday in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_is" name="name_is" placeholder="Type here the name of the workday in icelandic" value="<?= $workday_name_is ?>">
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