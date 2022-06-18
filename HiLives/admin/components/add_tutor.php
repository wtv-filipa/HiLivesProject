<h1 class="h3 mb-2">Add a new tutor</h1>
<p class="mb-4">On this page it is possible to add a new tutor to the platform. The data used should be provided later to the person responsible, who can change it if necessary.</p>

<?php
if (isset($_SESSION["register"])) {
    $msg_show = true;
    switch ($_SESSION["register"]) {
        case 1:
            $message = "An error has occurred during registration, please try again.";
            $class = "alert-warning";
            $_SESSION["register"] = 0;
            break;
        case 2:
            $message = "All mandatory fields must be filled in.";
            $class = "alert-warning";
            $_SESSION["register"] = 0;
            break;
        case 0:
            $msg_show = false;
            break;
        default:
            $msg_show = false;
            $_SESSION["register"] = 0;
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
<div class="card mb-5">
    <form method="post" role="form" action="scripts/add_tutor.php">
    <p class="mt-3" style="font-size: 14px; color: #005E89 !important;">* Mandatory</p>
        <!--NAME-->
        <div class="form-group pb-4">
            <label class="boldFont pb-2" for="username">Name <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="text" class="form-control greyBorder" id="username" name="nome" placeholder="Type the tutor's name here" aria-required="true" required="required">
            </div>
        </div>
        <!--EMAIL-->
        <div class="form-group pb-4">
            <label class="boldFont mt-3 pb-2" for="email">Email <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="email" class="form-control greyBorder" id="email" name="email" placeholder="Type the tutor's email here" aria-required="true" required="required" onchange="email_validate(this.value);">
            </div>
        </div>
        <!--PASSWORD-->
        <div class="form-group pb-4">
            <label class="boldFont mt-3 pb-2" for="password">Password <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="password" class="form-control greyBorder" id="password" name="password" placeholder="Create the tutor's HiLives password" aria-required="true" required="required" onkeyup="checkPass(); return false;">
            </div>
        </div>

        <!--CONFIRM PASSWORD-->
        <div class="form-group pb-4">
            <label class="boldFont mt-3 pb-2" for="password_confirm">Confirm password <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="password" class="form-control greyBorder" id="password_confirm" placeholder="Repeat the tutor's password" aria-required="true" required="required" onkeyup="checkPass(); return false;">
                <span id="confirmMessage" class="confirmMessage"></span>
            </div>
        </div>

        <!--DATE OF BIRTH-->
        <div class="form-group pb-4">
            <label class="boldFont mt-3 pb-2" for="data_nasc">Date of birth <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="date" class="form-control greyBorder" id="data_nasc" name="data_nasc" placeholder="Date of birth" aria-required="true" required="required">
            </div>
        </div>

        <!--MOBILE PHONE-->
        <div class="form-group pb-4">
            <label class="boldFont mt-3 pb-2" for="phone">Phone number <span class="asterisk">*</span></label>
            <div class="p-0 m-0">
                <input type="text" class="form-control greyBorder" id="phone" name="phone" placeholder="Type the tutor's mobile phone number here" aria-required="true" required="required">
            </div>
        </div>

        <div class="form-group text-center mt-2">
            <div class="mx-auto col-sm-10 pb-3 pt-2">
                <button type="submit" class="btn buttonDesign buttonWork buttonLoginSize mr-4">Create</button>
                <a href="users_tutor.php" title="Leave translations edition">
                    <button type="button" class="btn buttonDesign buttonCancel buttonLoginSize">Cancel</button>
                </a>
            </div>
        </div>
    </form>
</div>