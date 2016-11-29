<?php 
    session_start();
    require('dbconnect.php');

    // $sql = sprintf('SELECT `picture`,`name`,`username`
    //                 FROM `accounts`
    //                 WHERE a.`member_id` = m.`id`
    //                 AND a.`id`=%d',
    //                 mysqli_real_escape_string($db,$_REQUEST['account_id'])
    //                 );
    // $accounts = mysqli_query($db,$sql) or die(mysqli_error($db));


    // 検索処理
    if(!empty($_POST)){
        $sql = sprintf('SELECT `name`,`comment`
                        FROM `accounts` 
                        LIKE %%%s%%',
              　mysqli_real_escape_string($db,$_POST['search'])
          );
        $accounts = mysqli_query($db,$sql) or die(mysqli_error($db));
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

    <title>アカウント一覧</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">

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

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>アカウント一覧</h1>
      </div>
       <?php if($account = mysqli_fetch_assoc($accounts)): ?>
          <div>
            <img src="twitter_picture/<?php echo $account['picture'] ?>" width="100" height="100">
          </div>
          <p>名前 : <span class="name"><?php echo $tweet['name']; ?> </span></p>
          <p>
          アカウント : <br>
            <?php echo $tweet['username']; ?>
          </p>

       <?php endif ?>

       
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
