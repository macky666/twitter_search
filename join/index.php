<?php
    session_start();
    require('../dbconnect.php');

        // 各入力値の初期値を設定
        $name = '';
        $email = '';
        $password = '';



        // フォームからデータが送信された場合
    if(!empty($_POST)){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

          // エラー項目の確認
          // ニックネーム未入力チェック
          if($_POST['name'] == ''){
              $error['name'] = 'blank';
          }
          // メールアドレス未入力チェック
          if($_POST['email'] == ''){
              $error['email'] = 'blank';
          }
          // パスワード未入力チェック
          if($_POST['password'] == ''){
              $error['password'] = 'blank';
          }
          // パスワードが４文字以下の場合
          if(strlen($_POST['password']) < 4){
              $error['password'] ='length';
          }
      
    }

    
    // 重複アカウントのチェック
    if(empty($error)){
        $sql = sprintf('SELECT COUNT(*) As cnt 
                        FROM `members` 
                        WHERE `email`="%s"',mysqli_real_escape_string($db,$_POST['email']));
        $record = mysqli_query($db,$sql) or die(mysqli_error($db));
        $table = mysqli_fetch_assoc($record);
        if($table['cnt'] > 0){
          $error['email'] = 'duplicate';
        }

       
    }

    // エラーがなかった場合の処理
    if(empty($error)){

         $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();

    }


// 書き直し処理
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite'){
      $_POST = $_SESSION['join'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $error['rewrite'] = true;
    }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>会員登録</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>会員登録</h1>
        
        <p>次のフォームに必要事項をご記入ください</p>

<form action="index.php" method="post" enctype="multipart/form-data">

<dl>
   <dt>ニックネーム<span class="required">(必須)</span></dt>
   <dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($name); ?>">
   <?php if(isset($error['name']) && $error['name'] == 'blank'): ?>
   <p class="error">ニックネームを入力してください</p>
   <?php endif; ?>
   </dd>

   <dt>メールアドレス<span class="required">(必須)</span></dt>
   <dd><input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($email); ?>">
   <?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
   <p class="error">メールアドレスを入力してください</p>
   <?php endif; ?>
   </dd>


   <dt>パスワード<span class="required">(必須)</span></dt>
   <dd><input type="password" name="password" size="10" maxlength="20" value="<?php echo $password; ?>">
    <?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
    <p class="error">パスワードを入力してください</p>
    <?php endif; ?>

    <?php if(isset($error['password']) && $error['password'] == 'length'): ?>
    <p class = "error">パスワードは４文字以上で入力してください</p>
    <?php endif; ?>

   </dd>
    </dd>
</dl>

<div><input type="submit" value="入力内容を確認する"></div>

</form>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>

   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
