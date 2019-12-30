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
      </div>
      <div class="content-right">
        <input type="text" name="name" size="35" maxlength="255" value="">
      </div>
    </div>
    <div class="content">
      <div class="content-left">
        <h2>メールアドレス</h2>
      </div>
      <div class="content-right">
        <input type="text" name="email" size="35" maxlength="255" value="">
      </div>
    </div>
    <div class="content">
      <div class="content-left">
        <h2>パスワード</h2>
      </div>
      <div class="content-right">
        <input type="password" name="password" size="10" maxlength="20" value="">
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