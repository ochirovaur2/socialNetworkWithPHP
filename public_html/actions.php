<?php
    $error = "";
    include("functions.php");
    if($_GET["action"] == "loginSignUp") {
      
       if($_POST["email"] == "") {
          $error =  "An email address is required";
       } else if ($_POST["password"] == "") {
          $error = "A password is required";
       } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
          $error = "Invalid email format";
       }
      if($error) {
        echo $error;
        exit();
      }
        if($_POST["loginActive"] == "0") {
          $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST["email"])."' LIMIT 1";
          $result = mysqli_query($link, $query);
          if (mysqli_num_rows($result) > 0) {
            $error = "That email address is already taken.";
          } else {
            $query = "INSERT INTO users (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST["email"])."', '".mysqli_real_escape_string($link, $_POST["password"])."')";
            if(mysqli_query($link, $query)) {
              $_SESSION["id"] = mysqli_insert_id($link);
              $query = "UPDATE users SET password = '".md5(md5($_SESSION["id"]).mysqli_real_escape_string($link, $_POST["password"]))."' WHERE id = ".$_SESSION["id"]." LIMIT 1";
              mysqli_query($link, $query);
              echo "1";
              
            } else {
              $error = "Couldn't create user - please try again later";
            };
          }

        } else {
          $query = "SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST["email"])."' LIMIT 1";
          $result = mysqli_query($link, $query);
          $row = mysqli_fetch_assoc($result); 
            if($row["password"] == md5(md5($row["id"]).mysqli_real_escape_string($link, $_POST["password"]))) {
              echo "1";
              $_SESSION["id"] = $row["id"];
            } else {
              $error = "Couldn't find that username or password combination. Please try again.";
            }
          }
        
         if($error) {
          echo $error;
          exit();
      }
    }

	if($_GET['action'] == "toggleFollow") {
      $query = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION["id"])."' AND `isFollowing` = '".mysqli_real_escape_string($link, $_POST["userId"])."' LIMIT 1";
         $result = mysqli_query($link, $query);
          if (mysqli_num_rows($result) > 0) {
          
            $row = mysqli_fetch_assoc($result); 
            mysqli_query($link, "DELETE FROM isFollowing WHERE id = ".mysqli_real_escape_string($link, $row["id"])." LIMIT 1");
            echo "1";
        } else {
             mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES(".mysqli_real_escape_string($link, $_SESSION["id"]).", ".mysqli_real_escape_string($link, $_POST["userId"]).")");
            echo "2";
          }
    }

	if($_GET['action'] == "postTweet") {
      $query = "INSERT INTO `tweets` (`tweet`, `userid`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST["tweet"])."', '".mysqli_real_escape_string($link, $_SESSION["id"])."', NOW())";
      if(mysqli_query($link, $query)) {
        echo "1";
      } else {
        echo "0";
      }
    }

	if($_GET['action'] == "sendMessage") {
      $query = " INSERT INTO `messages` (`message`, `userid`, `towhom`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST["message"])."','".mysqli_real_escape_string($link, $_SESSION["id"])."','".mysqli_real_escape_string($link, $_POST["email"])."', NOW())";
      
      if(mysqli_query($link, $query)) {
        echo "1";
      } else {
        echo "0";
      }
    }

	
	
	


?>