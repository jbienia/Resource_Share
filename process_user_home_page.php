<?php
session_start();
   require('connect_db.php');
  function file_upload_path($original_filename, $upload_subfolder_name = 'img') {
         $current_folder = dirname(__FILE__);
         $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
         return join(DIRECTORY_SEPARATOR, $path_segments);
      }

      $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

      if ($image_upload_detected) {
        $image_filename       = $_FILES['image']['name'];
        $temporary_image_path = $_FILES['image']['tmp_name'];
        $new_image_path       = file_upload_path($image_filename);
      }
 //print_r($_FILES);
        move_uploaded_file($temporary_image_path, $new_image_path);

        if(isset($_POST['education']))
        {
          $category = "Education";
        }

        if(isset($_POST['homeMaintenance']))
        {
          $category = "Home Maintenance";
        }

        if(isset($_POST['food']))
        {
          $category = "Food";
        }

        if(isset($_POST['various']))
        {
          $category = "Various";
        }

 if($_POST)
 {
   $story = filter_input(INPUT_POST,"story",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $goals = filter_input(INPUT_POST,"goals",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $goalTitle = filter_input(INPUT_POST,"goalTitle",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }

 $query = "UPDATE members SET Story = :story,ProfilePicture = :profilePicture WHERE UserID = :id ";
 $statement = $db->prepare($query);
 $statement -> bindValue(":profilePicture","img/".$image_filename);
 $statement -> bindValue(":story",$story);
 $statement -> bindValue(":id",$_SESSION['userID']);
 $statement->execute();

 // Process the goal next. Into goals table. Think about adding goals to the member table.
 $query = "INSERT into goals (UserID,GoalTitle,GoalDescription,Category) VALUES (:userID,:goalTitle,:goalDescription,:category)";
 $statement = $db->prepare($query);
 $statement ->bindValue(":userID",$_SESSION['userID']);
 $statement ->bindValue(":goalTitle",$goalTitle);
 $statement ->bindValue(":goalDescription",$goals);
 $statement -> bindValue(":category",$category);
 $statement->execute();

header("location:member_page.php");
 //$row = $statement->fetch();
//echo $new_image_path;
//echo "img/". $image_filename;
 //echo $row['Story'];
 ?>
