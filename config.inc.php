<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
  $PDO = new PDO( 'mysql:host=' . 'localhost' . ';dbname=' . 'trab', 'root', 'admin', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch ( PDOException $e ) {
  echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
