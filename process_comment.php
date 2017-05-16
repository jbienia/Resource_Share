<?php
require('connect_db.php');
 session_start();

  $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description = filter_input(INPUT_POST,'content',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  print_r($_SESSION['userID']);
 $commentAuthor= $_SESSION['userName'];
  $userID = $_SESSION['userID'];

  $goalIdQuery = "SELECT GoalID FROM goals WHERE UserID = :userID";
  $statement = $db-> prepare($goalIdQuery);
  $statement -> bindValue(":userID",$userID);
  $statement -> execute();
  $row = $statement -> fetch();

  $goalID = $row['GoalID'];
  echo $goalID;

  $query = "INSERT INTO goalcomments (GoalID,Comment,UserID,CommentTitle,CommentAuthor) VALUES(:goalID,:description,:userID,:title,:commentAuthor)";
  $statement = $db->prepare($query);
  $statement ->bindValue(":title",$title);
    $statement ->bindValue(":description",$description);
      $statement ->bindValue(":goalID",$goalID);
        $statement ->bindValue(":userID",$userID);
        $statement->bindValue(":commentAuthor",$commentAuthor);
        $statement ->execute();

        header("Location:member_page.php");
        exit;

?>
