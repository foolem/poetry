<?php
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $id = $_POST['id'];
  $stmt = $PDO->prepare('DELETE FROM poem WHERE id = :id');
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  if ($_SESSION['user']['role'] == 1) {
    header('Location: poems.php');
  }
  if ($_SESSION['user']['role'] == 2) {
    header('Location: index_admin.php');
  }
  if ($_SESSION['user']['role'] == 3) {
    header('Location: index_appraiser.php');
  }

}
