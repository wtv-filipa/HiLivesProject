<?php
if (isset($_GET["translate"])) {
    $iddone_cu = $_GET["translate"];

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT cu_name, cu_name_en, cu_name_es, cu_name_be, cu_name_is, university_name, university_name_en, university_name_es, university_name_be, university_name_is
    FROM done_cu 
    WHERE iddone_cu = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $iddone_cu);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cu_name, $cu_name_en, $cu_name_es, $cu_name_be, $cu_name_is, $university_name, $university_name_en, $university_name_es, $university_name_be, $university_name_is);
        $primeiro = true;
        while (mysqli_stmt_fetch($stmt)) {
?>
            <h1 class="h3 mb-2">Course details</h1>
            <p class="mb-4">On this page it is possible to see and manage all the translations of the selected course.</p>
            <div class="card mb-5">
                <form method="post" role="form" action="scripts/translate_course.php?uc=<?= $iddone_cu ?>">
                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomeuc">Name of the Curricular Unit or Course <span class="asteriskPink">*</span></label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomeuc" name="nomeuc" placeholder="Escreve aqui o nome da Unidade Curricular/ Curso" disabled value="<?= $cu_name ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomeuc_en">Name of the Curricular Unit or Course in english </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomeuc_en" name="nomeuc_en" placeholder="Type here the name of the Course/Curriculum Unit in english" value="<?= $cu_name_en ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomeuc_es">Name of the Curricular Unit or Course in spanish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomeuc_es" name="nomeuc_es" placeholder="Type here the name of the Course/Curriculum Unit in spanish" value="<?= $cu_name_es ?>">
                        </div>
                    </div>

                    <!--NAME-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomeuc_be">Name of the Curricular Unit or Course in flemish </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomeuc_be" name="nomeuc_be" placeholder="Type here the name of the Course/Curriculum Unit in flemish" value="<?= $cu_name_be ?>">
                        </div>
                    </div>

                     <!--NAME-->
                     <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="nomeuc_is">Name of the Curricular Unit or Course in icelandic </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="nomeuc_is" name="nomeuc_is" placeholder="Type here the name of the Course/Curriculum Unit in icelandic" value="<?= $cu_name_is ?>">
                        </div>
                    </div>

                    <!--HEIS MADE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="uniuc">Higher Education Institution where it was made </label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="uniuc" name="uniuc" placeholder="Escreve aqui o nome da Instituição de Ensino Superior onde concluíste a Unidade Curricular ou o Curso" disabled value="<?= $university_name ?>">
                        </div>
                    </div>

                    <!--HEIS MADE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="uniuc_en">Higher Education Institution where it was made in english</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="uniuc_en" name="uniuc_en" placeholder="Type here the name of the Higher Education Institution where the Curricular Unit or Course was completed in english" value="<?= $university_name_en ?>">
                        </div>
                    </div>

                    <!--HEIS MADE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="uniuc_es">Higher Education Institution where it was made in spanish</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="uniuc_es" name="uniuc_es" placeholder="Type here the name of the Higher Education Institution where the Curricular Unit or Course was completed in spanish" value="<?= $university_name_es ?>">
                        </div>
                    </div>

                    <!--HEIS MADE-->
                    <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="uniuc_be">Higher Education Institution where it was made in flemish</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="uniuc_be" name="uniuc_be" placeholder="Type here the name of the Higher Education Institution where the Curricular Unit or Course was completed in flemish" value="<?= $university_name_be ?>">
                        </div>
                    </div>

                     <!--HEIS MADE-->
                     <div class="form-group pb-4">
                        <label class="boldFont mt-3 pb-2" for="uniuc_is">Higher Education Institution where it was made in icelandic</label>
                        <div class="p-0 m-0">
                            <input type="text" class="form-control greyBorder" id="uniuc_is" name="uniuc_is" placeholder="Type here the name of the Higher Education Institution where the Curricular Unit or Course was completed in icelandic" value="<?= $university_name_is ?>">
                        </div>
                    </div>

                    <div class="form-group text-center mt-2">
                        <div class="mx-auto col-sm-10 pb-3 pt-2">
                            <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize me-4">Save</button>
                            <a href="courses_t.php" title="Leave translations edition">
                                <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                            </a>
                        </div>
                    </div>
                </form>
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