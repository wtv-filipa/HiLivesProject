<?php
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT COUNT(idusers)
FROM users 
WHERE user_type_iduser_type != 4";

$query2 = "SELECT COUNT(idusers)
FROM users 
WHERE user_type_iduser_type = 7";

$query3 = "SELECT COUNT(idusers)
FROM users 
WHERE user_type_iduser_type = 10";

$query4 = "SELECT COUNT(idusers)
FROM users 
WHERE user_type_iduser_type = 13";

$query5 = "SELECT COUNT(idusers)
FROM users 
WHERE user_type_iduser_type = 16";

if (isset($_SESSION["erro"])) {
    $msg_show = true;
    switch ($_SESSION["erro"]) {
        case 1:
            $message = "An error has occurred while processing your request, please try again later.";
            $class = "alert-warning";
            $_SESSION["erro"] = 0;
            break;
        case 0:
            $msg_show = false;
            break;
        default:
            $msg_show = false;
            $_SESSION["erro"] = 0;
    }

    if ($msg_show == true) {
        echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                                </button>
                                </div>";
        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
}
?>
<div class="row">
    <?php
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
    ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    All users
                                </div>
                                <div class="h5 mb-0 font-weight-bold">Total Number: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query2)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Companies
                                </div>
                                <div class="h5 mb-0 font-weight-bold">Total Number: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query3)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    People with IDD
                                </div>
                                <div class="h5 mb-0 font-weight-bold">Total Number: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query4)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Higher Education Institutions
                                </div>
                                <div class="h5 mb-0 font-weight-bold">Total Number: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                    <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    if (mysqli_stmt_prepare($stmt, $query5)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $idUser);

        while (mysqli_stmt_fetch($stmt)) {
        ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 borderCustom">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 textCustom ">
                                    Tutors
                                </div>
                                <div class="h5 mb-0 font-weight-bold">Total Number: <?= $idUser ?></div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                                    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z" />
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5V6.5Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    ?>
</div>