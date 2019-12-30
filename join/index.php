<?php

session_start();
require('../dbconnect.php');

if (!empty($_POST)) {

  //エラー処理

  //name
  if ($_POST['name'] === '') {
    $error['name'] = 'blank';
  }

  //email
  if ($_POST['email'] === '') {
    $error['email'] = 'blank';
  }

  //password
  if (strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }

  if ($_POST['password'] === '') {
    $error['password'] = 'blank';
  }

  //メールアドレスの重複確認
  if (empty($error)) {
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
    $member->execute(array($_POST['email']));
    $record = $member->fetch();
    if ($record['cnt'] > 0) {
      $error['email'] = 'duplicate';
    }
  }

  //セッション
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
    exit();
  }

}

//rewrite処理
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
  $_POST = $_SESSION['join'];
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
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

<!-- header -->

<header>

  <div class="header-left">
    <h1>MyApp</h1>
  </div>
  <div class="header-right">
    <a href="#"><i class="fas fa-sign-in-alt"></i>ログイン</a>
  </div>

</header>

<!-- header -->

<!-- container -->

<div class="container">
  <h1>会員登録</h1>
  <p class="gray">* 次のフォームに必要事項を入力してください。</p>
  <form action="" method="post">
    <div class="content">
      <div class="content-left">
        <h2>ニックネーム</h2>
        <?php if ($error['name'] === 'blank'): ?>
          <p class="error">* ニックネームを入力してください。</p>
        <?php endif ?>
      </div>
      <div class="content-right">
        <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
      </div>
    </div>
    <div class="content">
      <div class="content-left">
        <h2>メールアドレス</h2>
        <?php if ($error['email'] === 'blank'): ?>
          <p class="error">* メールアドレスを入力してください。</p>
        <?php endif; ?>
        <?php if ($error['email'] === 'duplicate'): ?>
          <p class="error">* 指定されたメールアドレスは、既に登録されています。</p>
        <?php endif; ?>
      </div>
      <div class="content-right">
        <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
      </div>
    </div>
    <div class="content">
      <div class="content-left">
        <h2>パスワード</h2>
        <?php if ($error['password'] === 'blank'): ?>
          <p class="error">* パスワードを入力してください。</p>
        <?php endif; ?>
      </div>
      <div class="content-right">
        <input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
      </div>
    </div>
    <div class="submit">
      <input class="btn" type="submit" value="入力内容を確認する">
    </div>
  </form>
</div>

<!-- container -->
  
</body>
</html>