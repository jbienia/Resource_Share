<?php
// Handels where to take the user if they are an admin or a contributo

session_start();

require("connect_db.php");
  if($_POST)
  {
    $userName = filter_input(INPUT_POST,"userName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

if(strlen($userName) > 0 && strlen($password) > 0)
{
  $query = "SELECT UserName FROM members";
  $statement = $db ->prepare($query);
  $statement -> execute();
  $rows = $statement -> fetchAll();
 //print_r($rows);
  foreach ($rows as $row)
   {

     if($row['UserName'] == $userName)
     {

       $pwordQuery = "SELECT Password FROM members where UserName = :userName";
       $statements = $db -> prepare($pwordQuery);
       $statements->bindValue(":userName",$userName);
       $statements ->execute();
       $hash = $statements -> fetch()['Password'];

        if(password_verify($password,$hash))
        {
          $idQuery = "SELECT UserID FROM members where UserName = :userName";
          $statements = $db->prepare($idQuery);
          $statements -> bindValue(":userName",$userName);
          $statements->execute();
          $row = $statements->fetch();
          $_SESSION['userID']= $row['UserID'];

          if(substr($userName,0,5) == "admin")
          {
            $_SESSION['userName']=$userName;

            header("Location:admin_page.php");
            exit;
          }
          else
          {
            $_SESSION['userName']=$userName;
            header("Location:categories_page.php");
            exit;
          }

        }

     }
  }
}

 ?>

<!DOCTYPE HTML>
<html>
  <head></head>
  <body>
    <p>Invalid Password or User Name</p>
  </body>
</html>
