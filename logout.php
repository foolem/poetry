<?php
include "config.inc.php";

unset($_SESSION['user']);

session_destroy();

// retorna para a index.php
header('Location: index.php');
