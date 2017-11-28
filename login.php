<?php
include_once "config.inc.php";
include_once "index.inc.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sua Poesia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/application.css">


  </head>
  <body>


    <section class="upperNav">
      <nav id="nav" class="navbar navbar-expand-lg navbar-light fixed-top">
        <section class="container-fluid">
          <a class="navbar-brand" href="poems.php">Sua Poesia</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
          <?php if (isLoggedIn()): ?>
            <?php if ($_SESSION['user']['role'] == 1): ?>
              <span class="mx-4">
                <a id="new" class="btn btn-light" href="new_poem.php" role="button">Novo poema</a>

              </span>
            <?php endif; ?>
          <span style="color:#fff"><?php echo $_SESSION['user']['name']; ?></span>
          <span style="color:#fff;margin:0 20px"> | </span>
          <a class="login-btn" href="logout.php">Logout</a>
          <?php else: ?>

          <?php endif; ?>

        </section>
      </nav>
    </section>

    <section id="poems" class="poems">
      <section class="container">


                <h5 class="modal-title" id="login-modal-label">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="sign_in.php" method="post">
                <div class="modal-body">
                  <?php if (hasErrorLogin()): ?>

                    <?php if(isset($_SESSION['error_login'])): ?>
                      <?php print_r("<span style='color:rgb(228, 102, 55)'>" . $_SESSION['error_login'] . "</span>" );?>
                      <?php unset($_SESSION['error_login']); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email-login" type="text" class="form-control" name="email" aria-describedby="emailLogin" placeholder="Seu email">
                  </div>
                  <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" aria-describedby="passwordLogin" placeholder="Sua senha">
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="submit-login" type="submit" class="btn btn-primary">Entrar</button>
                </div>
              </form>
      

        </section>
      </section>



    <footer class="footer-poems">
      <span>Bárbara Vidal | Felipe Polchlopek | Filipe Fenrich </span><br>
      <span> <a href="user_terms.php">Termos de uso</a> </span>
    </footer>

    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="assets/js/application.js" type="text/javascript"></script>
  </body>
</html>
