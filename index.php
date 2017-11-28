<?php
include_once "config.inc.php";
include_once "index.inc.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sua Poesia</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/application.css">

  </head>
  <body>


    <section class="upperNav">
      <nav id="nav" class="navbar navbar-expand-lg navbar-light fixed-top">
        <section class="container-fluid">
          <a class="navbar-brand" href="index.php">Sua Poesia</a>
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

    <?php if(!isset($_SESSION['user'])): ?>
      <section id="presentation" class="presentation">
        <section class="presentation-txt">
          <h1>mostre sua arte.</h1>
        </section>
        <a id="poems_anchor" class="animated pulse presentation-down-button" href="#poems">
          <section class="presentation-down">
            <h2>v</h2>
          </section>
        </a>
        <img src="assets/img/poema-preto.jpg" alt="Sua Poesia">
      </section>
    <?php endif; ?>

    <section id="poems" class="poems">
      <section class="container">

        <div class="row justify-content-center">
          <div class="row">
            <div class="col">
              <form action="index.php" method="get">
                <input id="search" type="search" name="search" value="<?php echo !empty($search_keyword) ? $search_keyword : ''; ?>" class="form-control width-input" placeholder="Pesquise poemas">
              </form>
            </div>
            <div class="col">
              <form action="index.php" method="get">
                <select class="form-control" id="select-filter" name="category">
                  <option value="" disabled>Filtros</option>
                  <option value="0" <?php echo $selected[0] ?> >Todas</option>
                  <option value="1" <?php echo $selected[1] ?> >Romântico</option>
                  <option value="2" <?php echo $selected[2] ?> >Melancólico</option>
                  <option value="3" <?php echo $selected[3] ?> >Divertido</option>
                </select>
              </form>
            </div>

          </div>

        </div>
          <?php if (isset($_SESSION['error_search'])): ?>
            <?php echo"<p class='text-center' style='color:rgb(228, 102, 55);text-align:center;'>" . $_SESSION['error_search'] . "</p>" ; ?>
            <?php unset($_SESSION['error_search']); ?>
          <?php endif; ?>


          <?php foreach($poems as $poem): ?>
            <?php if((!isset($_SESSION['user']) || $_SESSION['user']['role'] == 1) && $poem->status == 'published'): ?>
                <div class="card d-inline-flex justify-content-center card-b-<?php echo $poem->category; ?>" style="width: 22rem;min-height:278.083px">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $poem->title; ?></h4>
                    <h6 class="card-title">-<?php echo $poem->user_name; ?></h6>
                    <p class="card-text more"><?php echo $poem->content; ?></p>
                  </div>
                </div>

            <?php endif; ?>

          <?php endforeach; ?>

        </section>
      </section>


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
              <?php if (hasErrorLogin()): ?>
                <script type="text/javascript">
                $('#login-modal').modal('show');
                </script>
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

              <?php if (hasErrorSignup()): ?>
                <script type="text/javascript">
                  $('#signup-modal').modal('show');
                </script>
                <?php if(isset($_SESSION['error_signup'])): ?>
                  <?php print_r("<span style='color:rgb(228, 102, 55)'>" . $_SESSION['error_signup'] . "</span>" );?>
                  <?php unset($_SESSION['error_signup']); ?>
                <?php endif; ?>
              <?php endif; ?>

              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" aria-describedby="nameLogin" placeholder="Seu nome">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email-signup" type="text" class="form-control" name="email" aria-describedby="emailLogin" placeholder="Seu email">
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
              <button id="submit-signup" type="submit" class="btn btn-primary">Entrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
