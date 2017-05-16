<?php
session_start();
require("connect_db.php");
require("header.php");
$userID = $_SESSION['userID'];

$query = "SELECT FirstName FROM members WHERE UserID = :userID";
$statement = $db->prepare($query);
$statement -> bindValue(":userID", $userID);
$statement -> execute();

$firstName = $statement->fetch()['FirstName'];

$maintenanceQuery = "SELECT m.UserID,FirstName, GoalTitle, Category FROM members m, goals g WHERE Category = :category AND m.UserID = g.UserID";
$statement = $db->prepare($maintenanceQuery);
$statement -> bindValue(":category","Home Maintenance");
$statement -> execute();
$homeMaintenance = $statement ->fetchAll();


$educationQuery = "SELECT m.UserID, FirstName, GoalTitle, Category FROM members m, goals g WHERE Category = :category AND m.UserID = g.UserID";
$statement = $db->prepare($educationQuery);
$statement -> bindValue(":category","Education");
$statement -> execute();
$educationRows = $statement ->fetchAll();

$foodQuery = "SELECT  m.UserID,  FirstName, GoalTitle, Category FROM members m, goals g WHERE Category = :category AND m.UserID = g.UserID";
$statement = $db->prepare($foodQuery);
$statement -> bindValue(":category","Food");
$statement -> execute();
$foodRows = $statement ->fetchAll();

$variousQuery = "SELECT  m.UserID,  FirstName, GoalTitle, Category FROM members m, goals g WHERE Category = :category AND m.UserID = g.UserID";
$statement = $db->prepare($variousQuery);
$statement -> bindValue(":category","Various");
$statement -> execute();
$variousRows = $statement ->fetchAll();
// foreach ($rows as $row) {
//   echo $row['FirstName'].$row['GoalTitle'];
// }

?>


  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">

                  <p>Hi <?=$firstName?>. Please choose a category that interests you.....</p>

                  <p><a id = "homeMaintenanceLabel"href="#">Home Maintenance</a></p>

                  <ul id = "homeMaintenance">
                    <?php foreach($homeMaintenance as $row) :?>
                      <li>
                        <a href="member_page.php?userID=<?=$row['UserID']?>"><?=$row['FirstName']?> needs a hand to <?=$row['GoalTitle']?></a>
                      </li>

                    <?php endforeach ?>
                  </ul>

                  <p><a id = "educationLabel"href="#">Education</a></p>
                  <ul id='education'>
                  <?php foreach($educationRows as $row) :?>
                    <li>
                      <a href="member_page.php?userID=<?=$row['UserID']?>"><?=$row['FirstName']?> needs a hand to <?=$row['GoalTitle']?></a>
                    </li>
                  <?php endforeach ?>
                </ul>

                  <p><a id = "foodLabel" href="#">Food</a></p>
                  <ul id = 'food'>
                      <?php foreach($foodRows as $row) :?>
                        <li>
                          <a href="member_page.php?userID=<?=$row['UserID']?>"><?=$row['FirstName']?> needs a hand to <?=$row['GoalTitle']?></a>
                        </li>
                      <?php endforeach ?>
                  </ul>

                  <p><a id = "variousLabel" href="#">Various</a></p>
                  <ul id ='label'>
                    <?php foreach($variousRows as $row) :?>
                      <li>
                        <a href="member_page.php?userID=<?=$row['UserID']?>"><?=$row['FirstName']?> needs a hand to <?=$row['GoalTitle']?></a>
                      </li>
                    <?php endforeach ?>

                  </ul>
                </div>
              </div>
            </div>
            <script src ="hide.js"></script>

  </body>

</html>
