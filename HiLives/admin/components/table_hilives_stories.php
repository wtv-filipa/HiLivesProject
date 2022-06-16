<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];

  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);

  $query = "SELECT experiences.idexperiences, users.name_user, experiences.description, experiences.description_en, experiences.date, experiences.xp_type, content.idContent
  FROM experiences
  LEFT JOIN content ON experiences.content_idcontent = content.idcontent
  Inner JOIN users ON experiences.users_idusers = users.idusers
  ORDER BY date DESC";

  $array_val = mysqli_query($link, $query);

?>

  <h1 class="h3 mb-2 text-gray-800">HiLives Stories</h1>
  <p class="mb-4">Here you can manage all the stories published on the platform so far.</p>
  <?php
  if (isset($_SESSION["xp"])) {
    $msg_show = true;
    switch ($_SESSION["xp"]) {
      case 1:
        $message = "Experience successfully deleted!";
        $class = "alert-success";
        $_SESSION["xp"] = 0;
        break;
      case 2:
        $message = "An error has occurred while processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["xp"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["xp"] = 0;
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
              <th>Published by</th>
              <th>description</th>
              <th>Date</th>
              <th>Story type</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Published by</th>
              <th>description</th>
              <th>Date</th>
              <th>Story type</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idexperiences, $name_user, $description, $description_en, $date, $xp_type, $idContent);
              while ($row_vid = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_vid['name_user']; ?></td>
                  <?php
                  if (isset($row_vid['description']) && isset($row_vid['description_en'])) {
                  ?>
                    <td><?= $row_vid['description_en']; ?></td>
                  <?php
                  } else if (isset($row_vid['description']) && !isset($row_vid['description_en'])) {
                  ?>
                    <td class="text_translate">Requires translation</td>
                  <?php
                  } else {
                  ?>
                  <td class="text_translate">Story without description</td>
                  <?php
                  }
                  ?>
                  <td><?= substr($row_vid['date'], 0, 10); ?></td>
                  <td><?= $row_vid['xp_type']; ?></td>
                  <td>
                    <a href="info_story.php?info=<?= $row_vid['idexperiences'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deletexp<?= $row_vid['idexperiences'] ?>">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php
                include('components/delete_modal.php');
              }
            }
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