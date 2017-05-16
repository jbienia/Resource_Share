
<?php
// Form processes a new user Entered by the admin or a new contributor
 session_start();

  require("connect_db.php");

  if($_POST)
  {
    $userName = filter_input(INPUT_POST,"userName",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstName = filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $_SESSION['userName'] = $userName;
    $hash= password_hash($password,PASSWORD_DEFAULT);



  }



  if(strlen($userName) >0 && strlen($password) >0)
  {
    $query = "INSERT INTO members(FirstName,LastName,UserName,Password) values(:firstName,:lastName,:userName,:password)";
    $statement = $db -> prepare($query);
    $statement -> bindValue(":firstName",$firstName);
    $statement -> bindValue(":lastName",$lastName);
    $statement -> bindValue(":userName",$userName);
    $statement -> bindValue(":password",$hash);
    $statement -> execute();



    $idQuery = "SELECT UserID FROM members where UserName = :userName";
    $statements = $db->prepare($idQuery);
    $statements -> bindValue(":userName",$userName);

    $statements->execute();

    $row = $statements->fetch();

        $_SESSION['userID']= $row['UserID'];
    //print_r($row);

    if(isset($_POST['userType']))
    {
      $query = "INSERT userrole(RoleName,UserID) VALUES (:roleName,:userID)";
      $statement = $db->prepare($query);
      $statement -> bindValue(":roleName","M");
      $statement -> bindValue(":userID",$_SESSION['userID']);
      $statement ->execute();

      header("location:new_user.php");
      exit;
    }

    else {
      $query = "INSERT userrole (RoleName,UserID) VALUES (:roleName,:userID)";
      $statement = $db->prepare($query);
      $statement -> bindValue(":roleName","C");
      $statement -> bindValue(":userID",$_SESSION['userID']);
      $statement ->execute();
      header("location:categories_page.php");
      exit;
    }


  }

 ?>
