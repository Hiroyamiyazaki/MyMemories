<?php

//エラーだった場合に何エラーかを保存するための$errors配列を定義
$errors = array();


    if (!empty($_POST)){
      $name = $_POST['title'];
      $date = $_POST['date'];
      $detail = $_POST['detail'];

//ユーザー名のからのチェック
      if($name==''){
        $errors['name'] = 'blank';
      }
      if($date == ''){
        $errors['date'] = 'blank';
      }
      if($detail ==''){
        $errors['detail'] = 'blank';
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
<li class="active"><a href="index.html">Main page</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>


<div class="container">
<div class="col-xs-8 col-xs-offset-2 thumbnail">
<h2 class="text-center content_header">写真投稿</h2>
<form method="POST" action="" enctype="multipart/form-data">
<div class="form-group">
<label for="task">タイトル</label>
<input name="title" class="form-control">
<?php if(isset($errors['name']) && $errors['name'] == 'blank'){ ?>
<p class="text-danger">タイトル名を入力して下さい。</p><?php }?>
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
</div>
<div class="form-group">
<label for="img_name">写真</label>
<input type="file" name="input_img_name" id="img_name">
</div><br>
<input type="submit" class="btn btn-primary" value="投稿">
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