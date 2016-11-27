<?php 
    session_start();
    require('dbconnect.php');

    // if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
    //     $_SESSION['time'] = time();

        // ようこそ◎◎さん
        $sql = sprintf('SELECT * FROM `members` WHERE id="%d"',
               mysqli_real_escape_string($db,$_SESSION['id'])
               );
        $record = mysqli_query($db,$sql) or die(mysql_error($db));
        $member = mysqli_fetch_assoc($record);
    // }else{
    //     // ログインしていない
    //     header('Location; login.php');
    //     exit();
    // }


    // 各変数の初期値設定
    $name = '';
    $username = '';
    $comment = '';

    // 名前、アカウント名、画像、コメントが入力された場合
     if(!empty($_POST)){
          $name = $_POST['name'];
          $username = $_POST['username'];
          $comment = $_POST['comment'];

          // 名前未入力チェック
          if($_POST['name'] == ''){
              $error['name'] = 'blank';
          }

          // アカウント名未入力チェック
          if($_POST['username'] == ''){
              $error['username'] = 'blank';
          }

     }

    // 画像ファイルの拡張子チェック
    $filename = $_FILES['picture']['name'];
        if(!empty($filename)){
            $ext = substr($filename, -3);
            if($ext != 'jpg' && $ext != 'gif' && $ext != 'png'){
                $error['picture'] = 'type';
            }
        }

    // 画像をアップロードする
    if(empty($error)){
        $picture = date('YmdHis') . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], 'twitter_picture/' . $picture);

        var_dump($_FILES);

        // セッションに値を保存
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['picture'] = $picture;
        header('Location: check2.php');
        exit();
    }





    // 検索処理
    if(!empty($_GET['search'])){
        $sql = sprintf('SELECT `name` FROM `accounts` LIKE %%%s%%',
                mysqli_real_escape_string($db,$_GET['search'])
          );
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
    <link rel="icon" href="/favicon.ico">

    <title>おもしろtwitterアカウント</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

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
          
    </nav>

    <div class="container">

      <div class="starter-template">
      <legend>ようこそ<?php echo $member['name']; ?>さん！</legend>
        <h1>おもしろtwitterアカウント</h1>

        <form action="" method="post" enctype="multipart/form-data">
        <div class="lead">追加したい時
          <div>ツイッター名
            <input type="text" name="name" value="<?php echo $name; ?>">
           </div>

          <div>アカウント　
            <input type="text" name="username" value="<?php echo $username; ?>">
          </div>

          <div>画像
            <p><input type="file" name="picture">
            <?php if(isset($error['picture']) && $error['picture'] == 'type'): ?><br>
                <p style="color:red;">✴︎　プロフィール画像は「jpg」「gif」「png」の画像を指定してください</p>
              <?php endif; ?>
              <?php if(!empty($error)): ?><br>
                <p style="color:red;">✴︎　画像を再設定してください</p>
              <?php endif; ?>
            </p>
          </div>

          <div>コメント
            <textarea name="comment" ><?php echo $comment; ?></textarea>
          </div>

          <div>
            <input type="submit" value="登録する">
          </div>
          </form>
        </div>


        <form action="" method="get">
        <h3>検索したい時</h3>
        <input type="text" name="search">
        <input type="submit" value="検索">
      </div>  
      </form>
      </div>



    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
