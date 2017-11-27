<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $stmt = $PDO->prepare('UPDATE poem SET status = :status WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':status', $status);

  $stmt->execute();
  header('Location: index.php');

}
