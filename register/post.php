<?php

require('dbconnect.php');

session_start();
date_default_timezone_set('Asia/Manila');//フィリピン時間に設定


//エラーだった場合に何エラーかを保存するための$errors配列を定義
$errors = array();


if (!empty($_POST)){
    $title = $_POST['title'];
    $date = $_POST['date'];
    $detail = $_POST['detail'];
    $img_name = $_FILES['input_img_name']['name'];


    $county = mb_strlen($title);
    $count = mb_strlen($detail);


//ユーザー名のからのチェック
    if($title==''){
        $errors['title'] = 'blank';
    }
    elseif ($county > 24) {
        $errors['title'] = 'length';
# code...
    }
    if($date == ''){
        $errors['date'] = 'blank';
    }
    if($detail ==''){
        $errors['detail'] = 'blank';
    }
    elseif ($count > 140) {
        $errors['detail'] = 'length';
# code...
    }

// $file_name = '';
// if (!isset($_GET['action'])){
    // $file_name = $_FILES['input_img_name']['name'];
//画像名（拡張子）を取得する

    if(!empty($img_name)){
      $file_type=substr($img_name,-4);//画像名（拡張子）の後ろから3文字目を取得
       $file_type=strtolower($file_type);//大文字が含まれていた場合全て小文字化
     if($file_type!='.jpg' && $file_type!='.png' && $file_type!='.gif' && $file_type!='jpeg')
        $errors['img_name'] = 'type';
    }else{
      $errors['img_name'] = 'blank';
    }
// }
//上記画像の選択をしてエラーが出なかったときの処理
//⇨保存先フォルダーに画像データを送る
if(empty($errors)){
    $date_str = date('YmdHis');
    $submit_file_name = $date_str.$img_name;//画像名に日付をつけて保存する
    move_uploaded_file($_FILES['input_img_name']['tmp_name'],'../user_profile_img/'.$submit_file_name);
//上記if(empty($errors))はエラーがなかった場合、画像をアップロードするという処理だから、他の情報も全て入力されていなければ、画像が保存されない！！
// $spl = 'INSERT INTO' `
//$_SESSION
// $_SESSION['register']['title']=$_POST['input_title'];
// $_SESSION['register']['date']=$_POST['input_date'];
// $_SESSION['register']['detail']=$_POST['input_detail'];
// $_SESSION['register']['img_name']=$submit_file_name;

    // INSERT INTO `feeds` (`title` , `date` , `detail` , `img_name`) VALUES ('a','b','c','d')

    $sql = 'INSERT INTO `feeds` (`title`, `date`, `detail`, `img_name`) VALUES (?, ?, ?, ?)';
    $data = array($title,$date,$detail,$submit_file_name);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location:index.php');
    exit();
    $dbh = null;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Memories</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/chart.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><i class="fa fa-camera" style="color: #fff;"></i></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.php">Main page</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>


    <div class="container">
        <div class="col-xs-8 col-xs-offset-2 thumbnail">
            <h2 class="text-center content_header">写真投稿</h2>
            <form method="POST" action="post.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="task">タイトル</label>
                    <input name="title" class="form-control">
                    <?php if(isset($errors['title']) && $errors['title'] == 'blank'){ ?>
                        <p class="text-danger">タイトル名を入力して下さい。</p><?php }?>
                        <?php if(isset($errors['title']) && $errors['title'] == 'length'){?>
                            <p class="text-danger">タイトルは24文字以内にして下さい。</p><?php }?>
                        </div>
                        <div class="form-group">
                            <label for="date">日程</label>
                            <input type="date" name="date" class="form-control">
                            <?php if(isset($errors['date']) && $errors['date'] == 'blank'){ ?>
                                <p class="text-danger">日程を入力して下さい。</p><?php } ?> 

                            </div>
                            <div class="form-group">
                                <label for="detail">詳細</label>
                                <textarea name="detail" class="form-control" rows="3"></textarea><br>
                                <?php if(isset($errors['detail']) && $errors['detail'] == 'blank'){?>
                                    <a class="text-danger">詳細を入力して下さい。</a><?php } ?>
                                    <?php if(isset($errors['detail']) && $errors['detail'] == 'length'){?>
                                        <p class="text-danger">詳細は140文字以内にして下さい。</p><?php }?>

                                    </div>
                                    <div class="form-group">
                                        <label for="img_name">写真</label>
                                        <input type="file" name="input_img_name" id="img_name"
                                        accept="image/*">
                                        <?php if(isset($errors['img_name']) && $errors['img_name'] == 'blank'){?><p class="text-danger">画像を選択して下さい。</p><?php }?>
                                        <?php if(isset($errors['img_name']) && $errors['img_name'] == 'type'){?>
                                            <p class="text-danger">拡張子が「jpg」「png」「gif」「jpeg」の画像を選択して下さい。</p><?php }?>
                                        </div><br>
                                        <input type="submit" class="btn btn-primary" value="投稿">
                                        <a href="index.php"
                                    </form>
                                </div>
                            </div>

                            <div id="f">
                                <div class="container">
                                    <div class="row">
                                        <p>I <i class="fa fa-heart"></i> Cubu.</p>
                                    </div>
                                </div>
                            </div>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
