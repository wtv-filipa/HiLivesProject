<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idvacancies, vacancy_name_en, free_vac, name_user,	workday_name
          FROM vacancies 
          INNER JOIN users on vacancies.company_id = users.	idusers
          INNER JOIN workday on vacancies.workday_idworkday = workday.idworkday";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2">Vacancies published by companies</h1>
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
              mysqli_stmt_bind_result($stmt, $idVacancies, $vacancy_name_en, $free_vac, $name_user,  $workday_name);
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
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-info-circle mr-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deletevac<?= $row_vac['idvacancies'] ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash mr-2" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
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