<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>myapp</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- header -->

<header>

  <div class="header-left">
    <h1>MyApp</h1>
  </div>

  <div class="header-right">
    <a href="join/">&laquo;入会手続きをする</a>
  </div>

</header>

<!-- header -->

<!-- container  -->

<div class="container">

  <h1>ログイン画面</h1>
  <p class="gray">* メールアドレスとパスワードを入力してログインしてください。</p>

  <form action="" method="post">
  
    <div class="content">
      <div class="content-left">
        <h2>メールアドレス</h2>
      </div>

      <div class="content-right">
        <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($email, ENT_QUOTES)); ?>">
      </div>
    </div>

    <div class="content">
      <div class="content-left">
        <h2>パスワード</h2>
      </div>
    
      <div class="content-right">
        <input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
      </div>
    </div>

    <input type="checkbox" name="save" value="on">
    <label for="save">ログイン情報を記憶する。</label>
    <br>
    <input class="btn" type="submit" value="ログイン">
  
  </form>

</div>

<!-- container  -->
  
</body>
</html>