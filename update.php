<?php

session_start();
require('dbconnect.php');

// 正しく$_REQUEST['id']が指定されている場合の処理
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {

  // $_REQUEST['id']を$idに代入
  $id = $_REQUEST['id'];

  // $repostsのsql文
  $reposts = $db->prepare('SELECT * FROM posts WHERE id=?');
  $reposts->execute(array($id));
  $repost = $reposts->fetch();

  // フォームが空じゃない場合の処理
  if (!empty($_POST)) {

    // エラー処理
    if ($_POST['title'] === '') {
      $error['title'] = 'blank';
    }

    if ($_POST['impre'] === '') {
      $error['impre'] = 'blank';
    }

    // エラーがない場合の処理
    if (empty($error)) {
      // sql文
      $statement = $db->prepare('UPDATE posts SET title=?, impre=? WHERE id=?');
      $statement->execute(array(
        $_POST['title'],
        $_POST['impre'],
        $id
      ));
      header('Location: index.php');
      exit();
    }

  }

} else { // $_REQUEST['id']が正しくない場合の処理
  header('Location: index.php');
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

  <h1>更新</h1>
  <p class="gray">* 更新内容を入力してください。</p>

  <form action="" method="post">
  
    <div class="content">
    
      <div class="content-left">
        <h2>タイトル</h2>
        <?php if ($error['title'] === 'blank'): ?>
          <p class="error">* タイトルを入力してください。</p>
        <?php endif; ?>
      </div>

      <div class="content-right">
        <input type="text" name="title" size="50" value="<?php print(htmlspecialchars($repost['title'], ENT_QUOTES)); ?>">
      </div>
    
    </div>

    <div class="content">
    
      <div class="content-left">
        <h2>感想</h2>
        <?php if ($error['impre'] === 'blank'): ?>
          <p class="error">* 感想を入力してください。</p>
        <?php endif; ?>
      </div>
    
      <div class="content-right">
        <textarea name="impre" cols="50" rows="10"><?php print(htmlspecialchars($repost['impre'], ENT_QUOTES)); ?></textarea>
      </div>

    </div>
    
    <input class="btn" type="submit" value="更新する">

  </form>

</div>

<!-- container -->
  
</body>
</html>