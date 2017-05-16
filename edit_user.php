<?php
  session_start();
  require('connect_db.php');
  // if(isset($_SESSION['fromUserIndex']))
  // {
  //   $userID = filter_var($_GET['userID'],FILTER_SANITIZE_NUMBER_INT);
  //   $query = "SELECT GoalTitle,GoalDescription FROM goals WHERE UserID = :userID";
  //   $statement = $db ->prepare($query);
  //   $statement -> bindValue(":userID",$userID);
  //   $statement -> execute();
  //   $rows = $statement -> fetchAll();
  //   $description = $rows[0]['GoalDescription'];
  //   $goalTitle= $rows[0]['GoalTitle'];
  // }


    $userID = $_SESSION['userID'];
    $description = $_SESSION['description'];
    $goalTitle = $_SESSION['goalTitle'];



  $storyQuery = "SELECT Story FROM members WHERE UserID = :userID";
  $statement = $db->prepare($storyQuery);
  $statement -> bindValue(":userID",$userID);
  $statement->execute();
  $story = $statement->fetch()['Story'];

 ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page</title>

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
                        <h1>Please Add your information</h1>
                        <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                        <span class="meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</span>
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
                  <h2>Your Backstory</h2>

                  <form action="process_edit.php" method="post" enctype="multipart/form-data">

                        <!-- <p>
                          <label for="story">Please Enter Your Story</label>
                          <textarea name="story" id="story"><?=$story?></textarea>
                        </p> -->


                        <h2 class="section-heading">My Goals</h2>

                        <p>
                          <label for="goals">Please Enter Your Goals</label>
                          <label for="goalTitle">Enter Goal Title</label>
                          <input name="goalTitle" id = "goalTitleMargins" value="<?=$goalTitle?>"/>

                          <textarea name="goals" id="story"><?=$description?></textarea>
                        </p>

                        <!-- <h2>Categories</h2>
                         <label for="education">Education</label>
                         <input class="category" type ="checkbox"name="education" />
                         <label for="homeMaintenance">Home Maintenance</label>
                         <input class="category" type ="checkbox"name="homeMaintenance" />
                         <label for="food">Food</label>
                         <input class="category" type ="checkbox"name="food" />
                         <label for="various">Various</label>
                         <input class="category" type ="checkbox"name="various" />


                        <label for="image">Image Filename:</label>
                          <p>
                                <input type="file" name="image" id="image">
                              </p>
                                <input type="submit" name="submit" value="Upload Image">
 -->


                        <p>
                          <input type="submit" name="command" value="Enter" />
                          <input type = 'submit' name = 'delete' value ="Delete Photo"/>
                        </p>
                    </form>





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
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2014</p>
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

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

</body>

</html>
