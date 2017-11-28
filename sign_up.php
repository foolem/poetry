<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if ($password != $confirm_password) {
    $_SESSION['error_signup'] = true;
    $_SESSION['user_name'] = $name;
    $_SESSION['error_signup'] = 'Senhas não conferem';
    header('Location: new_user.php');
  }

  $password = hash('sha256', $password);

  try {
    $stmt = $PDO->prepare( "INSERT INTO user(`role`, `name`, `email`, `password`) VALUES (1, :name, :email, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();


  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  header('Location: poems.php');


}
