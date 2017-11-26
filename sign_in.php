<?php
require_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $password = hash('sha256',$password);
  try {
    $stmt = $PDO->prepare("SELECT users.id, users.name FROM users WHERE users.email = :email AND users.password = :password LIMIT 1");


    $stmt->execute(array(
      ':email' => $email,
      ':password' => $password
    ));
    $user = $stmt->fetch(PDO::FETCH_OBJ);


  } catch (Exception $e) {
    echo $e->getMessage();
    echo("email ou senha inválidos");
  }

  session_start();
  $_SESSION['logged_in'] = true;
  $_SESSION['user_id'] = $user->id;
  $_SESSION['user_name'] = $user->name;

  header('Location: index.php');
}
