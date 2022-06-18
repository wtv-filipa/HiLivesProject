<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["data_nasc"]) && !empty($_POST["phone"])) {

    $type = 16;

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO users (name_user, email_user, contact_user, birth_date, password, user_type_iduser_type) VALUES (?, ?, ?, ?, ?, ?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssi', $name_user, $email_user, $contact_user, $birth_date, $password, $user_type_iduser_type);

        $name_user = $_POST['nome'];
        $email_user = $_POST['email'];
        $contact_user = $_POST['phone'];
        $birth_date = $_POST['data_nasc'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_type_iduser_type = $type;

        if (mysqli_stmt_execute($stmt)) {
            $last_id = mysqli_insert_id($link);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

        header("Location: ../users_tutor.php");
        $_SESSION["tutor"] = 5;
    } else {
        header("Location: ../add_tutor.php");
        $_SESSION["register"] = 1;
    }
} else {
    header("Location: ../add_tutor.php");
    $_SESSION["register"] = 2;
}
