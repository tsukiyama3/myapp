<?php

require('dbconnect.php');

// 正しく$_REQUEST['id']が指定されていた場合の処理
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
  // $_REQUEST['id']に$idを代入
  $id = $_REQUEST['id'];
  // sql文
  $statement = $db->prepare('DELETE FROM posts WHERE id=?');
  $statement->execute(array($id));
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>myapp</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<!-- header -->

<header>

  <div class="header-left">
    <h1>MyApp</h1>
  </div>

  <div class="header-right">
    <a href="index.php"><i class="fas fa-backward"></i>戻る</a>
  </div>

</header>

<!-- header -->

<!-- container -->

<div class="container">

  <p class="gray">* 投稿を削除しました。</p>

</div>

<!-- container -->
  
</body>
</html>