<?php

require('dbconnect.php');

$id = $_REQUEST['id'];

// 正しく$idが指定されていない場合の処理
if (!isset($id) || $id <= 0) {
  print('１位上の数字で指定してください。');
  exit();
}

// postsのsql文
$posts = $db->prepare('SELECT * FROM posts WHERE id=?');
$posts->execute(array($_REQUEST['id']));
$post = $posts->fetch();

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

  <h1>投稿内容</h1>

  <div class="post-content">
  
    <div class="post-content-left">
      <h2>タイトル</h2>
    </div>

    <div class="post-content-right">
      <p><?php print($post['title']); ?></p>
    </div>
  
  </div>

  <div class="post-content">

    <div class="post-content-left">
      <h2>感想</h2>
    </div>

    <div class="post-content-right">
      <p class="impre"><?php print($post['impre']); ?></p>
    </div>

  </div>
  <a href="update.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>">編集する</a>
  |
  <a href="delete.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>">削除する</a>

</div>

<!-- container -->
  
</body>
</html>