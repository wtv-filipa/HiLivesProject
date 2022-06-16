<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT iddone_cu, cu_name_en, university_name_en, date_cu, name_user
          FROM done_cu 
          INNER JOIN users on done_cu.users_idusers = users.idusers
          ORDER BY users_idusers DESC";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2 text-gray-800">Courses and Course Units added by People with IDD</h1>
  <p class="mb-4">Here it is possible to view and manage all courses and course units added by People with IDD on the platform so far.</p>
  <?php
  if (isset($_SESSION["uc"])) {
    $msg_show = true;
    switch ($_SESSION["uc"]) {
      case 1:
        $message = "Course/Course Unit successfully deleted!";
        $class = "alert-success";
        $_SESSION["uc"] = 0;
        break;
      case 2:
        $message = "An error has occurred while processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["uc"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["uc"] = 0;
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
              <th>Course name</th>
              <th>University</th>
              <th>End date</th>
              <th>Added by</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Course name</th>
              <th>University</th>
              <th>End date</th>
              <th>Added by</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idDone_CU, $cu_name_en, $university_name_en, $date_cu, $name_user);
              while ($row_uc = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <?php
                  if (isset($row_uc['cu_name_en'])) {
                  ?>
                    <td><?= $row_uc['cu_name_en']; ?></td>
                  <?php
                  } else {
                  ?>
                    <td class="text_translate">Requires translation</td>
                  <?php
                  }
                  if (isset($row_uc['university_name_en'])) {
                  ?>
                    <td><?= $row_uc['university_name_en']; ?></td>
                  <?php
                  } else {
                  ?>
                    <td class="text_translate">Requires translation</td>
                  <?php
                  }
                  ?>
                  <td><?= $row_uc['date_cu']; ?></td>
                  <td><?= $row_uc['name_user']; ?></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#deleteUC<?= $row_uc['iddone_cu'] ?>">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php

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