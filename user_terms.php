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

      <section class="container">
        <center>
        TERMOS DE USO
      </center><br>
        <center>
        1. Você pode demonstrar seus sentimentos de forma livre.<br>
        2. Só é permitido submeter textos.<br>
        3. É proibido submeter conteúdo sexual, racista ou homofóbico.<br>
        4. Evite falar sobre assuntos polêmicos tais como política, religião e futebol.<br>
        5. Não use esta plataforma para ofender pessoas ou animais.<br>
        6. Não incentive o suicídio em seus poemas.<br>
        </center>
        <center>
        - Caso você esteja pensando em desistir, ligue para 141. Você vale muito e nós nos importamos! -
        </center>
      </section>

    <footer class="footer-poems">
      <span>Bárbara Vidal | Felipe Polchlopek | Filipe Fenrich </span><br>
      <span> <a href="user_terms.php">Termos de uso</a> </span>
    </footer>

    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="assets/js/application.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
