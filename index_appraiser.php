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
          <a class="navbar-brand" href="index_appraiser.php">Sua Poesia</a>
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


    <section id="poems" class="poems">
      <section class="container">

        <div class="row justify-content-center">
          <div class="row">
            <div class="col">
              <form action="index_appraiser.php" method="get">
                <input id="search" type="text" name="search" value="<?php echo !empty($search_keyword) ? $search_keyword : ''; ?>" class="form-control width-input" placeholder="Pesquise poemas">
              </form>
            </div>
            <div class="col">
              <form action="index_appraiser.php" method="get">
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

            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 3 && $poem->status == 'evaluation'): ?>
              <div class="card d-inline-flex justify-content-center card-b-<?php echo $poem->category; ?>" style="width: 22rem;min-height:278.083px">
                <div class="card-body">
                  <div class="row">

                    <div class="d-inline-flex m-0-left">
                      <form  style="width:100px" action="evaluate_publish.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $poem->id; ?>">
                        <button type="submit" class="btn btn-light">Publicar</button>
                      </form>

                    </div>
                    <div class="d-inline-flex">
                      <form  style="width:100px" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $poem->id; ?>">
                        <button type="submit" class="btn btn-light">Remover</button>
                      </form>
                    </div>

                  </div>
                  <h4 class="card-title"><?php echo $poem->title; ?></h4>
                  <h6 class="card-title">-<?php echo $poem->user_name; ?></h6>

                  <p class="card-text more"><?php echo $poem->content; ?></p>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>

        </section>
      </section>







    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="assets/js/application.js" type="text/javascript"></script>

  </body>
</html>
