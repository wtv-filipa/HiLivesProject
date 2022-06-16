<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  
  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idvacancies, vacancy_name_en, free_vac, name_user,	workday_name
          FROM vacancies 
          INNER JOIN users on vacancies.company_id = users.	idusers
          INNER JOIN workday on vacancies.workday_idworkday = workday.idworkday
          ORDER BY company_id DESC";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2 text-gray-800">Vacancies published by companies</h1>
  <p class="mb-4">Here it is possible to view and manage all vacancies published by companies on the platform so far.</p>
  <?php
  if (isset($_SESSION["vac"])) {
    $msg_show = true;
    switch ($_SESSION["vac"]) {
      case 1:
        $message = "Vacancy successfully deleted!";
        $class = "alert-success";
        $_SESSION["vac"] = 0;
        break;
      case 2:
        $message = "An error has occurred while processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["vac"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["vac"] = 0;
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
              <th>Company</th>
              <th>Vacancy name</th>
              <th>Working hours</th>
              <th>Vacancies available</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Company</th>
              <th>Vacancy name</th>
              <th>Working hours</th>
              <th>Vacancies available</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idVacancies, $vacancy_name_en, $free_vac, $name_user,	$workday_name);
              while ($row_vac = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_vac['name_user']; ?></td>
                  <?php
                  if (isset($row_vac['vacancy_name_en'])) {
                  ?>
                    <td><?= $row_vac['vacancy_name_en']; ?></td>
                  <?php
                  } else {
                    ?>
                    <td class="text_translate">Requires translation</td>
                    <?php
                  }
                  ?>
                  <td><?= $row_vac['workday_name']; ?></td>
                  <td><?= $row_vac['free_vac']; ?></td>
                  <td>
                    <a href="info_vac.php?info=<?= $row_vac['idvacancies'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deletevac<?= $row_vac['idvacancies'] ?>">
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