<?php

session_start();
require('dbconnect.php');

//セッションのidがセットされていて1時間以内の場合の処理
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {

  // $_SESSION['time']を更新
  $_SESSION['time'] = time();
  //member関係のsql文
  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();

} else { // 前回のログインから1時間以上たった場合の処理

  // ログイン画面に返す
  header('Location: login.php');
  exit();

}

// posts関係のsql文
$posts = $db->query('SELECT p.* FROM posts p, members m WHERE p.member_id=m.id ORDER BY p.created DESC');

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  
<!-- header -->

<header>

  <div class="header-left">
    <h1>MyApp</h1>
  </div>

  <div class="header-right">
    <a href=""><i class="fas fa-sign-out-alt"></i>ログアウト</a>
  </div>

</header>

<!-- header -->

<!-- header-sub -->

<div class="header-sub">

  <h4 class="member-name"><?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?>さんのページ</h4>
  <a class="post-btn" href="input.php">投稿する</a>

</div>

<hr>

<!-- header-sub -->

<!-- post -->

<?php foreach ($posts as $post): ?>

  <?php if ($_SESSION['id'] === $post['member_id']): ?>

    <div class="post">
    
      <div class="post-left">
        <h2>タイトル:&nbsp;&nbsp;<a href=""><?php print(htmlspecialchars($post['title'], ENT_QUOTES)); ?></a></h2>
        <time class="gray">投稿日時:&nbsp;<?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></time>
      </div>

      <div class="post-right">
        <h2>感想</h2>
        <p class="impre"><?php print(htmlspecialchars($post['impre'], ENT_QUOTES)); ?></p>
      </div>
    
    </div>

    <hr>
  <?php endif; ?>

<?php endforeach; ?>

<!-- post -->

<script src="main.js"></script>
</body>
</html>