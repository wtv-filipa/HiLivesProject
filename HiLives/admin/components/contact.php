<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idcontact, name, email, suggestion, solved
  FROM contact";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2">Users problems/suggestions</h1>
  <p class="mb-4">On this page it is possible to see the problems and suggestions sent by users. It is recommended that a response is given from the email provided by them.</p>

  <?php
  if (isset($_SESSION["contact"])) {
    $msg_show = true;
    switch ($_SESSION["contact"]) {
      case 1:
        $message = "Status successfully updated!";
        $class = "alert-success";
        $_SESSION["contact"] = 0;
        break;
      case 2:
        $message = "An error has occurred while processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["contact"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["contact"] = 0;
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
              <th>Suggestion/Problem</th>
              <th>Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Suggestion/Problem</th>
              <th>Status</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idcontact, $name, $email, $suggestion, $solved);
              while ($row_contact = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_contact['name']; ?></td>
                  <td><?= $row_contact['email']; ?></td>
                  <td><?= $row_contact['suggestion']; ?></td>

                  <?php
                  if ($row_contact['solved'] == 0) {
                  ?>
                    <td>
                      <a href="scripts/mark_contact.php?contact=<?= $row_contact['idcontact'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                          <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z" />
                          <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z" />
                        </svg>
                        Mark as solved
                      </a>
                    </td>
                  <?php
                  } else {
                  ?>
                    <td style="color: #0f6848;"> solved </td>
                  <?php
                  }
                  ?>
                </tr>
            <?php
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