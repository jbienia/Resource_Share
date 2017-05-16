<?php
  require("connect_db.php");
  session_start();
$commentID = $_SESSION['commentID'];
echo $goalID;

  $query = "DELETE FROM goalcomments WHERE CommentID = :commentID";
  $statement = $db->prepare($query);
  $statement -> bindValue(":commentID",$commentID);
  $statement-> execute();
  header("Location:member_page.php");
  exit;

 ?>
