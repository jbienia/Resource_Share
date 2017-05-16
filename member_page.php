<?php
  session_start();
  require("connect_db.php");


$adminUser = false;

  if(substr($_SESSION['userName'],0,5) == "admin")
  {
     $adminUser=true;
  }



 if(isset($_GET['userID']))
 {
   //$userID = filter_input(INPUT_GET,'userID',FILTER_SANITIZE_NUMBER_INT);
   $userID = $_GET['userID'];

   $_SESSION['userID'] = $userID;

 }
 else {
   $userID = $_SESSION['userID'];

 }
  $filePathQeury = "SELECT ProfilePicture,FirstName FROM members WHERE UserID = :userID";
  $statement = $db ->prepare($filePathQeury);
  $statement -> bindValue(":userID",$userID);
  $statement ->execute();
$rows = $statement-> fetchAll();
foreach ($rows as $row)
{
  $firstName = $row['FirstName'];
  $path = $row['ProfilePicture'];
}

  $goalTitleQuery = "SELECT GoalTitle FROM goals WHERE UserID = :userID";
  $statement = $db ->prepare($goalTitleQuery);
  $statement -> bindValue(":userID", $userID);
  $statement ->execute();

  $goalTitle = $statement->fetch()['GoalTitle'];
  $_SESSION['goalTitle'] = $goalTitle;

  $goalDescriptionQuery = "SELECT GoalDescription FROM goals WHERE UserID = :userID";
  $statement = $db ->prepare($goalDescriptionQuery);
  $statement -> bindValue(":userID", $userID);
  $statement ->execute();

$date = "CreatedDate";
$order = "CreatedDate";
  $description = $statement ->fetch()['GoalDescription'];
    $_SESSION['description'] = $description;

    if(isset($_POST['order']))
    {
      if($_POST['order']==="dateCreated")
      {
        $order = "CreatedDate";
        $date = "CreatedDate";
      }

      if($_POST['order']==="dateEdited")
      {
        $date = "Updatetime";
        $order = "CreatedDate";
      }

      if($_POST['order']==='title')
      {
        $date = "CreatedDate";
        $order = "CommentTitle";
      }
    }
    $commentQuery = "SELECT Comment,CommentTitle,CommentAuthor,CommentID,DATE_FORMAT($date,'%Y-%m-%d') as CreatedDate FROM goalcomments WHERE :userID = UserID ORDER BY $order DESC";
    $statement = $db->prepare($commentQuery);
    $statement ->bindValue(":userID",$userID);
    $statement -> execute();
    $comments = $statement->fetchAll();

    if($comments != null)
    {

      $isComments = true;
    }
    else {
     $isComments = false;
    }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clean Blog - Sample Post</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="post.html">Sample Post</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>Meet <?=$firstName?></h1>
                        <h2 class="subheading">Would you like to share?</h2>
                        <span class="meta">Welcome to Resource Share</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <img id ="profilePic" src =<?="$path"?> alt ="">
                    <h1><?=$goalTitle?></h1>
                    <p><?=$description?></p>
                    <?php if($adminUser)  :?>
                      <form method = "post" action="edit_user.php">

                          <input type="submit" name="name" value="Edit">
                      </form>
                      <form method = "post" action="delete_user.php">

                          <input id = "deleteUser" type="submit" name="name" value="Delete User">
                      </form>

                    <?php endif ?>

                    <form method ="post" action ="new_comment.php" onsubmit="return checkForm(this);">
                      <p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
                    <p><input type="text" size="6" maxlength="5" name="captcha" value=""><br>
                    <small>copy the digits from the image into this box</small></p>
                      <input type="submit" name="name" value="New Comment">
                  </form>

                  <form method="post">
                    <select name="order">
                      <option value="dateCreated">Date Created</option>
                      <option value="dateEdited">Date Edited</option>
                      <option value="title">Title</option>
                    </select>
                    <input type="submit">
                  </form>
                  <div id = "commentDiv">
                    <?php if($isComments==true) :?>
                      <?php foreach($comments as $comment):?>
                        <p>
                          <h5><?=$comment['CommentAuthor']?> says...</h2>
                            <h5>Date Posted <?=$comment['CreatedDate']?></h5>

                          <?= $comment['CommentTitle']?></br>
                          <?= $comment['Comment']?>
                          <?php if($adminUser == true) :?>
                            <form method = 'post' action="delete_comment.php">
                              <?php $_SESSION['commentID'] = $comment['CommentID'] ?>
                              <input type="submit" name="deleteComment" value="Delete">
                            </form>
                          <?php endif?>
                      </p>
                      <?php endforeach ?>
                    <?php endif ?>
                </div>
                </div>
            </div>
        </div>
    </article>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>
    <script src="js/captchaValidate.js"></script>

</body>

</html>
