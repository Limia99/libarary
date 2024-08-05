<?php
session_start();
include('includes/config.php');
//:error_reporting(0);
?>

<?php

    /*
        if(!in_array($file_extension,$allowed_extension))
      {
          $result = "صيغة الملف غير مدعومة ، تأكد من صيغة الملف ومن ثم حاول مرة اخرى.";
      }
    
    */

    $result="";
    $targetDir = "admin/uploaded_files/"; 
    
    $uid=intval($_SESSION['user_id']);
    $old_file_name=$_GET['old_file_name'];
    $file_id=intval($_GET['file_id']);

  $Delete_file_Query="DELETE FROM uploaded_files WHERE file_id='$file_id' AND user_id='$uid'";
  
      $DeleteQuery_run = mysqli_query($conn,$Delete_file_Query);
            
    if($DeleteQuery_run)
    {
        unlink($targetDir.$old_file_name);
        header("location:my_files.php");
    }
    else{
        echo"Somenthig went wrong!";
    }
      
    
?>