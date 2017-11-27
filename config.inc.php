<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
  $PDO = new PDO( 'mysql:host=' . 'mysql762.umbler.com' . ';dbname=' . 'trab', 'foolem', 'ursopolar1', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch ( PDOException $e ) {
  echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
