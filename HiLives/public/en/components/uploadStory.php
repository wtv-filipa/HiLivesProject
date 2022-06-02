<?php
require_once("../../connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

if (isset($_SESSION["idUser"])) {
    $id_navegar = $_SESSION["idUser"];
?>

    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homePerson.php" title="Back to homepage">Homepage</a></li>
                <li class="breadcrumb-item"><a href="stories.php" title="Back to HiLives stories">HiLives Stories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add a new story to HiLives</li>
            </ol>
        </nav>

        <?php
        if (isset($_SESSION["xp_jovem"])) {
            $msg_show = true;
            switch ($_SESSION["xp_jovem"]) {
                case 1:
                    $message = "The file you tried to upload is not a video.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 2:
                    $message = "The video you tried to upload already exists in your stories.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 3:
                    $message = "At least one field must be filled in.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 4:
                    $message = "The file you tried to upload is larger than the supported size.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 5:
                    $message = "The file you tried to upload has a format that is not supported by our platform.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 6:
                    $message = "An error occurred while uploading your file, please try again.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 7:
                    $message = "An error occurred while uploading your story, please try again.";
                    $class = "alert-warning";
                    $_SESSION["xp_jovem"] = 0;
                    break;
                case 0:
                    $msg_show = false;
                    break;
                default:
                    $msg_show = false;
                    $_SESSION["xp_jovem"] = 0;
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
                                <h1 class="mb-4 weightTitle">
                                    Upload a story
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" title="Dicas" data-bs-content="The text should have a simple language. Whenever you find a similar symbol next to the fields to be filled in, you can see tips on how to fill them in. Record your videos or images horizontally, so that other people can see them more easily.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </h1>
                            </div>
                            <form method="post" role="form" class="inserir_dados" action="../../scripts/uploadStory_en.php?xp=<?= $id_navegar ?>" enctype="multipart/form-data">
                                <!--FILES-->
                                <label class="boldFont mt-3 pb-2" for="regiao">
                                    Insert a video, audio or image
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="right" title="Any one file should be a maximum of 2gb.">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input file-upload" id="fileToUpload" name="fileToUpload" accept=".avi, .wmv, .mp4, .mov, .jpg, .png, .svg, .ogg, .mp3, .wav">
                                    <label class="custom-file-label" for="fileToUpload">Select file</label>
                                </div>
                                <!--DESCRIPTION-->
                                <div class="form-group pb-4">
                                    <label class="boldFont mt-3 pb-2" for="descricao">Description</label>
                                    <textarea class="form-control " id="descricao" rows="5" name="descricao" placeholder="Describe your story"></textarea>
                                </div>

                                <div class="form-group text-center mt-2">
                                    <div class="mx-auto col-sm-10 pb-3 pt-2">
                                        <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize">Add story</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    include("404.php");
}
?>