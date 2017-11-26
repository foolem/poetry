<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $id = $_POST['id'];
  echo $id;
  $stmt = $PDO->prepare('DELETE FROM poems WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  header('Location: index.php');

}
