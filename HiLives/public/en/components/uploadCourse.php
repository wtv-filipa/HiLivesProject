<?php
require_once("../../connections/connection.php");
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
$idUser = $_SESSION["idUser"];

?>
<div class="container">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="homePerson.php" title="Back to homepage">Homepage</a></li>
            <li class="breadcrumb-item"><a href="profile.php" title="Back to my area">My area</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload a new Course or Curricular Unit done</li>
        </ol>
    </nav>
    <?php
    if (isset($_SESSION["doneCU"])) {
        $msg_show = true;
        switch ($_SESSION["doneCU"]) {
            case 1:
                $message = "An error has occurred while processing your request, please try again later.";
                $class = "alert-warning";
                $_SESSION["doneCU"] = 0;
                break;
            case 2:
                $message = "All mandatory fields must be filled in.";
                $class = "alert-warning";
                $_SESSION["doneCU"] = 0;
                break;
            case 0:
                $msg_show = false;
                break;
            default:
                $msg_show = false;
                $_SESSION["doneCU"] = 0;
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
    <div class="card o-hidden border-0 shadowCard my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="paddingForms">
                        <div class="text-center">
                            <h1 class="mb-4 weightTitle">Add a new Course or Curricular Unit done</h1>
                        </div>
                        <form method="post" role="form" id="register-form" action="../../scripts/uploadCourse_en.php">
                            <!--NAME-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="nomeuc">Name of the Curricular Unit or Course <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="nomeuc" name="nomeuc" placeholder="Type here the name of the Course/Curriculum Unit" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--HEIS MADE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="uniuc">Higher Education Institution where it was made <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="text" class="form-control greyBorder" id="uniuc" name="uniuc" placeholder="Type here the name of the Higher Education Institution where you completed the course" aria-required="true" required="required">
                                </div>
                            </div>

                            <!--CONCLUSION DATE-->
                            <div class="form-group pb-4">
                                <label class="boldFont mt-3 pb-2" for="data">Date of conclusion <span class="asteriskPink">*</span></label>
                                <div class="p-0 m-0">
                                    <input type="date" class="form-control greyBorder" id="data" name="data" placeholder="Write here the date of conclusion of the Curricular Unit/Course" aria-required="true" required="required">
                                </div>
                            </div>

                            <div class="form-group text-center mt-2">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn buttonDesign buttonStudy buttonLoginSize">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>