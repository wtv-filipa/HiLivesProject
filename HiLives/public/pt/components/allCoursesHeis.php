<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {

    $idUser = $_SESSION["idUser"];

    $query1 = "SELECT idcourses, name_course, course_director
                FROM courses
                WHERE users_idusers = ? ORDER BY idcourses DESC";
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homeHei.php" title="Voltar à página inicial">Página Inicial</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cursos</li>
            </ol>
        </nav>

        <?php
        if (isset($_SESSION["course"])) {
            $msg_show = true;
            switch ($_SESSION["course"]) {
                case 1:
                    $message = "Curso carregado com sucesso!";
                    $class = "alert-success";
                    $_SESSION["course"] = 0;
                    break;
                case 2:
                    $message = "Ocorreu um erro a processar o seu pedido, por favor tente novamente mais tarde.";
                    $class = "alert-warning";
                    $_SESSION["course"] = 0;
                    break;
                case 3:
                    $message = "Curso editado com sucesso!";
                    $class = "alert-success";
                    $_SESSION["course"] = 0;
                    break;
                case 4:
                    $message = "Curso eliminado com sucesso!";
                    $class = "alert-success";
                    $_SESSION["course"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["course"] = 0;
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

        <h1 class="pb-2">Os meus Cursos</h1>
        <p class="pb-4">Aqui pode gerir todos os seus cursos publicados até ao momento.</p>

        <section class="row pb-5">
            <?php

            if (mysqli_stmt_prepare($stmt, $query1)) {

                mysqli_stmt_bind_param($stmt, 'i', $idUser);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $idcourses, $name_course, $course_director);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    while (mysqli_stmt_fetch($stmt)) {
            ?>
                        <div id="cardMatch" class="col-12 col-md-6 col-lg-4 pb-4">
                            <div class="list listStudy text-center">
                                <a href="infoCourse.php?course=<?= $idcourses ?>" title="Ver informações do curso <?= $name_course ?>">
                                    <h4><?= $name_course ?></h4>
                                </a>
                                <p>Diretor(a): <?= $course_director ?></p>
                                <div>
                                    <a href="editCourseHei.php?course=<?= $idcourses ?>" class="linkIconsStudy" title="Editar o curso <?= $name_course ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-3" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>

                                    <a href="#" class="linkIconsStudy" title="Eliminar o curso <?= $name_course ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </section>

    </div>
<?php
} else {
    include("404.php");
}

mysqli_close($link);

?>