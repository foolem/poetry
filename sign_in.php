<?php
require_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = hash('sha256',$password);

  try {
    $stmt = $PDO->prepare("SELECT id, name, role FROM user WHERE email = :email AND password = :password LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if($stmt->rowCount() > 0) {
      $_SESSION['user'] = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'role' => $user->role];
    }
    if ($stmt->rowCount() == 0) {
      session_start();
      $_SESSION['error_login'] = true;
      $_SESSION['user_name'] = $name;
      $_SESSION['error_login'] = 'Email ou senha são inválidos';
      header('Location: index.php');
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
