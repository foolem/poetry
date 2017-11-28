<?php

$where = isset($_GET['category']) && $_GET['category'] != 0 && $_GET['category'] < 4 ? "AND poem.category = {$_GET['category']}" : '';
for ($i = 0; $i<4; $i++) {
  if(isset($_GET['category']) && $_GET['category'] == $i) {
    $selected[$i] = 'selected';
  } else {
    $selected[$i] = '';
  }
}


$stmt = $PDO->prepare("SELECT user.name as user_name, poem.* FROM user, poem WHERE poem.author = user.id {$where}");
$stmt->execute();
$poems = $stmt->fetchAll(PDO::FETCH_OBJ);


if(!empty($_GET['search'])) {
  $search_keyword = '';
  $search_keyword = $_GET['search'];
  $sql = "select user.name as user_name, poem.* from poem inner join user on poem.author = user.id where poem.status = 'published' and poem.title like :keyword or user.name like :keyword or poem.content like :keyword order by poem.id desc";
  $pdo_statement = $PDO->prepare($sql);
  $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
  $pdo_statement->execute();
  $poems = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
  if($pdo_statement->rowCount() == 0) {
    $_SESSION['error_search'] = "<br>Não conseguimos achar o que você procura<br>Tente outra vez c:";
  }
}

function isLoggedIn() {
  if (!isset($_SESSION['user'])) {
      return false;
  }
  return true;
}

function hasErrorLogin() {
  if (isset($_SESSION['error_login'])) {
    return true;
  }
}

function hasErrorSignup() {
  if (isset($_SESSION['error_signup'])) {
    return true;
  }
}
