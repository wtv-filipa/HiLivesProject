<?php

require_once("connections/connection.php");

if (isset($_SESSION["idUser"])) {
  $idUser = $_SESSION["idUser"];
  
  $link = new_db_connection();
  $stmt = mysqli_stmt_init($link);
  $query = "SELECT idcourses, name_course_en, course_director, website_course, name_user
          FROM courses 
          INNER JOIN users on courses.users_idusers = users.	idusers
          ORDER BY idcourses DESC";

  $array_val = mysqli_query($link, $query);

?>
  <h1 class="h3 mb-2 text-gray-800">Courses published by Higher Education Institutions</h1>
  <p class="mb-4">Here it is possible to view and manage all courses published by Higher Education Institutions on the platform so far.</p>
  <?php
  if (isset($_SESSION["course"])) {
    $msg_show = true;
    switch ($_SESSION["course"]) {
      case 1:
        $message = "Course successfully deleted!";
        $class = "alert-success";
        $_SESSION["course"] = 0;
        break;
      case 2:
        $message = "An error has occurred while processing your request, please try again later.";
        $class = "alert-warning";
        $_SESSION["course"] = 0;
        break;
      case 0:
        $msg_show = false;
        break;
      default:
        $msg_show = false;
        $_SESSION["course"] = 0;
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
              <th>HEI</th>
              <th>Course name</th>
              <th>Course Director</th>
              <th>Website</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>HEI</th>
              <th>Course name</th>
              <th>Course Director</th>
              <th>Website</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_bind_result($stmt, $idcourses, $name_course_en, $course_director, $website_course, $name_user);
              while ($row_course = mysqli_fetch_assoc($array_val)) {
            ?>
                <tr>
                  <td><?= $row_course['name_user']; ?></td>
                  <?php
                  if (isset($row_course['name_course_en'])) {
                  ?>
                    <td><?= $row_course['name_course_en']; ?></td>
                  <?php
                  } else {
                    ?>
                    <td class="text_translate">Requires translation</td>
                    <?php
                  }
                  ?>
                  <td><?= $row_course['course_director']; ?></td>
                  <td>https://<?= $row_course['website_course']; ?></td>
                  <td>
                    <a href="info_course_hei.php?info=<?= $row_course['idcourses'] ?>">
                      <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#deleteCourseHei<?= $row_course['idcourses'] ?>">
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