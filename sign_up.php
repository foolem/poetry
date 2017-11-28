<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password != $confirm_password) {
    session_start();
    $_SESSION['error_signup'] = true;
    $_SESSION['user_name'] = $name;
    $_SESSION['error_signup'] = 'Senhas não conferem';
    header('Location: index.php');
  }

  $password = hash('sha256', $password);

  try {
    $stmt = $PDO->prepare( "INSERT INTO user(`role`, `name`, `email`, `password`) VALUES (1, :name, :email, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    if($stmt->rowCount() > 0) {
      $_SESSION['user'] = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role];
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) {
    header('Location: poems.php');
  }
  if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) {
    header('Location: index_admin.php');
  }
  if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 3) {
    header('Location: index_appraiser.php');
  }
}
