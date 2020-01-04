<?php

session_start();
require('dbconnect.php');

if (!empty($_POST)) {
  // エラー処理
  if ($_POST['title'] === '') {
    $error['title'] = 'blank';
  }

  if ($_POST['impre'] === '') {
    $error['impre'] = 'blank';
  }

  // postsのsql文
  if (empty($error)) {
    $posts = $db->prepare('INSERT INTO posts SET member_id=?, title=?, impre=?, created=NOW()');
    $posts->execute(array(
      $_SESSION['id'],
      $_POST['title'],
      $_POST['impre']
    ));
    header('Location: index.php');
    exit();
  }
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

  <h1>投稿画面</h1>
  <p class="gray">* 投稿内容を入力してください。</p>

  <form action="" method="post">
  
    <div class="content">
    
      <div class="content-left">
        <h2>タイトル</h2>
        <?php if ($error['title'] === 'blank'): ?>
          <p class="error">* タイトルを入力してください。</p>
        <?php endif; ?>
      </div>

      <div class="content-right">
        <input type="text" name="title" value="<?php print(htmlspecialchars($_POST['title'], ENT_QUOTES)); ?>">
      </div>
    
    </div>

    <div class="content">
    
      <div class="content-left">
        <h2 class="none-right">感想</h2>
        <?php if ($error['impre'] === 'blank'): ?>
          <p class="error">* 感想を入力してください。</p>
        <?php endif; ?>
      </div>

      <div class="content-right">
        <textarea name="impre" cols="50" rows="10"><?php print(htmlspecialchars($_POST['impre'], ENT_QUOTES)); ?></textarea>
      </div>
    
    </div>
    <br>
    <input class="btn" type="submit" value="投稿する">
  
  </form>

</div>

<!-- container -->
  
</body>
</html>