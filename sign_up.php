<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  if ($password != $confirm_password) {
    session_start();
    $_SESSION['error'] = true;
    $_SESSION['user_name'] = $name;
    $_SESSION['error_message'] = 'Email ou senha inválidos';


    echo "Senhas não conferem";
    header('Location: index.php');
  }
  $password = hash('sha256', $password);
  $stmt = $PDO->prepare( "INSERT INTO users (`name`, `email`, `password`) VALUES ('{$name}', '{$email}', '{$password}')");

  $stmt->execute();

  header('Location: index.php');
}
