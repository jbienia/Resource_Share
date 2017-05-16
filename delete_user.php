<?php
  session_start();
  require('connect_db.php');
$userID = $_SESSION['userID'];

  $query = "DELETE FROM goals WHERE UserID=:userID";
  $statement = $db->prepare($query);
  $statement -> bindValue(":userID",$userID);
  $statement->execute();

  $query = "DELETE FROM userrole WHERE UserID=:userID";
  $statement = $db->prepare($query);
  $statement -> bindValue(":userID",$userID);
  $statement->execute();

  $query = "DELETE FROM members WHERE UserID=:userID";
  $statement = $db->prepare($query);
  $statement -> bindValue(":userID",$userID);
  $statement->execute();




 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     ALl Done!
   </body>
 </html>
