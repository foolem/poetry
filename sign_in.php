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
      $_SESSION['user'] = ['id' => $user->id, 'name' => $user->name, 'role' => $user->role];
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  header('Location: index.php');
}
