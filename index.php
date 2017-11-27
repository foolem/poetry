<?php
include_once "config.inc.php";

$stmt = $PDO->prepare("SELECT * FROM poem, user WHERE poem.author = user.id");
$stmt->execute();
$poems = $stmt->fetchAll(PDO::FETCH_OBJ);

function isLoggedIn() {
  if (!isset($_SESSION['user'])) {
      return false;
  }
  return true;
}
function hasError() {
  if (isset($_SESSION['error'])) {
    return true;
  }
}


?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Poetry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/application.css">

  </head>
  <body>
    <section class="upperNav">
      <nav id="nav" class="navbar navbar-expand-lg navbar-light fixed-top">
        <section class="container-fluid">
          <a class="navbar-brand" href="#">Poetry</a>
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
    <section id="presentation" class="presentation">
      <section class="presentation-txt">
        <h1>do poetry.</h1>
      </section>
      <a id="poems_anchor" class="animated pulse presentation-down-button" href="#poems">
        <section class="presentation-down">
          <h2>v</h2>
        </section>
      </a>
      <img src="assets/img/poema-preto.jpg" alt="Poetry website">
    </section>


    <section id="poems" class="poems">
      <section class="container-fluid">

        <div class="row justify-content-center">
          <div class="row">
            <div class="col">
              <input type="text" class="form-control width-input" placeholder="Pesquise poemas">
            </div>
            <?php if (isset($_SESSION['user'])): ?>
              <div class="col">
                <a class="btn btn-primary" href="new_poem.php" role="button">Novo poema</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <?php foreach($poems as $poem): ?>
          <?php if(!isset($_SESSION['user']) || $_SESSION['user']['role'] == 1): ?>
            <div class="card d-inline-flex justify-content-center card-b-<?php echo $poem->category; ?>" style="width: 30rem">
              <div class="card-body">
                <h4 class="card-title"><?php echo $poem->title; ?></h4>
                <h4 class="card-title"><?php echo $poem->name; ?></h4>
                <p class="card-text"><?php echo $poem->content; ?></p>
              </div>
            </div>
          <?php endif; ?>
          <?php if($_SESSION['user']['role'] == 2): ?>
            <div class="card d-inline-flex justify-content-center card-b-<?php echo $poem->category; ?>" style="width: 30rem">
              <div class="card-body">
                <form action="delete.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $poem->id; ?>">
                  <button type="submit" class="btn btn-primary">Remover</button>
                </form>
                <h4 class="card-title"><?php echo $poem->title; ?></h4>
                <h4 class="card-title"><?php echo $poem->name; ?></h4>

                <p class="card-text"><?php echo $poem->content; ?></p>
              </div>
            </div>
          <?php endif; ?>
          <?php if($_SESSION['user']['role'] == 3 && $poem->status == 'evaluation'): ?>
            <div class="card d-inline-flex justify-content-center card-b-<?php echo $poem->category; ?>" style="width: 30rem">
              <div class="card-body">
                <form action="evaluate_publish.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $poem->id; ?>">
                  <input type="hidden" name="status" value="published">
                  <button type="submit" class="btn btn-primary">Publicar</button>
                </form>
                <form action="delete.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $poem->id; ?>">
                  <button type="submit" class="btn btn-primary">Remover</button>
                </form>
                <h4 class="card-title"><?php echo $poem->title; ?></h4>
                <h4 class="card-title"><?php echo $poem->name; ?></h4>

                <p class="card-text"><?php echo $poem->content; ?></p>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>



      </section>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="login-modal-label">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="sign_in.php" method="post">
            <div class="modal-body">
              <?php if (hasError()): ?>
                <script type="text/javascript">
                  $('#signup-modal').modal('show');
                </script>
                <?php
                print_r("<span style='color:rgb(228, 102, 55)'>" . $_SESSION['error_message'] . "</span>" );
                ?>
              <?php endif; ?>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailLogin" placeholder="Seu email">
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" aria-describedby="passwordLogin" placeholder="Sua senha">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signup-modal-label">Criar conta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="sign_up.php" method="post">
            <div class="modal-body">

              <?php if (hasError()): ?>
                <script type="text/javascript">
                  $('#signup-modal').modal('show');
                </script>
                <?php
                print_r("<span style='color:rgb(228, 102, 55)'>" . $_SESSION['error_message'] . "</span>" );
                ?>
              <?php endif; ?>

              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" aria-describedby="nameLogin" placeholder="Seu nome">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" aria-describedby="emailLogin" placeholder="Seu email">
              </div>
              <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" aria-describedby="passwordLogin" placeholder="Sua senha">
              </div>
              <div class="form-group">
                <label for="password">Confirme a senha</label>
                <input type="password" class="form-control" name="confirm_password" aria-describedby="confirmPasswordLogin" placeholder="Confirme sua senha">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="assets/js/application.js" type="text/javascript"></script>
  </body>
</html>
