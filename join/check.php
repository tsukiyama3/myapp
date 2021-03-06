<?php

session_start();
require('../dbconnect.php');

//セッションがない場合の処理
if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}

if (!empty($_POST)) {

  //データベースにデータを挿入
  $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  echo $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    sha1($_SESSION['join']['password'])
  ));

  //セッションを消す
  unset($_SESSION['join']);
  header('Location: thanks.php');
  exit();

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>myapp</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

<!-- header -->

<header>

  <div class="header-left">
    <h1>MyApp</h1>
  </div>
  <div class="header-right">
    <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>
  </div>

</header>

<!-- header -->

<!-- container -->

<div class="container">

  <h1>会員登録</h1>
  <p class="gray">* 入力した内容を確認して、「登録する」ボタンをクリックしてください。</p>

  <form action="" method="post">
  
    <input type="hidden" name="action" value="submit">
    <div class="content">
      <div class="content-left">
        <h2>ニックネーム</h2>
      </div>
      <div class="content-right check-content">
        <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>
      </div>
    </div>

    <div class="content">
      <div class="content-left">
        <h2>メールアドレス</h2>
      </div>
      <div class="content-right check-content">
        <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
      </div>
    </div>

    <div class="content">
      <div class="content-left">
        <h2>パスワード</h2>
      </div>
      <div class="content-right check-content">
        <p>【表示されません】</p>
      </div>
    </div>

    <div class="submit">
      <input class="btn" type="submit" value="登録する">
    </div>
  
  </form>

</div>

<!-- container -->
  
</body>
</html>