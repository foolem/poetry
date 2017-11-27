<?php
session_start();
include_once "config.inc.php";

function isLoggedIn() {
  if (!isset($_SESSION['user']['logged_in']) || $_SESSION['user']['logged_in'] !== true) {
      return false;
  }
  return true;
}

if (isset($_POST) && !empty($_POST)) {
  $id = $_SESSION['user']['id'];
  $title = $_POST['title'];
  $category = $_POST['category'];
  $content = $_POST['content'];
  $status = "evaluation";

  $stmt = $PDO->prepare(
    "INSERT INTO poems (`author`, `title`, `category`, `status`, `content`)
    VALUES (:author, :title, :category, :status, :content);"
  );
  $stmt->bindParam(':author', $id);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':category', $category);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':content', $content);

  $stmt->execute();

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Poetry - Novo poema</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/application.css">
  </head>
  <body>
    <section class="upperNav">
      <nav id="nav" class="navbar navbar-expand-lg navbar-light fixed-top">
        <section class="container-fluid">
          <a class="navbar-brand" href="index.php">Poetry</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
          <?php if (isLoggedIn()): ?>
          <span style="color:#fff"><?php echo $_SESSION['user']['name']; ?></span>
          <span style="color:#fff;margin:0 20px"> | </span>
          <a class="login-btn" href="logout.php">Logout</a>
          <?php else: ?>
            <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#signup-modal">
              Criar conta
            </button>
            <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#login-modal">
              Login
            </button>


          <?php endif; ?>
        </section>
      </nav>
    </section>

    <section class="container-fluid">
      <section class="new-poem">
        <h1 class="text-center">Adicionar um poema</h1>



        <form action="new_poem.php" method="post">
          <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="poemTitle" placeholder="Título do seu poema">
          </div>
          <div class="form-group width-select">
            <label for="category">Categoria</label>
            <select class="form-control" id="select_category" name="category">
              <option value="1">Romântico</option>
              <option value="2">Melancólico</option>
              <option value="3">Divertido</option>
            </select>
          </div>
          <div class="form-group">
            <label for="content">Poema</label>
            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </section>

    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="assets/js/application.js" type="text/javascript"></script>
  </body>
</html>
