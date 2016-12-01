<?php 
    session_start();
    require('dbconnect.php');


    // もし登録ボタンが押されたら
    if(!empty($_POST)){
            //登録処理
        $sql = sprintf('INSERT INTO `accounts` 
                        SET `name`="%s",
                            `username`="%s",
                            `picture`="%s",
                            `comment`="%s",
                            `created`=NOW()',
               mysqli_real_escape_string($db,$_SESSION['join']['name']),
               mysqli_real_escape_string($db,$_SESSION['join']['username']),
               mysqli_real_escape_string($db,sha1($_SESSION['join']['picture'])),
               mysqli_real_escape_string($db,$_SESSION['join']['comment']));
              mysqli_query($db,$sql) or die(mysqli_error($db));
              unset($_SESSION['join']);

              header('Location: thanks2.php');
              exit();

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
    <link rel="icon" href="favicon.ico">

    <title>アカウント登録確認</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">

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


      </div>
    </nav> 

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>アカウント登録確認</h1>
      </div>
      <div>
        <form method="post" action="">
        <input type="hidden" name="action" value="submit">
        <table class="table table-striped table-condensed">
              <tbody>
                <!-- 登録内容を表示 -->

                <tr>
                  <td><div class="text-center">名前</div></td>
                  <td><div class="text-center"><?php echo $_SESSION['join']['name']; ?></div></td>
                </tr>

                <tr>
                  <td><div class="text-center">アカウント</div></td>
                  <td><div class="text-center"><?php echo $_SESSION['join']['username']; ?></div></td>
                </tr>

                <tr>
                  <td><div class="text-center">パスワード</div></td>
                  <td><div class="text-center">●●●●●●●●</div></td>
                </tr>
                <tr>
                  <td><div class="text-center">アカウント画像</div></td>
                  <td><div class="text-center"><img src="twitter_picture/<?php echo $_SESSION['join']['picture']; ?>" width="100" width="100" height="100"></div></td>
                </tr>
                <tr>
                <td><div class="text-center">コメント</div></td>
                <td><div class="text-center"><?php echo $_SESSION['join']['comment'] ?></div></td>
                </tr>
              </tbody>
            </table>
            <input type="submit" class="btn btn-default" value="アカウント登録">
          
        </form>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
