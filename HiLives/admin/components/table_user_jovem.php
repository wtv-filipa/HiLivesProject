<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);

  $query = "SELECT 	idusers, name_user, email_user, contact_user, birth_date, work_xp_en, description_en, profile_img, active
  FROM users 
  INNER JOIN user_type ON users.user_type_iduser_type= user_type.iduser_type
  WHERE type_user='Pessoa'
  ORDER BY 	idusers DESC";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2">People with IDD</h1>
  <p class="mb-4">Here you can view and manage all the people with IDD who have signed up to the platform so far. </p>
  <?php
  if (isset($_SESSION["jovem"])) {
    $msg_show = true;
    switch ($_SESSION["jovem"]) {
      case 1:
        $message = "User successfully blocked!";
        $class = "alert-success";
        $_SESSION["jovem"] = 0;
        break;
      case 2:
        $message = "An error has occurred processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["jovem"] = 0;
        break;
      case 3:
        $message = "User successfully unlocked!";
        $class = "alert-success";
        $_SESSION["jovem"] = 0;
        break;
      case 4:
        $message = "User successfully deleted!";
        $class = "alert-success";
        $_SESSION["jovem"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["jovem"] = 0;
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
              <th>Birth date</th>
              <th>Work experience</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Birth date</th>
              <th>Work experience</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $id_user_lista, $name_user, $email_user, $contact_user, $birth_date, $info_young, $work_xp, $profile_img, $active);
              while ($row_users = mysqli_fetch_assoc($array_val)) {
            ?>

                <tr>
                  <td><?= $row_users['name_user']; ?></td>
                  <td><?= $row_users['email_user']; ?></td>
                  <td><?= $row_users['contact_user']; ?></td>
                  <td><?= $row_users['birth_date']; ?></td>
                  <?php
                  if (isset($row_users['work_xp'])) {
                  ?>
                    <td><?= $row_users['work_xp']; ?></td>
                  <?php
                  } else {
                  ?>
                    <td class="text_translate">Requires translation</td>
                  <?php
                  }
                  ?>
                  <td>
                    <a href="info_users.php?info=<?= $row_users['idusers'] ?>"><i class="fas fa-info-circle"></i></a>
                    <?php
                    if ($row_users['active'] == 1) {
                    ?>
                      <a class="hover" href="#" data-toggle="modal" data-target="#activeModal<?= $row_users['idusers'] ?>"><i class="fas fa-ban"></i></a>
                    <?php
                    } else {
                    ?>
                      <a href="#" data-toggle="modal" data-target="#inactiveModal<?= $row_users['idusers'] ?>"><i class="fas fa-ban" style="color: #AE0168"></i></a>
                    <?php
                    }
                    ?>
                    <a href="#" data-toggle="modal" data-target="#deleteModal<?= $row_users['idusers'] ?>"><i class="fas fa-trash"></i></a>
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