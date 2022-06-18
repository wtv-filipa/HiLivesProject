<?php
require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT 	idusers, name_user, email_user, contact_user, website, active, name_institution_type_en
  FROM users 
  INNER JOIN user_type ON users.User_type_idUser_type = user_type.iduser_type
  INNER JOIN institution_type ON users.institution_type_idinstitution_type = institution_type.idinstitution_type
  WHERE type_user = 'Universidade'
  ORDER BY 	idusers DESC";

  $array_val = mysqli_query($link, $query);
?>
  <h1 class="h3 mb-2">Higher Education Institutions</h1>
  <p class="mb-4">Here it is possible to view and manage all the Higher Education Institutions that signed up on the platform so far.</p>
  <?php
  if (isset($_SESSION["uni"])) {
    $msg_show = true;
    switch ($_SESSION["uni"]) {
      case 1:
        $message = "User successfully blocked!";
        $class = "alert-success";
        $_SESSION["uni"] = 0;
        break;
      case 2:
        $message = "An error has occurred processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["uni"] = 0;
        break;
      case 3:
        $message = "User successfully unlocked!";
        $class = "alert-success";
        $_SESSION["uni"] = 0;
        break;
      case 4:
        $message = "User successfully deleted!";
        $class = "alert-success";
        $_SESSION["uni"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["uni"] = 0;
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
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Institution type</th>
              <th>Website</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Institution type</th>
              <th>Website</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt,  $id_user_lista, $name_user, $email_user, $contact_user, $website, $active, $name_institution_type_en);
              while ($row_users = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_users['name_user']; ?></td>
                  <td><?= $row_users['email_user']; ?></td>
                  <td><?= $row_users['contact_user']; ?></td>
                  <td><?= $row_users['name_institution_type_en']; ?></td>
                  <td><?= $row_users['website']; ?></td>
                  <td>
                    <a href="info_users.php?info=<?= $row_users['idusers'] ?>" title="More info about the user">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle mr-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                    </a>
                    <?php
                    if ($row_users['active'] == 1) {
                    ?>
                      <a href="#" data-toggle="modal" data-target="#activeModal<?= $row_users['idusers'] ?>" title="Block the user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-x mr-2" viewBox="0 0 16 16">
                          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                          <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                        </svg>
                      </a>
                    <?php
                    } else {
                    ?>
                      <a href="#" data-toggle="modal" data-target="#inactiveModal<?= $row_users['idusers'] ?>" title="Unlock the user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-check mr-2" viewBox="0 0 16 16">
                          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                          <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                      </a>
                    <?php
                    }
                    ?>
                    <a href="#" data-toggle="modal" data-target="#deleteModal<?= $row_users['idusers'] ?>" title="Delete the user">
                      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash mr-2" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </a>
                  </td>
                </tr>
            <?php

                include('components/active_modal.php');

                include('components/delete_modal.php');
              }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>
<?php
} else {
  include("components/404.php");
}
?>