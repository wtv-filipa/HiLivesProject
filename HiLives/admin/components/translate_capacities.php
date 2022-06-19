<?php
if (isset($_GET["translate"])) {
    $idcapacities = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT capacity, capacity_en, capacity_es, capacity_be, capacity_is, capacity_comp, capacity_comp_en, capacity_comp_es, capacity_comp_be, capacity_comp_is
    FROM capacities
    WHERE idcapacities = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $idcapacities);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $capacity, $capacity_en, $capacity_es, $capacity_be, $capacity_is, $capacity_comp, $capacity_comp_en, $capacity_comp_es, $capacity_comp_be, $capacity_comp_is);
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Capacity details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected capacity.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_capacities.php?cap=<?= $idcapacities ?>">
                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name">Name of the capacity for people with IDD in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name" name="name" placeholder="Type here the name of the capacity for people with IDD in portuguese" value="<?= $capacity ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_en">Name of the capacity for people with IDD in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_en" name="name_en" placeholder="Type here the name of the capacity for people with IDD in english" value="<?= $capacity_en ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_es">Name of the capacity for people with IDD in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_es" name="name_es" placeholder="Type here the name of the capacity for people with IDD in spanish" value="<?= $capacity_es ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_be">Name of the capacity for people with IDD in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_be" name="name_be" placeholder="Type here the name of the capacity for people with IDD in flemish" value="<?= $capacity_be ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_is">Name of the capacity for people with IDD in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_is" name="name_is" placeholder="Type here the name of the capacity for people with IDD in icelandic" value="<?= $capacity_is ?>">
                        </div>
                    </div>


                    <!--NAME COMP-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_comp">Name of the capacity for companies in portuguese </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_comp" name="name_comp" placeholder="Type here the name of the capacity for companies in portuguese" value="<?= $capacity_comp ?>">
                        </div>
                    </div>

                    <!--NAME COMP-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_comp_en">Name of the capacity for companies in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_comp_en" name="name_comp_en" placeholder="Type here the name of the capacity for companies in english" value="<?= $capacity_comp_en ?>">
                        </div>
                    </div>

                    <!--NAME COMP-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_comp_es">Name of the capacity for companies in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_comp_es" name="name_comp_es" placeholder="Type here the name of the capacity for companies in spanish" value="<?= $capacity_comp_es ?>">
                        </div>
                    </div>

                    <!--NAME COMP-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_comp_be">Name of the capacity for companies in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_comp_be" name="name_comp_be" placeholder="Type here the name of the capacity for companies in flemish" value="<?= $capacity_comp_be ?>">
                        </div>
                    </div>

                    <!--NAME COMP-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="name_comp_is">Name of the capacity for companies in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="name_comp_is" name="name_comp_is" placeholder="Type here the name of the capacity for companies in icelandic" value="<?= $capacity_comp_is ?>">
                        </div>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize mr-4">Save</button>
                            <a href="capacities_t.php" title="Leave translations edition">
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