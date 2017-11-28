<?php
function isLoggedIn() {
  if (!isset($_SESSION['user'])) {
      return false;
  }
  return true;
}

if (isset($_POST) && !empty($_POST)) {
  $id = $_SESSION['user']['id'];
  $title = $_POST['title'];
  $category = $_POST['category'];
  $content = preg_replace('/\n|\n\r/', '<br>', $_POST['content']);
  $status = "evaluation";

  $stmt = $PDO->prepare(
    "INSERT INTO poem (`author`, `title`, `category`, `status`, `content`)
    VALUES (:author, :title, :category, :status, :content);"
  );
  $stmt->bindParam(':author', $id);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':category', $category);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':content', $content);

  $stmt->execute();

  $_SESSION['success'] = 'Seu poema foi enviado para avaliação';

}
